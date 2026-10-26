<?php

namespace Tests\Feature;

use App\Mail\AssessmentReportMail;
use App\Models\Assessment;
use App\Models\GameLog;
use App\Models\Question;
use App\Models\ThankYouCard;
use App\Models\User;
use Database\Seeders\QuestionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AssessmentFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(QuestionSeeder::class);
    }

    protected function createNurse(string $email = 'nurse@example.com'): User
    {
        return User::create([
            'name' => 'Test Nurse',
            'email' => $email,
            'nip' => '199001012020011001',
            'room' => 'Ruang Umar Bin Khattab 2',
            'role' => 'Perawat',
            'password' => bcrypt('password'),
        ]);
    }

    public function test_complete_five_step_flow(): void
    {
        Mail::fake();

        $nurse = $this->createNurse('testperawat@example.com');

        // Step 1: Pre-test
        $answers = [];
        for ($i = 1; $i <= 22; $i++) {
            $answers[$i] = 3;
        }

        $preTestResp = $this->actingAs($nurse)->post('/assessment/pre-test', [
            'answers' => $answers,
        ]);
        $preTest = Assessment::where('user_id', $nurse->id)->where('type', 'pre_test')->first();
        $this->assertNotNull($preTest);
        $preTestResp->assertRedirect(route('pre-test.result', $preTest->id));

        // Step 2: Game Play page & Log submission
        $gamePageResp = $this->actingAs($nurse)->get('/game/play');
        $gamePageResp->assertStatus(200);

        $gameLogResp = $this->actingAs($nurse)->postJson('/game/log', [
            'score' => 1500,
            'items_smashed' => 45,
            'max_combo' => 8,
            'duration_seconds' => 30,
            'boss_defeated' => true,
        ]);
        $gameLogResp->assertStatus(200);
        $this->assertDatabaseHas('game_logs', [
            'user_id' => $nurse->id,
            'score' => 1500,
        ]);

        // Game page should now show completion banner and advance button
        $gamePageAfterResp = $this->actingAs($nurse)->get('/game/play');
        $gamePageAfterResp->assertSee('Sesi game telah tercatat');
        $gamePageAfterResp->assertSee(route('thank-you.create'));

        // Step 3: Thank You Card
        $thankYouResp = $this->actingAs($nurse)->post('/thank-you', [
            'recipient_name' => 'Ns. Erni Gumilar',
            'message' => 'Terima kasih atas kerja samanya hari ini.',
        ]);
        $thankYouResp->assertRedirect(route('post-test.create'));
        $this->assertDatabaseHas('thank_you_cards', [
            'user_id' => $nurse->id,
            'recipient_name' => 'Ns. Erni Gumilar',
        ]);

        // Step 4: Post-test
        $postTestResp = $this->actingAs($nurse)->post('/assessment/post-test', [
            'answers' => $answers,
        ]);
        $postTest = Assessment::where('user_id', $nurse->id)->where('type', 'post_test')->first();
        $this->assertNotNull($postTest);
        $postTestResp->assertRedirect(route('post-test.result', $postTest->id));

        // Mail should have been sent automatically
        Mail::assertSent(AssessmentReportMail::class, function ($mail) use ($nurse) {
            return $mail->hasTo($nurse->email);
        });

        // Step 5: Immediate resend triggers anti-duplicate cooldown
        $resendResp = $this->actingAs($nurse)->post("/assessment/{$postTest->id}/send-email");
        $resendResp->assertSessionHas('info');

        // After cooldown expires, resend succeeds
        $this->travel(65)->seconds();
        $resendResp2 = $this->actingAs($nurse)->post("/assessment/{$postTest->id}/send-email");
        $resendResp2->assertSessionHas('success');
        $resendResp2->assertSessionMissing('error');
    }

    public function test_nurse_without_email_can_send_report_by_inputting_target_email(): void
    {
        Mail::fake();

        $nurseWithoutEmail = User::create([
            'name' => 'Adika Sarsaparila N, A.Md.Kep',
            'email' => null,
            'nip' => '199501012022012005',
            'room' => 'Ruang Umar Bin Khattab 2',
            'role' => 'Perawat',
            'password' => bcrypt('password'),
        ]);

        $postTest = Assessment::create([
            'user_id' => $nurseWithoutEmail->id,
            'type' => 'post_test',
            'status' => 'completed',
            'total_score' => 70,
            'percentage' => 53.0,
            'category' => 'Sedang',
            'ee_score' => 33,
            'dp_score' => 20,
            'pa_score' => 17,
        ]);

        // Sending with target_email input
        $resp = $this->actingAs($nurseWithoutEmail)->post("/assessment/{$postTest->id}/send-email", [
            'target_email' => 'adika.nurse@gmail.com',
        ]);

        $resp->assertSessionHas('success');
        Mail::assertSent(AssessmentReportMail::class, function ($mail) {
            return $mail->hasTo('adika.nurse@gmail.com');
        });

        // Ensure email was also saved to nurse profile
        $nurseWithoutEmail->refresh();
        $this->assertEquals('adika.nurse@gmail.com', $nurseWithoutEmail->email);
    }
}
