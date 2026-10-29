<?php

namespace App\Http\Controllers;

use App\Mail\AssessmentReportMail;
use App\Models\Assessment;
use App\Models\AssessmentAnswer;
use App\Models\GameLog;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AssessmentController extends Controller
{
    /**
     * Display the Pre-test questionnaire.
     */
    public function createPreTest(Request $request): View|RedirectResponse
    {
        $user = Auth::user();

        $existingAssessment = Assessment::where('user_id', $user->id)
            ->where('type', 'pre_test')
            ->where('status', 'completed')
            ->latest()
            ->first();

        // If user already completed pre-test and didn't explicitly request to retake:
        // Automatically advance them to the active next stage (Game) or their result, so they never get trapped in an empty form!
        if ($existingAssessment && ! $request->has('retake')) {
            $intervention = $user->interventions()->latest()->first();
            if (! $intervention) {
                return redirect()->route('intervention.create')
                    ->with('info', 'Anda sudah menyelesaikan Kuesioner Awal (Pre-test). Silakan lanjut ke Tahap 2: Intervensi Relaksasi.');
            }

            $gameLog = GameLog::where('user_id', $user->id)->latest()->first();
            if (! $gameLog) {
                return redirect()->route('game.play')
                    ->with('info', 'Anda sudah menyelesaikan Kuesioner Awal & Intervensi. Silakan lanjut ke Tahap 3: Game Katarsis.');
            }

            return redirect()->route('pre-test.result', $existingAssessment->id)
                ->with('info', 'Anda sudah menyelesaikan Kuesioner Awal (Pre-test).');
        }

        $questions = Question::orderBy('number')->get();

        return view('assessment.pre-test', [
            'user' => $user,
            'questions' => $questions,
            'existingAssessment' => $existingAssessment,
        ]);
    }

    /**
     * Store the Pre-test responses and calculate scores.
     */
    public function storePreTest(Request $request): RedirectResponse
    {
        $questions = Question::all()->keyBy('number');

        $rules = [];
        $attributes = [];
        foreach ($questions as $number => $q) {
            $rules["answers.{$number}"] = ['required', 'integer', 'between:0,6'];
            $attributes["answers.{$number}"] = "Pertanyaan No. {$number}";
        }

        $validated = $request->validate($rules, [
            'required' => ':attribute wajib dijawab sebelum melanjutkan.',
            'between' => ':attribute harus bernilai antara 0 sampai 6.',
        ], $attributes);

        $answers = $validated['answers'];

        $eeScore = 0; // max 54
        $dpScore = 0; // max 30
        $paScore = 0; // max 48 (reversed)

        $answerData = [];

        foreach ($answers as $number => $rawScore) {
            $question = $questions->get($number);
            $rawScore = (int) $rawScore;

            if ($question->dimension === 'EE') {
                $calculatedScore = $rawScore;
                $eeScore += $calculatedScore;
            } elseif ($question->dimension === 'DP') {
                $calculatedScore = $rawScore;
                $dpScore += $calculatedScore;
            } elseif ($question->dimension === 'PA') {
                $calculatedScore = 6 - $rawScore;
                $paScore += $calculatedScore;
            } else {
                $calculatedScore = $rawScore;
            }

            $answerData[] = [
                'question_id' => $question->id,
                'raw_score' => $rawScore,
                'calculated_score' => $calculatedScore,
            ];
        }

        $totalScore = $eeScore + $dpScore + $paScore;
        $percentage = round(($totalScore / 132) * 100, 2);

        if ($percentage < 33.33) {
            $category = 'Rendah';
        } elseif ($percentage < 66.67) {
            $category = 'Sedang';
        } else {
            $category = 'Tinggi';
        }

        $assessment = DB::transaction(function () use ($eeScore, $dpScore, $paScore, $totalScore, $percentage, $category, $answerData) {
            $assessment = Assessment::create([
                'user_id' => Auth::id(),
                'type' => 'pre_test',
                'status' => 'completed',
                'ee_score' => $eeScore,
                'dp_score' => $dpScore,
                'pa_score' => $paScore,
                'total_score' => $totalScore,
                'percentage' => $percentage,
                'category' => $category,
                'completed_at' => now(),
            ]);

            foreach ($answerData as &$item) {
                $item['assessment_id'] = $assessment->id;
                $item['created_at'] = now();
                $item['updated_at'] = now();
            }

            AssessmentAnswer::insert($answerData);

            return $assessment;
        });

        return redirect()->route('pre-test.result', $assessment->id)
            ->with('success', 'Kuesioner awal (Pre-test) berhasil dikirim dan dihitung.');
    }

    /**
     * Show Pre-test calculation results.
     */
    public function showPreTestResult(Assessment $assessment): View|RedirectResponse
    {
        if ($assessment->user_id !== Auth::id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        return view('assessment.pre-test-result', [
            'assessment' => $assessment,
            'user' => Auth::user(),
        ]);
    }

    /**
     * Display the Post-test questionnaire.
     */
    public function createPostTest(Request $request): View|RedirectResponse
    {
        $user = Auth::user();

        $latestPreTest = Assessment::where('user_id', $user->id)
            ->where('type', 'pre_test')
            ->where('status', 'completed')
            ->latest()
            ->first();

        if (! $latestPreTest) {
            return redirect()->route('pre-test.create')
                ->with('info', 'Silakan selesaikan Kuesioner Awal (Pre-test) terlebih dahulu.');
        }

        $latestGame = GameLog::where('user_id', $user->id)->latest()->first();

        $existingPostTest = Assessment::where('user_id', $user->id)
            ->where('type', 'post_test')
            ->where('status', 'completed')
            ->latest()
            ->first();

        // If post-test is already completed, redirect to the comparison result page!
        if ($existingPostTest && ! $request->has('retake')) {
            return redirect()->route('post-test.result', $existingPostTest->id)
                ->with('info', 'Anda sudah menyelesaikan Post-test. Berikut adalah hasil evaluasi lengkap Anda.');
        }

        $questions = Question::orderBy('number')->get();

        return view('assessment.post-test', [
            'user' => $user,
            'questions' => $questions,
            'latestPreTest' => $latestPreTest,
            'latestGame' => $latestGame,
            'existingPostTest' => $existingPostTest,
        ]);
    }

    /**
     * Store the Post-test responses and calculate scores, then trigger automatic email report.
     */
    public function storePostTest(Request $request): RedirectResponse
    {
        $questions = Question::all()->keyBy('number');

        $rules = [];
        $attributes = [];
        foreach ($questions as $number => $q) {
            $rules["answers.{$number}"] = ['required', 'integer', 'between:0,6'];
            $attributes["answers.{$number}"] = "Pertanyaan No. {$number}";
        }

        $validated = $request->validate($rules, [
            'required' => ':attribute wajib dijawab sebelum melanjutkan.',
            'between' => ':attribute harus bernilai antara 0 sampai 6.',
        ], $attributes);

        $answers = $validated['answers'];

        $eeScore = 0; // max 54
        $dpScore = 0; // max 30
        $paScore = 0; // max 48 (reversed)

        $answerData = [];

        foreach ($answers as $number => $rawScore) {
            $question = $questions->get($number);
            $rawScore = (int) $rawScore;

            if ($question->dimension === 'EE') {
                $calculatedScore = $rawScore;
                $eeScore += $calculatedScore;
            } elseif ($question->dimension === 'DP') {
                $calculatedScore = $rawScore;
                $dpScore += $calculatedScore;
            } elseif ($question->dimension === 'PA') {
                $calculatedScore = 6 - $rawScore;
                $paScore += $calculatedScore;
            } else {
                $calculatedScore = $rawScore;
            }

            $answerData[] = [
                'question_id' => $question->id,
                'raw_score' => $rawScore,
                'calculated_score' => $calculatedScore,
            ];
        }

        $totalScore = $eeScore + $dpScore + $paScore;
        $percentage = round(($totalScore / 132) * 100, 2);

        if ($percentage < 33.33) {
            $category = 'Rendah';
        } elseif ($percentage < 66.67) {
            $category = 'Sedang';
        } else {
            $category = 'Tinggi';
        }

        $user = Auth::user();

        $assessment = DB::transaction(function () use ($user, $eeScore, $dpScore, $paScore, $totalScore, $percentage, $category, $answerData) {
            $assessment = Assessment::create([
                'user_id' => $user->id,
                'type' => 'post_test',
                'status' => 'completed',
                'ee_score' => $eeScore,
                'dp_score' => $dpScore,
                'pa_score' => $paScore,
                'total_score' => $totalScore,
                'percentage' => $percentage,
                'category' => $category,
                'completed_at' => now(),
            ]);

            foreach ($answerData as &$item) {
                $item['assessment_id'] = $assessment->id;
                $item['created_at'] = now();
                $item['updated_at'] = now();
            }

            AssessmentAnswer::insert($answerData);

            return $assessment;
        });

        // Trigger Step 5: Automatic Email Dispatch to the Nurse
        $preTest = Assessment::where('user_id', $user->id)
            ->where('type', 'pre_test')
            ->where('status', 'completed')
            ->latest()
            ->first();

        $gameLog = GameLog::where('user_id', $user->id)->latest()->first();

        $emailSent = false;
        try {
            if (!empty($user->email)) {
                Mail::to($user->email)->send(new AssessmentReportMail($user, $preTest, $assessment, $gameLog));
                $emailSent = true;
                session(['email_report_sent_at_' . $assessment->id => now()->timestamp]);
            }
        } catch (\Throwable $e) {
            Log::warning('Gagal mengirimkan email laporan evaluasi: ' . $e->getMessage());
        }

        $flashMessage = 'Kuesioner evaluasi akhir (Post-test) berhasil dikirim.';
        if ($emailSent) {
            $flashMessage .= ' Laporan lengkap telah otomatis dikirimkan ke email: ' . $user->email;
        }

        return redirect()->route('post-test.result', $assessment->id)
            ->with('success', $flashMessage);
    }

    /**
     * Show Post-test calculation results with Pre vs Post comparison.
     */
    public function showPostTestResult(Assessment $assessment): View|RedirectResponse
    {
        if ($assessment->user_id !== Auth::id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        $user = Auth::user();

        $preTest = Assessment::where('user_id', $user->id)
            ->where('type', 'pre_test')
            ->where('status', 'completed')
            ->latest()
            ->first();

        $gameLog = GameLog::where('user_id', $user->id)
            ->latest()
            ->first();

        $diffPercentage = $preTest ? round($assessment->percentage - $preTest->percentage, 2) : 0;
        $diffTotal = $preTest ? ($assessment->total_score - $preTest->total_score) : 0;
        $diffEE = $preTest ? ($assessment->ee_score - $preTest->ee_score) : 0;
        $diffDP = $preTest ? ($assessment->dp_score - $preTest->dp_score) : 0;
        $diffPA = $preTest ? ($assessment->pa_score - $preTest->pa_score) : 0;

        return view('assessment.post-test-result', [
            'assessment' => $assessment,
            'preTest' => $preTest,
            'gameLog' => $gameLog,
            'user' => $user,
            'diffPercentage' => $diffPercentage,
            'diffTotal' => $diffTotal,
            'diffEE' => $diffEE,
            'diffDP' => $diffDP,
            'diffPA' => $diffPA,
        ]);
    }

    /**
     * Resend or send report email manually on demand.
     */
    public function sendEmailReport(Request $request, Assessment $assessment): RedirectResponse
    {
        if ($assessment->user_id !== Auth::id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        $user = Auth::user();

        $preTest = Assessment::where('user_id', $user->id)
            ->where('type', 'pre_test')
            ->where('status', 'completed')
            ->latest()
            ->first();

        $gameLog = GameLog::where('user_id', $user->id)
            ->latest()
            ->first();

        // Determine destination email
        $recipientEmail = $user->email;

        if (empty($recipientEmail)) {
            $inputEmail = trim((string) $request->input('target_email'));
            if (!empty($inputEmail) && filter_var($inputEmail, FILTER_VALIDATE_EMAIL)) {
                $recipientEmail = $inputEmail;
                // Automatically save this email to user record for future logins/evaluations
                $user->email = $recipientEmail;
                $user->save();
            } else {
                return back()->with('error', 'Silakan masukkan alamat email yang valid.');
            }
        }

        // Anti-spam cooldown: prevent sending duplicate emails within 60 seconds
        $lastSentTimestamp = session('email_report_sent_at_' . $assessment->id);
        if ($lastSentTimestamp && (now()->timestamp - $lastSentTimestamp) < 60) {
            $remaining = 60 - (now()->timestamp - $lastSentTimestamp);
            return back()->with('info', 'Laporan evaluasi baru saja dikirim ke ' . $recipientEmail . '. Mohon tunggu ' . $remaining . ' detik sebelum mengirim ulang, atau silakan periksa folder Inbox / Spam Anda.');
        }

        try {
            Mail::to($recipientEmail)->send(new AssessmentReportMail($user, $preTest, $assessment, $gameLog));
            session(['email_report_sent_at_' . $assessment->id => now()->timestamp]);

            return back()->with('success', 'Laporan evaluasi berhasil dikirim ke: ' . $recipientEmail);
        } catch (\Throwable $e) {
            Log::error('Error sending email report: ' . $e->getMessage());

            return back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }

    /**
     * Preview the rendered HTML email in browser for verification.
     */
    public function previewEmail(): View
    {
        $user = Auth::user();

        $preTest = Assessment::where('user_id', $user->id)
            ->where('type', 'pre_test')
            ->latest()
            ->first() ?? new Assessment([
                'percentage' => 52.4,
                'category' => 'Sedang',
                'ee_score' => 28,
                'dp_score' => 14,
                'pa_score' => 22,
                'total_score' => 64,
            ]);

        $postTest = Assessment::where('user_id', $user->id)
            ->where('type', 'post_test')
            ->latest()
            ->first() ?? new Assessment([
                'percentage' => 34.8,
                'category' => 'Sedang',
                'ee_score' => 18,
                'dp_score' => 9,
                'pa_score' => 18,
                'total_score' => 45,
                'completed_at' => now(),
            ]);

        $gameLog = GameLog::where('user_id', $user->id)->latest()->first() ?? new GameLog([
            'duration_seconds' => 30,
            'score' => 2150,
            'items_smashed' => 45,
            'max_combo' => 12,
            'boss_defeated' => true,
        ]);

        $mailable = new AssessmentReportMail($user, $preTest, $postTest, $gameLog);

        return view('emails.assessment-report', [
            'user' => $user,
            'preTest' => $preTest,
            'postTest' => $postTest,
            'gameLog' => $gameLog,
            'diffPercentage' => $mailable->diffPercentage,
            'diffTotal' => $mailable->diffTotal,
            'diffEE' => $mailable->diffEE,
            'diffDP' => $mailable->diffDP,
            'diffPA' => $mailable->diffPA,
        ]);
    }
}
