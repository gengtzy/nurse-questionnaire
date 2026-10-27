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
     * Display the Butterfly Hug relaxation intervention page (Step 2).
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
                ->with('info', 'Silakan selesaikan Tahap 1: Kuesioner Awal (Pre-test) terlebih dahulu sebelum memulai intervensi Butterfly Hug.');
        }

        $latestIntervention = $user->interventions()->latest()->first();
        $totalSessions = $user->interventions()->count();

        return view('intervention.butterfly-hug', [
            'user' => $user,
            'latestPreTest' => $latestPreTest,
            'latestIntervention' => $latestIntervention,
            'totalSessions' => $totalSessions,
        ]);
    }

    /**
     * Store the completed Butterfly Hug session metrics.
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'tension_before' => ['required', 'integer', 'between:0,10'],
            'tension_after' => ['required', 'integer', 'between:0,10'],
            'duration_seconds' => ['required', 'integer', 'min:10', 'max:600'],
            'tempo_ms' => ['nullable', 'integer', 'in:1000,1600'],
            'taps_count' => ['nullable', 'integer', 'min:0'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $before = (int) $validated['tension_before'];
        $after = (int) $validated['tension_after'];
        $diff = $before - $after;

        $intervention = Intervention::create([
            'user_id' => $user->id,
            'type' => 'butterfly_hug',
            'tension_before' => $before,
            'tension_after' => $after,
            'tension_diff' => $diff,
            'duration_seconds' => (int) $validated['duration_seconds'],
            'tempo_ms' => isset($validated['tempo_ms']) ? (int) $validated['tempo_ms'] : 1600,
            'taps_count' => isset($validated['taps_count']) ? (int) $validated['taps_count'] : 0,
            'completed' => true,
            'notes' => $validated['notes'] ?? null,
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Sesi intervensi Butterfly Hug berhasil disimpan.',
                'intervention' => $intervention,
                'next_url' => route('game.play'),
            ]);
        }

        $reductionMsg = $diff > 0
            ? "Tingkat ketegangan Anda berhasil turun {$diff} poin (dari {$before} menjadi {$after})."
            : "Sesi relaksasi Butterfly Hug selesai.";

        return redirect()->route('game.play')
            ->with('success', "{$reductionMsg} Silakan lanjutkan ke Tahap 3: Main Game 'Hancurkan Stres'.");
    }
}
