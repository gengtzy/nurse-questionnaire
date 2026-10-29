<?php

namespace App\Http\Controllers;

use App\Models\ThankYouCard;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ThankYouCardController extends Controller
{
    /**
     * Standard appreciation message options.
     */
    public const PRESET_MESSAGES = [
        'Terima kasih sudah membantu saya hari ini.',
        'Terima kasih sudah tenang dan sabar menghadapi pasien tadi.',
        'Terima kasih sudah menggantikan saya saat saya butuh jeda.',
        'Terima kasih sudah mengingatkan saya untuk minum dan istirahat.',
        'Kerja kamu hari ini sangat berarti bagi pasien kita.',
        'Terima kasih sudah kompak dan saling dukung selama shift.',
    ];

    /**
     * Show the Thank You Card creation form.
     */
    public function create(): View
    {
        $user = Auth::user();

        // Get colleague nurses in UBK 2 (excluding Karu and self)
        $colleagues = User::where('id', '!=', $user->id)
            ->where('role', '!=', 'Kepala Ruangan')
            ->orderBy('name')
            ->get();

        $messages = self::PRESET_MESSAGES;

        return view('thank-you.create', compact('user', 'colleagues', 'messages'));
    }

    /**
     * Store a newly created Thank You Card and proceed to Post-Test.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'recipient_id' => ['required', 'exists:users,id'],
            'message' => ['required', 'string', 'max:500'],
        ], [
            'recipient_id.required' => 'Silakan pilih rekan perawat penerima dari daftar.',
            'recipient_id.exists' => 'Perawat penerima yang dipilih tidak valid.',
            'message.required' => 'Silakan pilih atau masukkan pesan apresiasi.',
        ]);

        $recipient = User::where('id', $validated['recipient_id'])
            ->where('role', '!=', 'Kepala Ruangan')
            ->firstOrFail();

        Auth::user()->thankYouCards()->create([
            'recipient_id' => $recipient->id,
            'recipient_name' => $recipient->name,
            'message' => trim($validated['message']),
            'is_read' => false,
        ]);

        return redirect()->route('post-test.create')
            ->with('success', "Pesan apresiasi berhasil dikirim ke akun {$recipient->name}! Silakan lanjutkan ke evaluasi kuesioner akhir (Post-test).");
    }

    /**
     * Mark all received thank you cards as read.
     */
    public function markAsRead(Request $request): JsonResponse
    {
        Auth::user()->receivedThankYouCards()
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Semua pesan ditandai telah dibaca.',
        ]);
    }
}
