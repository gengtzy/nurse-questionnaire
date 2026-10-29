<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Intervention;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class InterventionController extends Controller
{
    /**
     * Display the appropriate relaxation intervention page based on Pre-Test burnout level (Step 2).
     * - Rendah: Relaksasi EFT (Emotional Freedom Technique)
     * - Sedang: Butterfly Hug (3 Menit)
     * - Tinggi: Peringatan Klinis & Konseling Psikoterapi
     */
    public function create(Request $request): View|RedirectResponse
    {
        $user = Auth::user();

        if ($user && $user->role === 'Kepala Ruangan') {
            return redirect()->route('admin.rekap');
        }

        $latestPreTest = Assessment::where('user_id', $user->id)
            ->where('type', 'pre_test')
            ->where('status', 'completed')
            ->latest()
            ->first();

        // Must complete Pre-test first
        if (! $latestPreTest) {
            return redirect()->route('pre-test.create')
                ->with('info', 'Silakan selesaikan Tahap 1: Kuesioner Awal (Pre-test) terlebih dahulu sebelum memulai sesi intervensi.');
        }

        $latestIntervention = $user->interventions()->latest()->first();
        $totalSessions = $user->interventions()->count();

        $category = $latestPreTest->category ?? 'Sedang';

        if ($category === 'Rendah') {
            return view('intervention.eft', [
                'user' => $user,
                'latestPreTest' => $latestPreTest,
                'latestIntervention' => $latestIntervention,
                'totalSessions' => $totalSessions,
            ]);
        }

        if ($category === 'Tinggi') {
            return view('intervention.high-alert', [
                'user' => $user,
                'latestPreTest' => $latestPreTest,
                'latestIntervention' => $latestIntervention,
                'totalSessions' => $totalSessions,
            ]);
        }

        // Default: Sedang -> Butterfly Hug
        return view('intervention.butterfly-hug', [
            'user' => $user,
            'latestPreTest' => $latestPreTest,
            'latestIntervention' => $latestIntervention,
            'totalSessions' => $totalSessions,
        ]);
    }

    /**
     * Store the completed intervention session metrics.
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'type' => ['nullable', 'string', 'in:eft,butterfly_hug,counseling_alert'],
            'tension_before' => ['required', 'integer', 'between:0,10'],
            'tension_after' => ['required', 'integer', 'between:0,10'],
            'duration_seconds' => ['nullable', 'integer', 'min:10', 'max:600'],
            'tempo_ms' => ['nullable', 'integer'],
            'taps_count' => ['nullable', 'integer', 'min:0'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $before = (int) $validated['tension_before'];
        $after = (int) $validated['tension_after'];
        $diff = $before - $after;
        $type = $validated['type'] ?? 'butterfly_hug';

        $intervention = Intervention::create([
            'user_id' => $user->id,
            'type' => $type,
            'tension_before' => $before,
            'tension_after' => $after,
            'tension_diff' => $diff,
            'duration_seconds' => isset($validated['duration_seconds']) ? (int) $validated['duration_seconds'] : 180,
            'tempo_ms' => isset($validated['tempo_ms']) ? (int) $validated['tempo_ms'] : 1000,
            'taps_count' => isset($validated['taps_count']) ? (int) $validated['taps_count'] : 0,
            'completed' => true,
            'notes' => $validated['notes'] ?? null,
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Sesi intervensi berhasil disimpan.',
                'intervention' => $intervention,
                'next_url' => route('game.play'),
            ]);
        }

        $typeLabel = match ($type) {
            'eft' => 'Relaksasi EFT',
            'counseling_alert' => 'Peringatan & Rujukan Konseling',
            default => 'Butterfly Hug',
        };

        $reductionMsg = $diff > 0
            ? "Tingkat ketegangan Anda berhasil turun {$diff} poin (dari {$before} menjadi {$after})."
            : "Sesi {$typeLabel} selesai.";

        return redirect()->route('game.play')
            ->with('success', "{$reductionMsg} Silakan lanjutkan ke Tahap 3: Main Game 'Hancurkan Stres'.");
    }
}
