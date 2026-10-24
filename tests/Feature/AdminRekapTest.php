<?php

namespace Tests\Feature;

use App\Models\Assessment;
use App\Models\GameLog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminRekapTest extends TestCase
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
        $response = $this->get('/admin/rekap-data');
        $response->assertRedirect('/login');
    }

    public function test_nurse_cannot_access_karu_rekap_dashboard(): void
    {
        $nurse = $this->createNurseUser();

        $response = $this->actingAs($nurse)->get('/admin/rekap-data');
        $response->assertRedirect('/dashboard');
        $response->assertSessionHas('error');
    }

    public function test_karu_can_access_rekap_dashboard(): void
    {
        $karu = $this->createKaruUser();

        $response = $this->actingAs($karu)->get('/admin/rekap-data');

        $response->assertStatus(200);
        $response->assertSee('Monitoring Burnout');
        $response->assertSee('Kesejahteraan Perawat');
        $response->assertSee('Unduh Excel (.xls)');
        $response->assertSee('CSV');
        $response->assertDontSee('spss');
    }

    public function test_multi_session_evaluations_are_both_reported(): void
    {
        $karu = $this->createKaruUser();
        $nurse = $this->createNurseUser('Testuserperawat');

        // Session 1: Pre-test + Game + Post-test (Morning)
        $pre1 = Assessment::create([
            'user_id' => $nurse->id,
            'type' => 'pre_test',
            'status' => 'completed',
            'total_score' => 66,
            'percentage' => 50.0,
            'category' => 'Sedang',
            'created_at' => now()->subHours(6),
        ]);
        GameLog::create([
            'user_id' => $nurse->id,
            'score' => 1200,
            'stress_items_cleared' => 30,
            'duration_seconds' => 30,
            'boss_defeated' => true,
            'created_at' => now()->subHours(5),
        ]);
        $post1 = Assessment::create([
            'user_id' => $nurse->id,
            'type' => 'post_test',
            'status' => 'completed',
            'total_score' => 64,
            'percentage' => 48.48,
            'category' => 'Sedang',
            'created_at' => now()->subHours(5),
        ]);

        // Session 2: Pre-test + Game + Post-test (Afternoon)
        $pre2 = Assessment::create([
            'user_id' => $nurse->id,
            'type' => 'pre_test',
            'status' => 'completed',
            'total_score' => 70,
            'percentage' => 53.03,
            'category' => 'Sedang',
            'created_at' => now()->subHours(2),
        ]);
        GameLog::create([
            'user_id' => $nurse->id,
            'score' => 1500,
            'stress_items_cleared' => 40,
            'duration_seconds' => 30,
            'boss_defeated' => true,
            'created_at' => now()->subHour(),
        ]);
        $post2 = Assessment::create([
            'user_id' => $nurse->id,
            'type' => 'post_test',
            'status' => 'completed',
            'total_score' => 55,
            'percentage' => 41.67,
            'category' => 'Sedang',
            'created_at' => now()->subHour(),
        ]);

        $response = $this->actingAs($karu)->get('/admin/rekap-data');
        $response->assertStatus(200);

        // Both sessions should be visible
        $response->assertSee('Pengisian ke-1');
        $response->assertSee('Pengisian ke-2');
    }

    public function test_export_styled_excel_with_date_range_filter(): void
    {
        $karu = $this->createKaruUser();

        $response = $this->actingAs($karu)
            ->get('/admin/rekap-data/export?format=excel&start_date=2026-10-01&end_date=2026-10-31');

        $response->assertStatus(200);
        $this->assertStringContainsString('application/vnd.ms-excel', $response->headers->get('Content-Type'));
        $this->assertStringContainsString('RSUD WELAS ASIH', $response->getContent());
        $this->assertStringContainsString('Periode Laporan', $response->getContent());
        $this->assertStringContainsString('01/10/2026 s/d 31/10/2026', $response->getContent());
    }

    public function test_export_standard_csv(): void
    {
        $karu = $this->createKaruUser();

        $response = $this->actingAs($karu)
            ->get('/admin/rekap-data/export?format=csv&delimiter=,');

        $response->assertStatus(200);
        $this->assertStringContainsString('text/csv', $response->headers->get('Content-Type'));
    }

    public function test_karu_redirected_to_admin_rekap_from_dashboard(): void
    {
        $karu = $this->createKaruUser();

        $response = $this->actingAs($karu)->get('/dashboard');
        $response->assertRedirect(route('admin.rekap'));
    }
}
