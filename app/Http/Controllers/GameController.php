<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\GameLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GameController extends Controller
{
    /**
     * Display the stress-relief mini game page.
     */
    public function play(): View
    {
        $user = Auth::user();

        // Get latest pre-test assessment
        $latestPreTest = Assessment::where('user_id', $user->id)
            ->where('type', 'pre_test')
            ->where('status', 'completed')
            ->latest()
            ->first();

        // Get best game score and total games played
        $bestScore = GameLog::where('user_id', $user->id)->max('score') ?? 0;
        $totalPlayed = GameLog::where('user_id', $user->id)->count();
        $totalSmashed = GameLog::where('user_id', $user->id)->sum('items_smashed');

        return view('game.play', [
            'user' => $user,
            'latestPreTest' => $latestPreTest,
            'bestScore' => $bestScore,
            'totalPlayed' => $totalPlayed,
            'totalSmashed' => $totalSmashed,
        ]);
    }

    /**
     * Store completed game session metrics.
     */
    public function storeLog(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'score' => ['required', 'integer', 'min:0'],
            'items_smashed' => ['required', 'integer', 'min:0'],
            'max_combo' => ['required', 'integer', 'min:0'],
            'duration_seconds' => ['required', 'integer', 'min:10'],
            'boss_defeated' => ['nullable', 'boolean'],
        ]);

        $user = Auth::user();

        $latestPreTest = Assessment::where('user_id', $user->id)
            ->where('type', 'pre_test')
            ->where('status', 'completed')
            ->latest()
            ->first();

        $gameLog = GameLog::create([
            'user_id' => $user->id,
            'assessment_id' => $latestPreTest?->id,
            'score' => $validated['score'],
            'items_smashed' => $validated['items_smashed'],
            'max_combo' => $validated['max_combo'],
            'duration_seconds' => $validated['duration_seconds'],
            'boss_defeated' => (bool) ($validated['boss_defeated'] ?? false),
            'played_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Aktivitas game berhasil disimpan.',
            'log_id' => $gameLog->id,
            'score' => $gameLog->score,
        ]);
    }
}
