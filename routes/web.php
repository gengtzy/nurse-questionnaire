<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThankYouCardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->role === 'Kepala Ruangan'
            ? redirect()->route('admin.rekap')
            : redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    // Kepala Ruangan Monitoring & Rekapitulasi Dashboard
    Route::get('/admin/rekap-data', [AdminController::class, 'index'])->name('admin.rekap');
    Route::get('/admin/rekap-data/export', [AdminController::class, 'export'])->name('admin.rekap.export');

    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user && $user->role === 'Kepala Ruangan') {
            return redirect()->route('admin.rekap');
        }

        $latestPreTest = $user->assessments()->where('type', 'pre_test')->latest()->first();
        $latestIntervention = $user->interventions()->latest()->first();
        $latestPostTest = $user->assessments()->where('type', 'post_test')->latest()->first();
        $latestGame = $user->gameLogs()->latest()->first();
        $latestThankYou = $user->thankYouCards()->latest()->first();

        return view('dashboard', compact('user', 'latestPreTest', 'latestIntervention', 'latestPostTest', 'latestGame', 'latestThankYou'));
    })->name('dashboard');

    // Pre-test Routes (Step 1)
    Route::get('/assessment/pre-test', [AssessmentController::class, 'createPreTest'])->name('pre-test.create');
    Route::post('/assessment/pre-test', [AssessmentController::class, 'storePreTest'])->name('pre-test.store');
    Route::get('/assessment/pre-test/{assessment}/result', [AssessmentController::class, 'showPreTestResult'])->name('pre-test.result');

    // Intervention Routes (Step 2: Butterfly Hug)
    Route::get('/intervention', [InterventionController::class, 'create'])->name('intervention.create');
    Route::post('/intervention', [InterventionController::class, 'store'])->name('intervention.store');

    // Game Routes (Step 3: Katarsis)
    Route::get('/game/play', [GameController::class, 'play'])->name('game.play');
    Route::post('/game/log', [GameController::class, 'storeLog'])->name('game.log');

    // Thank You Card Routes (Tahap Apresiasi Rekan)
    Route::get('/thank-you', [ThankYouCardController::class, 'create'])->name('thank-you.create');
    Route::post('/thank-you', [ThankYouCardController::class, 'store'])->name('thank-you.store');
    Route::post('/thank-you/mark-as-read', [ThankYouCardController::class, 'markAsRead'])->name('thank-you.mark-as-read');

    // Post-test Routes (Step 4)
    Route::get('/assessment/post-test', [AssessmentController::class, 'createPostTest'])->name('post-test.create');
    Route::post('/assessment/post-test', [AssessmentController::class, 'storePostTest'])->name('post-test.store');
    Route::get('/assessment/post-test/{assessment}/result', [AssessmentController::class, 'showPostTestResult'])->name('post-test.result');

    // Email Dispatch Routes (Step 5)
    Route::post('/assessment/{assessment}/send-email', [AssessmentController::class, 'sendEmailReport'])->name('assessment.send-email');
    Route::get('/mail/preview', [AssessmentController::class, 'previewEmail'])->name('mail.preview');

    // Profile & Password Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('password.edit');
});

require __DIR__.'/auth.php';
