<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    /**
     * Display the Monitoring & Rekapitulasi dashboard for Kepala Ruangan.
     */
    public function index(Request $request): View|RedirectResponse
    {
        if ($request->user() && $request->user()->role !== 'Kepala Ruangan') {
            return redirect()->route('dashboard')->with('error', 'Hanya Kepala Ruangan yang memiliki akses ke halaman monitoring & rekapitulasi.');
        }

        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $records = $this->getRekapRecords($startDate, $endDate);
        $stats = $this->calculateStatistics($records);

        return view('admin.rekap-data', [
            'records' => $records,
            'stats' => $stats,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'user' => Auth::user(),
        ]);
    }

    /**
     * Export all data to Excel (.xls) or CSV format with date range filter.
     */
    public function export(Request $request): HttpResponse|StreamedResponse|RedirectResponse
    {
        if ($request->user() && $request->user()->role !== 'Kepala Ruangan') {
            return redirect()->route('dashboard')->with('error', 'Hanya Kepala Ruangan yang memiliki akses untuk mengunduh rekap.');
        }

        $format = $request->query('format', 'excel'); // 'excel' or 'csv'
        $delimiter = $request->query('delimiter', ',');
        if ($delimiter !== ';' && $delimiter !== ',') {
            $delimiter = ',';
        }

        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $records = $this->getRekapRecords($startDate, $endDate);

        $periodLabel = 'Semua Periode';
        if (! empty($startDate) && ! empty($endDate)) {
            $periodLabel = Carbon::parse($startDate)->format('d/m/Y').' s/d '.Carbon::parse($endDate)->format('d/m/Y');
        } elseif (! empty($startDate)) {
            $periodLabel = 'Mulai '.Carbon::parse($startDate)->format('d/m/Y');
        } elseif (! empty($endDate)) {
            $periodLabel = 'Sampai '.Carbon::parse($endDate)->format('d/m/Y');
        }

        if ($format === 'csv') {
            return $this->exportStandardCsv($records, $delimiter, $periodLabel);
        }

        // Formatted Excel (.xls)
        return $this->exportExcelStyled($records, $periodLabel);
    }

    /**
     * Generate visually styled Microsoft Excel Spreadsheet (.xls)
     */
    protected function exportExcelStyled(array $records, string $periodLabel): HttpResponse
    {
        $timestamp = now()->setTimezone('Asia/Jakarta')->format('Ymd_His');
        $filename = "rekapitulasi_burnout_nurse_recharge_{$timestamp}.xls";

        $html = view('admin.exports.excel-table', [
            'records' => $records,
            'exportDate' => now()->setTimezone('Asia/Jakarta')->format('d/m/Y H:i').' WIB',
            'periodLabel' => $periodLabel,
        ])->render();

        return response($html, 200, [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ]);
    }

    /**
     * Export clean universal CSV with UTF-8 BOM.
     */
    protected function exportStandardCsv(array $records, string $delimiter, string $periodLabel): StreamedResponse
    {
        $timestamp = now()->setTimezone('Asia/Jakarta')->format('Ymd_His');
        $filename = "rekapitulasi_burnout_nurse_recharge_{$timestamp}.csv";

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return Response::stream(function () use ($records, $delimiter) {
            $handle = fopen('php://output', 'w');

            // UTF-8 BOM
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

            // Inform Excel of the delimiter directly
            fwrite($handle, "sep={$delimiter}\r\n");

            $headerRow = [
                'No',
                'Nama Perawat',
                'Jabatan',
                'Ruangan',
                'Sesi Pengisian',
                'Status Data',
                'Pre_Total_Skor',
                'Pre_Persen_Burnout',
                'Pre_Kategori',
                'Pre_EE_Kelelahan_Emosional',
                'Pre_DP_Depersonalisasi',
                'Pre_PA_Pencapaian_Diri',
                'Intervensi_Tegang_Sebelum',
                'Intervensi_Tegang_Sesudah',
                'Intervensi_Penurunan_Tegang',
                'Intervensi_Durasi_Detik',
                'Intervensi_Tepukan',
                'Game_Durasi_Detik',
                'Game_Skor_Poin',
                'Game_Beban_Hancur',
                'Game_Max_Combo',
                'Game_Status_Boss',
                'Kartu_Terima_Kasih_Penerima',
                'Kartu_Terima_Kasih_Pesan',
                'Post_Total_Skor',
                'Post_Persen_Burnout',
                'Post_Kategori',
                'Post_EE_Kelelahan_Emosional',
                'Post_DP_Depersonalisasi',
                'Post_PA_Pencapaian_Diri',
                'Delta_Skor_Total',
                'Delta_Persen_Burnout',
                'Delta_EE',
                'Delta_DP',
                'Delta_PA',
                'Interpretasi_Klinis',
                'Waktu_Selesai',
            ];
            fputcsv($handle, $headerRow, $delimiter);

            $no = 1;
            foreach ($records as $r) {
                $row = [
                    $no++,
                    $r['name'],
                    $r['role'],
                    $r['room'],
                    $r['session_label'],
                    $r['status_label'],
                    $r['pre_total'] ?? '',
                    $r['pre_percentage'] ?? '',
                    $r['pre_category'] ?? '',
                    $r['pre_ee'] ?? '',
                    $r['pre_dp'] ?? '',
                    $r['pre_pa'] ?? '',
                    $r['intervention_before'] ?? '',
                    $r['intervention_after'] ?? '',
                    $r['intervention_diff'] ?? '',
                    $r['intervention_duration'] ?? '',
                    $r['intervention_taps'] ?? '',
                    $r['game_duration'] ?? '',
                    $r['game_score'] ?? '',
                    $r['game_smashed'] ?? '',
                    $r['game_combo'] ?? '',
                    isset($r['game_boss']) ? ($r['game_boss'] ? 'Menang' : 'Selesai') : '',
                    $r['thank_you_recipient'] ?? '',
                    $r['thank_you_message'] ?? '',
                    $r['post_total'] ?? '',
                    $r['post_percentage'] ?? '',
                    $r['post_category'] ?? '',
                    $r['post_ee'] ?? '',
                    $r['post_dp'] ?? '',
                    $r['post_pa'] ?? '',
                    $r['diff_total'] ?? '',
                    $r['diff_percentage'] ?? '',
                    $r['diff_ee'] ?? '',
                    $r['diff_dp'] ?? '',
                    $r['diff_pa'] ?? '',
                    $r['verdict'] ?? '',
                    $r['completed_at'] ?? '',
                ];
                fputcsv($handle, $row, $delimiter);
            }

            fclose($handle);
        }, 200, $headers);
    }

    /**
     * Query all users and parse EVERY completed evaluation session (multi-submission support).
     */
    protected function getRekapRecords(?string $startDate = null, ?string $endDate = null): array
    {
        $startCarbon = ! empty($startDate) ? Carbon::parse($startDate)->startOfDay() : null;
        $endCarbon = ! empty($endDate) ? Carbon::parse($endDate)->endOfDay() : null;

        $users = User::where('role', '!=', 'Kepala Ruangan')
            ->with([
                'assessments' => fn ($q) => $q->where('status', 'completed')->orderBy('completed_at', 'asc'),
                'interventions' => fn ($q) => $q->orderBy('created_at', 'asc'),
                'gameLogs' => fn ($q) => $q->orderBy('created_at', 'asc'),
                'thankYouCards' => fn ($q) => $q->orderBy('created_at', 'asc'),
            ])
            ->orderBy('name')
            ->get();

        $records = [];

        foreach ($users as $user) {
            $assessments = $user->assessments;
            $preTests = $assessments->where('type', 'pre_test')->values();
            $postTests = $assessments->where('type', 'post_test')->values();
            $interventions = $user->interventions;
            $gameLogs = $user->gameLogs;
            $thankYouCards = $user->thankYouCards;

            $totalSessions = max($preTests->count(), $postTests->count(), $interventions->count());

            if ($totalSessions === 0) {
                // Nurse has not submitted anything yet
                // Only include if no specific date range is set, or include as not submitted
                if (! $startCarbon && ! $endCarbon) {
                    $records[] = [
                        'user_id' => $user->id,
                        'name' => $user->name,
                        'role' => $user->role,
                        'room' => $user->room,
                        'session_number' => 0,
                        'session_label' => 'Belum Ada Sesi',
                        'status_label' => 'Belum Mengisi',
                        'is_complete' => false,
                        'has_pre' => false,
                        'has_post' => false,
                        'has_intervention' => false,
                        'has_game' => false,
                        'has_thank_you' => false,
                        'thank_you_recipient' => null,
                        'thank_you_message' => null,

                        'pre_total' => null,
                        'pre_percentage' => null,
                        'pre_category' => null,
                        'pre_ee' => null,
                        'pre_dp' => null,
                        'pre_pa' => null,

                        'intervention_type' => null,
                        'intervention_before' => null,
                        'intervention_after' => null,
                        'intervention_diff' => null,
                        'intervention_duration' => null,
                        'intervention_tempo' => null,
                        'intervention_taps' => null,

                        'game_duration' => null,
                        'game_score' => null,
                        'game_smashed' => null,
                        'game_combo' => null,
                        'game_boss' => null,

                        'post_total' => null,
                        'post_percentage' => null,
                        'post_category' => null,
                        'post_ee' => null,
                        'post_dp' => null,
                        'post_pa' => null,

                        'diff_total' => null,
                        'diff_percentage' => null,
                        'diff_ee' => null,
                        'diff_dp' => null,
                        'diff_pa' => null,
                        'verdict' => '-',

                        'completed_at' => null,
                        'completed_carbon' => null,
                    ];
                }
                continue;
            }

            // Loop through each evaluation session of this user
            for ($i = 0; $i < $totalSessions; $i++) {
                $postTest = $postTests->get($i);
                $preTest = $preTests->get($i);

                $postTime = $postTest ? ($postTest->completed_at ?? $postTest->created_at) : null;
                $preTime = $preTest ? ($preTest->completed_at ?? $preTest->created_at) : null;

                // If preTest didn't match directly by index, find closest preceding preTest
                if ($postTest && ! $preTest && $postTime) {
                    $preTest = $preTests->filter(function ($pt) use ($postTime) {
                        $ptTime = $pt->completed_at ?? $pt->created_at;
                        return $ptTime && $ptTime->lte($postTime);
                    })->last();
                    if ($preTest) {
                        $preTime = $preTest->completed_at ?? $preTest->created_at;
                    }
                }

                // Match intervention between preTest and postTest
                $intervention = null;
                if ($postTest && $postTime) {
                    $minTime = $preTime ?? $postTime->copy()->subHours(2);
                    $maxTime = $postTime->copy()->addMinutes(15);
                    $intervention = $interventions
                        ->filter(fn($iv) => $iv->created_at && $iv->created_at->gte($minTime) && $iv->created_at->lte($maxTime))
                        ->last() ?? $interventions->get($i);
                } elseif ($preTest && $preTime) {
                    $intervention = $interventions->filter(fn($iv) => $iv->created_at && $iv->created_at->gte($preTime))->last() ?? $interventions->get($i);
                } else {
                    $intervention = $interventions->get($i);
                }

                // Match game log between intervention/preTest and postTest
                $gameLog = null;
                if ($postTest && $postTime) {
                    $minTime = $preTime ?? $postTime->copy()->subHours(2);
                    $maxTime = $postTime->copy()->addMinutes(5);
                    $gameLog = $gameLogs
                        ->filter(fn($g) => $g->created_at && $g->created_at->gte($minTime) && $g->created_at->lte($maxTime))
                        ->last() ?? $gameLogs->filter(fn($g) => $g->created_at && $g->created_at->lte($maxTime))->last();
                } elseif ($preTest && $preTime) {
                    $gameLog = $gameLogs->filter(fn($g) => $g->created_at && $g->created_at->gte($preTime))->last();
                }

                // Match thank you card between game/preTest and postTest
                $thankYouCard = null;
                if ($postTest && $postTime) {
                    $minTime = $preTime ?? $postTime->copy()->subHours(2);
                    $maxTime = $postTime->copy()->addMinutes(15);
                    $thankYouCard = $thankYouCards
                        ->filter(fn($ty) => $ty->created_at && $ty->created_at->gte($minTime) && $ty->created_at->lte($maxTime))
                        ->last() ?? $thankYouCards->get($i);
                } elseif ($preTest && $preTime) {
                    $thankYouCard = $thankYouCards->filter(fn($ty) => $ty->created_at && $ty->created_at->gte($preTime))->last() ?? $thankYouCards->get($i);
                } else {
                    $thankYouCard = $thankYouCards->get($i);
                }

                $sessionCompletedCarbon = $postTime ?? $preTime ?? ($intervention ? $intervention->created_at : null);

                // Check date range filter
                if ($startCarbon && $sessionCompletedCarbon && $sessionCompletedCarbon->lt($startCarbon)) {
                    continue;
                }
                if ($endCarbon && $sessionCompletedCarbon && $sessionCompletedCarbon->gt($endCarbon)) {
                    continue;
                }

                $isComplete = ($preTest !== null && $postTest !== null);

                $diffTotal = ($isComplete) ? ($postTest->total_score - $preTest->total_score) : null;
                $diffPercentage = ($isComplete) ? round($postTest->percentage - $preTest->percentage, 2) : null;
                $diffEE = ($isComplete) ? ($postTest->ee_score - $preTest->ee_score) : null;
                $diffDP = ($isComplete) ? ($postTest->dp_score - $preTest->dp_score) : null;
                $diffPA = ($isComplete) ? ($postTest->pa_score - $preTest->pa_score) : null;

                $verdict = '-';
                if ($isComplete) {
                    if ($diffPercentage < 0) {
                        $verdict = 'Membaik (Burnout Turun '.abs($diffPercentage).'%)';
                    } elseif ($diffPercentage == 0) {
                        $verdict = 'Stabil (0.0%)';
                    } else {
                        $verdict = 'Meningkat (+'.$diffPercentage.'%)';
                    }
                }

                $statusLabel = 'Belum Mengisi';
                if ($isComplete) {
                    $statusLabel = 'Lengkap (Pre & Post)';
                } elseif ($preTest) {
                    $statusLabel = 'Hanya Pre-Test';
                }

                $sessionNumber = $i + 1;
                $sessionLabel = "Pengisian ke-{$sessionNumber}";
                if ($totalSessions > 1) {
                    $sessionLabel .= " dari {$totalSessions}";
                }

                $records[] = [
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'role' => $user->role,
                    'room' => $user->room,
                    'session_number' => $sessionNumber,
                    'session_label' => $sessionLabel,
                    'status_label' => $statusLabel,
                    'is_complete' => $isComplete,
                    'has_pre' => $preTest !== null,
                    'has_post' => $postTest !== null,
                    'has_intervention' => $intervention !== null,
                    'has_game' => $gameLog !== null,
                    'has_thank_you' => $thankYouCard !== null,

                    // Pre-test
                    'pre_total' => $preTest?->total_score,
                    'pre_percentage' => $preTest ? round($preTest->percentage, 2) : null,
                    'pre_category' => $preTest?->category,
                    'pre_ee' => $preTest?->ee_score,
                    'pre_dp' => $preTest?->dp_score,
                    'pre_pa' => $preTest?->pa_score,

                    // Intervention Butterfly Hug
                    'intervention_type' => $intervention?->type,
                    'intervention_before' => $intervention?->tension_before,
                    'intervention_after' => $intervention?->tension_after,
                    'intervention_diff' => $intervention?->tension_diff,
                    'intervention_duration' => $intervention?->duration_seconds,
                    'intervention_tempo' => $intervention?->tempo_ms,
                    'intervention_taps' => $intervention?->taps_count,

                    // Game
                    'game_duration' => $gameLog?->duration_seconds,
                    'game_score' => $gameLog?->score,
                    'game_smashed' => $gameLog?->items_smashed,
                    'game_combo' => $gameLog?->max_combo,
                    'game_boss' => $gameLog?->boss_defeated,

                    // Thank You Card
                    'thank_you_recipient' => $thankYouCard?->recipient_name,
                    'thank_you_message' => $thankYouCard?->message,

                    // Post-test
                    'post_total' => $postTest?->total_score,
                    'post_percentage' => $postTest ? round($postTest->percentage, 2) : null,
                    'post_category' => $postTest?->category,
                    'post_ee' => $postTest?->ee_score,
                    'post_dp' => $postTest?->dp_score,
                    'post_pa' => $postTest?->pa_score,

                    // Deltas
                    'diff_total' => $diffTotal,
                    'diff_percentage' => $diffPercentage,
                    'diff_ee' => $diffEE,
                    'diff_dp' => $diffDP,
                    'diff_pa' => $diffPA,
                    'verdict' => $verdict,

                    'completed_at' => $sessionCompletedCarbon ? $sessionCompletedCarbon->timezone('Asia/Jakarta')->format('d/m/Y H:i') : null,
                    'completed_carbon' => $sessionCompletedCarbon,
                ];
            }
        }

        // Sort records by completed_carbon descending (latest session first), keeping uncompleted at bottom
        usort($records, function ($a, $b) {
            if ($a['completed_carbon'] && $b['completed_carbon']) {
                return $b['completed_carbon']->timestamp <=> $a['completed_carbon']->timestamp;
            }
            if ($a['completed_carbon']) return -1;
            if ($b['completed_carbon']) return 1;
            return strcmp($a['name'], $b['name']);
        });

        return $records;
    }

    /**
     * Compute summary statistics for the KPI cards.
     */
    protected function calculateStatistics(array $records): array
    {
        $totalSessions = count($records);
        $completeCount = 0;
        $preOnlyCount = 0;
        $emptyCount = 0;
        $thankYouCount = 0;
        $interventionCount = 0;
        $sumTensionDiff = 0;

        $sumPrePct = 0;
        $sumPostPct = 0;
        $sumDeltaPct = 0;
        $improvedCount = 0;

        $sumGameScore = 0;
        $gamePlayerCount = 0;

        $uniquePerawatFilled = [];

        foreach ($records as $r) {
            if ($r['is_complete']) {
                $completeCount++;
                $uniquePerawatFilled[$r['user_id']] = true;
                $sumPrePct += $r['pre_percentage'];
                $sumPostPct += $r['post_percentage'];
                $sumDeltaPct += $r['diff_percentage'];
                if ($r['diff_percentage'] < 0) {
                    $improvedCount++;
                }
            } elseif ($r['has_pre']) {
                $preOnlyCount++;
                $uniquePerawatFilled[$r['user_id']] = true;
            } else {
                $emptyCount++;
            }

            if (!empty($r['has_intervention']) && $r['intervention_diff'] !== null) {
                $interventionCount++;
                $sumTensionDiff += $r['intervention_diff'];
            }

            if ($r['has_game'] && $r['game_score'] !== null) {
                $gamePlayerCount++;
                $sumGameScore += $r['game_score'];
            }

            if (!empty($r['has_thank_you'])) {
                $thankYouCount++;
            }
        }

        $avgPrePct = $completeCount > 0 ? round($sumPrePct / $completeCount, 2) : 0;
        $avgPostPct = $completeCount > 0 ? round($sumPostPct / $completeCount, 2) : 0;
        $avgDeltaPct = $completeCount > 0 ? round($sumDeltaPct / $completeCount, 2) : 0;
        $avgGameScore = $gamePlayerCount > 0 ? round($sumGameScore / $gamePlayerCount) : 0;
        $avgTensionDiff = $interventionCount > 0 ? round($sumTensionDiff / $interventionCount, 1) : 0;

        return [
            'total_sessions' => $totalSessions,
            'completed' => $completeCount,
            'pre_only' => $preOnlyCount,
            'empty' => $emptyCount,
            'unique_nurses_count' => count($uniquePerawatFilled),
            'avg_pre' => $avgPrePct,
            'avg_post' => $avgPostPct,
            'avg_delta' => $avgDeltaPct,
            'improved_count' => $improvedCount,
            'improved_percentage' => $completeCount > 0 ? round(($improvedCount / $completeCount) * 100, 1) : 0,
            'avg_game_score' => $avgGameScore,
            'total_thank_you_cards' => $thankYouCount,
            'total_interventions' => $interventionCount,
            'avg_tension_diff' => $avgTensionDiff,
        ];
    }
}
