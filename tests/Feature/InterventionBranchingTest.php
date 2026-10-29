<?php

namespace Tests\Feature;

use App\Models\Assessment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InterventionBranchingTest extends TestCase
{
    use RefreshDatabase;

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
}
