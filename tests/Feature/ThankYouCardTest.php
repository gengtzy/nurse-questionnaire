<?php

namespace Tests\Feature;

use App\Models\Assessment;
use App\Models\GameLog;
use App\Models\ThankYouCard;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThankYouCardTest extends TestCase
{
    use RefreshDatabase;

    protected function createKaruUser(): User
    {
        return User::create([
            'name' => 'Oom Umriah,S.Kep.,Ners',
            'role' => 'Kepala Ruangan',
            'room' => 'Ruang Umar Bin Khattab 2',
            'password' => bcrypt('karu123'),
        ]);
    }

    protected function createNurseUser(string $name = 'Ira Gusyanda, A.Md.Kep'): User
    {
        return User::create([
            'name' => $name,
            'role' => 'Perawat',
            'room' => 'Ruang Umar Bin Khattab 2',
            'password' => bcrypt('perawat123'),
        ]);
    }

    public function test_unauthenticated_user_redirected_to_login(): void
    {
        $response = $this->get('/thank-you');
        $response->assertRedirect('/login');
    }

    public function test_nurse_can_view_thank_you_form_with_presets(): void
    {
        $nurse1 = $this->createNurseUser('Ira Gusyanda, A.Md.Kep');
        $nurse2 = $this->createNurseUser('Yunia Mariska, A.Md.Kep');

        $response = $this->actingAs($nurse1)->get('/thank-you');

        $response->assertStatus(200);
        $response->assertSee('Kartu terima kasih untuk rekan');
        $response->assertSee('Terima kasih sudah membantu saya hari ini.');
        $response->assertSee('Terima kasih sudah tenang dan sabar menghadapi pasien tadi.');
        $response->assertSee('Terima kasih sudah menggantikan saya saat saya butuh jeda.');
        $response->assertSee('Terima kasih sudah mengingatkan saya untuk minum dan istirahat.');
        $response->assertSee('Kerja kamu hari ini sangat berarti bagi pasien kita.');
        $response->assertSee('Yunia Mariska, A.Md.Kep');
    }

    public function test_submitting_thank_you_card_stores_in_database_and_redirects_to_post_test(): void
    {
        $nurse = $this->createNurseUser('Testuserperawat');

        $response = $this->actingAs($nurse)->post('/thank-you', [
            'recipient_name' => 'Elis Sari Ningrum, A.Md.Kep',
            'message' => 'Terima kasih sudah tenang dan sabar menghadapi pasien tadi.',
        ]);

        $response->assertRedirect(route('post-test.create'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('thank_you_cards', [
            'user_id' => $nurse->id,
            'recipient_name' => 'Elis Sari Ningrum, A.Md.Kep',
            'message' => 'Terima kasih sudah tenang dan sabar menghadapi pasien tadi.',
        ]);
    }

    public function test_karu_can_see_thank_you_card_in_rekap_dashboard_and_csv(): void
    {
        $karu = $this->createKaruUser();
        $nurse = $this->createNurseUser('Rully Nasrulloh S, S.Kep.,Ners');

        Assessment::create([
            'user_id' => $nurse->id,
            'type' => 'pre_test',
            'status' => 'completed',
            'total_score' => 60,
            'percentage' => 45.45,
            'category' => 'Sedang',
            'created_at' => now()->subMinutes(30),
        ]);

        GameLog::create([
            'user_id' => $nurse->id,
            'score' => 1500,
            'items_smashed' => 40,
            'duration_seconds' => 30,
            'boss_defeated' => true,
            'created_at' => now()->subMinutes(25),
        ]);

        ThankYouCard::create([
            'user_id' => $nurse->id,
            'recipient_name' => 'Wendi Sunjana, S.Kep.,Ners',
            'message' => 'Kerja kamu hari ini sangat berarti bagi pasien kita.',
            'created_at' => now()->subMinutes(20),
        ]);

        Assessment::create([
            'user_id' => $nurse->id,
            'type' => 'post_test',
            'status' => 'completed',
            'total_score' => 45,
            'percentage' => 34.09,
            'category' => 'Rendah',
            'created_at' => now()->subMinutes(15),
        ]);

        // Rekap HTML view
        $response = $this->actingAs($karu)->get('/admin/rekap-data');
        $response->assertStatus(200);
        $response->assertSee('Kartu Terima Kasih');
        $response->assertSee('Wendi Sunjana, S.Kep.,Ners');

        // CSV export
        $csvResponse = $this->actingAs($karu)->get('/admin/rekap-data/export?format=csv');
        $csvResponse->assertStatus(200);
        $csvContent = $csvResponse->streamedContent();
        $this->assertStringContainsString('Kartu_Terima_Kasih_Penerima', $csvContent);
        $this->assertStringContainsString('Wendi Sunjana, S.Kep.,Ners', $csvContent);
        $this->assertStringContainsString('Kerja kamu hari ini sangat berarti bagi pasien kita.', $csvContent);

        // Excel export
        $excelResponse = $this->actingAs($karu)->get('/admin/rekap-data/export?format=excel');
        $excelResponse->assertStatus(200);
        $excelContent = $excelResponse->getContent();
        $this->assertStringContainsString('KARTU TERIMA KASIH', $excelContent);
        $this->assertStringContainsString('Wendi Sunjana, S.Kep.,Ners', $excelContent);
    }
}
