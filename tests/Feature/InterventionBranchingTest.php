<?php

namespace Tests\Feature;

use App\Models\Assessment;
use App\Models\User;
use Database\Seeders\QuestionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InterventionBranchingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(QuestionSeeder::class);
    }

    protected function createNurse(string $name = 'Ns. Test'): User
    {
        return User::create([
            'name' => $name,
            'role' => 'Perawat',
            'room' => 'Ruang Umar Bin Khattab 2',
            'password' => bcrypt('password123'),
        ]);
    }

    public function test_rendah_pre_test_routes_to_eft_relaxation(): void
    {
        $nurse = $this->createNurse();

        Assessment::create([
            'user_id' => $nurse->id,
            'type' => 'pre_test',
            'status' => 'completed',
            'total_score' => 30,
            'percentage' => 22.7,
            'category' => 'Rendah',
            'created_at' => now(),
        ]);

        $response = $this->actingAs($nurse)->get('/intervention');
        $response->assertStatus(200);
        $response->assertSee('Relaksasi EFT');
        $response->assertSee('Emotional Freedom Technique');
    }

    public function test_sedang_pre_test_routes_to_butterfly_hug(): void
    {
        $nurse = $this->createNurse();

        Assessment::create([
            'user_id' => $nurse->id,
            'type' => 'pre_test',
            'status' => 'completed',
            'total_score' => 60,
            'percentage' => 45.45,
            'category' => 'Sedang',
            'created_at' => now(),
        ]);

        $response = $this->actingAs($nurse)->get('/intervention');
        $response->assertStatus(200);
        $response->assertSee('Butterfly Hug');
        $response->assertSee('Stimulasi Bilateral Terpadu');
    }

    public function test_tinggi_pre_test_routes_to_high_burnout_alert(): void
    {
        $nurse = $this->createNurse();

        Assessment::create([
            'user_id' => $nurse->id,
            'type' => 'pre_test',
            'status' => 'completed',
            'total_score' => 110,
            'percentage' => 83.33,
            'category' => 'Tinggi',
            'created_at' => now(),
        ]);

        $response = $this->actingAs($nurse)->get('/intervention');
        $response->assertStatus(200);
        $response->assertSee('Peringatan Klinis');
        $response->assertSee('Konseling Psikoterapi');
        $response->assertSee('Keselamatan Pasien');
    }

    public function test_submitting_eft_intervention_saves_and_redirects_to_game(): void
    {
        $nurse = $this->createNurse();

        $response = $this->actingAs($nurse)->post('/intervention', [
            'type' => 'eft',
            'duration_seconds' => 120,
            'tension_before' => 6,
            'tension_after' => 2,
            'notes' => 'EFT Session',
        ]);

        $response->assertRedirect(route('game.play'));
        $this->assertDatabaseHas('interventions', [
            'user_id' => $nurse->id,
            'type' => 'eft',
            'tension_before' => 6,
            'tension_after' => 2,
        ]);
    }

    public function test_high_burnout_nurse_is_halted_at_warning_and_cannot_proceed_to_next_steps(): void
    {
        $nurse = $this->createNurse();

        $preTest = Assessment::create([
            'user_id' => $nurse->id,
            'type' => 'pre_test',
            'status' => 'completed',
            'total_score' => 110,
            'percentage' => 83.33,
            'category' => 'Tinggi',
            'created_at' => now(),
        ]);

        // Viewing intervention creates counseling_alert record automatically
        $response = $this->actingAs($nurse)->get('/intervention');
        $response->assertStatus(200);
        $response->assertSee('Evaluasi Dihentikan');
        $response->assertDontSee('Lanjut ke Game Katarsis');

        $this->assertDatabaseHas('interventions', [
            'user_id' => $nurse->id,
            'type' => 'counseling_alert',
        ]);

        // Attempting to visit Game, Thank You Card, or Post-Test redirects back to warning
        $gameResp = $this->actingAs($nurse)->get('/game/play');
        $gameResp->assertRedirect(route('intervention.create'));

        $thankYouResp = $this->actingAs($nurse)->get('/thank-you');
        $thankYouResp->assertRedirect(route('intervention.create'));

        $postTestResp = $this->actingAs($nurse)->get('/assessment/post-test');
        $postTestResp->assertRedirect(route('intervention.create'));

        // Nurse CAN retake pre-test from the beginning
        $retakePageResp = $this->actingAs($nurse)->get('/assessment/pre-test?retake=1');
        $retakePageResp->assertStatus(200);

        // Submitting new pre-test resets cycle (e.g. to Sedang)
        $newAnswers = [];
        for ($i = 1; $i <= 22; $i++) {
            $newAnswers[$i] = 3;
        }
        $submitRetake = $this->actingAs($nurse)->post('/assessment/pre-test', [
            'answers' => $newAnswers,
        ]);
        $latestAssessment = Assessment::where('user_id', $nurse->id)->latest('id')->first();
        $this->assertEquals('Sedang', $latestAssessment->category);
        $submitRetake->assertRedirect(route('pre-test.result', $latestAssessment->id));
    }
}
