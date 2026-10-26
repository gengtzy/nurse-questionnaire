<?php

namespace App\Http\Controllers;

use App\Models\ThankYouCard;
use App\Models\User;
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
    ];

    /**
     * Show the Thank You Card creation form.
     */
    public function create(): View
    {
        $user = Auth::user();

        // Get colleague perawat in UBK 2 as auto-suggest options
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
            'recipient_name' => ['required', 'string', 'max:100'],
            'message' => ['required', 'string', 'max:500'],
        ], [
            'recipient_name.required' => 'Silakan masukkan nama rekan perawat.',
            'message.required' => 'Silakan pilih atau masukkan pesan terima kasih.',
        ]);

        Auth::user()->thankYouCards()->create([
            'recipient_name' => trim($validated['recipient_name']),
            'message' => trim($validated['message']),
        ]);

        return redirect()->route('post-test.create')
            ->with('success', 'Kartu terima kasih untuk rekan berhasil disimpan! Silakan lanjutkan ke evaluasi kuesioner akhir (Post-test).');
    }
}
