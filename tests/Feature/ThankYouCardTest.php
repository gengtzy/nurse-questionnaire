<?php

namespace Tests\Feature;

use App\Models\Assessment;
use App\Models\GameLog;
use App\Models\Intervention;
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
        $response->assertSee('Kirim Pesan Apresiasi untuk Rekan');
        $response->assertSee('Terima kasih sudah membantu saya hari ini.');
        $response->assertSee('Terima kasih sudah tenang dan sabar menghadapi pasien tadi.');
        $response->assertSee('Terima kasih sudah menggantikan saya saat saya butuh jeda.');
        $response->assertSee('Terima kasih sudah mengingatkan saya untuk minum dan istirahat.');
        $response->assertSee('Kerja kamu hari ini sangat berarti bagi pasien kita.');
        $response->assertSee('Yunia Mariska, A.Md.Kep');
    }

    public function test_submitting_thank_you_card_stores_in_database_and_redirects_to_post_test(): void
    {
        $nurse1 = $this->createNurseUser('Ira Gusyanda, A.Md.Kep');
        $nurse2 = $this->createNurseUser('Elis Sari Ningrum, A.Md.Kep');

        $response = $this->actingAs($nurse1)->post('/thank-you', [
            'recipient_id' => $nurse2->id,
            'message' => 'Terima kasih sudah tenang dan sabar menghadapi pasien tadi.',
        ]);

        $response->assertRedirect(route('post-test.create'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('thank_you_cards', [
            'user_id' => $nurse1->id,
            'recipient_id' => $nurse2->id,
            'recipient_name' => 'Elis Sari Ningrum, A.Md.Kep',
            'message' => 'Terima kasih sudah tenang dan sabar menghadapi pasien tadi.',
            'is_read' => false,
        ]);
    }

    public function test_recipient_nurse_sees_inbox_and_can_mark_as_read(): void
    {
        $sender = $this->createNurseUser('Ira Gusyanda, A.Md.Kep');
        $recipient = $this->createNurseUser('Elis Sari Ningrum, A.Md.Kep');

        $card = ThankYouCard::create([
            'user_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'recipient_name' => $recipient->name,
            'message' => 'Semangat dinas sore ya rekan!',
            'is_read' => false,
        ]);

        // Recipient views dashboard and navbar contains inbox modal
        $response = $this->actingAs($recipient)->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Semangat dinas sore ya rekan!');
        $response->assertSee('Ira Gusyanda, A.Md.Kep');

        // Mark as read
        $markResponse = $this->actingAs($recipient)->postJson('/thank-you/mark-as-read');
        $markResponse->assertStatus(200);
        $markResponse->assertJson(['success' => true]);

        $this->assertDatabaseHas('thank_you_cards', [
            'id' => $card->id,
            'is_read' => true,
        ]);
    }

    public function test_recipient_nurse_can_mark_single_message_as_read(): void
    {
        $sender = $this->createNurseUser('Ira Gusyanda, A.Md.Kep');
        $recipient = $this->createNurseUser('Elis Sari Ningrum, A.Md.Kep');

        $card = ThankYouCard::create([
            'user_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'recipient_name' => $recipient->name,
            'message' => 'Terima kasih atas bantuannya tadi.',
            'is_read' => false,
        ]);

        $response = $this->actingAs($recipient)->postJson("/thank-you/{$card->id}/mark-read");
        $response->assertStatus(200);
        $response->assertJson(['success' => true, 'unread_count' => 0]);

        $this->assertDatabaseHas('thank_you_cards', [
            'id' => $card->id,
            'is_read' => true,
        ]);
    }

    public function test_recipient_nurse_can_reply_to_message_and_create_new_card(): void
    {
        $sender = $this->createNurseUser('Ira Gusyanda, A.Md.Kep');
        $recipient = $this->createNurseUser('Elis Sari Ningrum, A.Md.Kep');

        // Sender sends card to recipient
        ThankYouCard::create([
            'user_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'recipient_name' => $recipient->name,
            'message' => 'Terima kasih sudah kompak selama shift.',
            'is_read' => false,
        ]);

        // Recipient replies back to sender
        $replyResponse = $this->actingAs($recipient)->postJson('/thank-you/reply', [
            'recipient_id' => $sender->id,
            'message' => 'Sama-sama, senang bisa saling bantu dan jaga shift bareng!',
        ]);

        $replyResponse->assertStatus(200);
        $replyResponse->assertJson(['success' => true]);

        // Check new card created with recipient = sender
        $this->assertDatabaseHas('thank_you_cards', [
            'user_id' => $recipient->id,
            'recipient_id' => $sender->id,
            'recipient_name' => $sender->name,
            'message' => 'Sama-sama, senang bisa saling bantu dan jaga shift bareng!',
            'is_read' => false,
        ]);

        // Sender can now see the reply in their dashboard
        $senderDash = $this->actingAs($sender)->get('/dashboard');
        $senderDash->assertStatus(200);
        $senderDash->assertSee('Sama-sama, senang bisa saling bantu dan jaga shift bareng!');
    }

    public function test_karu_rekap_dashboard_does_not_contain_pesan_column(): void
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

        Intervention::create([
            'user_id' => $nurse->id,
            'type' => 'butterfly_hug',
            'duration_seconds' => 180,
            'taps_count' => 180,
            'tension_before' => 7,
            'tension_after' => 3,
            'created_at' => now()->subMinutes(25),
        ]);

        GameLog::create([
            'user_id' => $nurse->id,
            'score' => 1500,
            'items_smashed' => 40,
            'duration_seconds' => 30,
            'boss_defeated' => true,
            'created_at' => now()->subMinutes(20),
        ]);

        ThankYouCard::create([
            'user_id' => $nurse->id,
            'recipient_name' => 'Wendi Sunjana, S.Kep.,Ners',
            'message' => 'Kerja kamu hari ini sangat berarti bagi pasien kita.',
            'created_at' => now()->subMinutes(15),
        ]);

        Assessment::create([
            'user_id' => $nurse->id,
            'type' => 'post_test',
            'status' => 'completed',
            'total_score' => 45,
            'percentage' => 34.09,
            'category' => 'Rendah',
            'created_at' => now()->subMinutes(10),
        ]);

        // Rekap HTML view: column 'Kartu Terima Kasih' was removed as requested
        $response = $this->actingAs($karu)->get('/admin/rekap-data');
        $response->assertStatus(200);
        $response->assertDontSee('Kartu Terima Kasih');
        $response->assertSee('Intervensi Relaksasi');

        // CSV export: no Thank You Card column
        $csvResponse = $this->actingAs($karu)->get('/admin/rekap-data/export?format=csv');
        $csvResponse->assertStatus(200);
        $csvContent = $csvResponse->streamedContent();
        $this->assertStringNotContainsString('Kartu_Terima_Kasih_Penerima', $csvContent);
        $this->assertStringContainsString('Intervensi_Tipe', $csvContent);

        // Excel export: no Thank You Card column
        $excelResponse = $this->actingAs($karu)->get('/admin/rekap-data/export?format=excel');
        $excelResponse->assertStatus(200);
        $excelContent = $excelResponse->getContent();
        $this->assertStringNotContainsString('KARTU TERIMA KASIH', $excelContent);
        $this->assertStringContainsString('INTERVENSI', $excelContent);
    }
}
