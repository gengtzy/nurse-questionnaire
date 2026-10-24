<?php

namespace App\Console\Commands;

use App\Mail\AssessmentReportMail;
use App\Models\Assessment;
use App\Models\GameLog;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-mail {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test sending the Nurse Recharge evaluation email report';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $email = $this->argument('email') ?? 'agengpujipangestu3@gmail.com';
        $user = User::where('email', $email)->first() ?? User::first();

        if (! $user) {
            $this->error("User with email {$email} not found!");
            return 1;
        }

        $preTest = new Assessment([
            'user_id' => $user->id,
            'type' => 'pre_test',
            'percentage' => 54.5,
            'category' => 'Sedang',
            'ee_score' => 32,
            'dp_score' => 16,
            'pa_score' => 24,
            'total_score' => 72,
            'completed_at' => now()->subMinutes(15),
        ]);

        $postTest = new Assessment([
            'user_id' => $user->id,
            'type' => 'post_test',
            'percentage' => 36.4,
            'category' => 'Sedang',
            'ee_score' => 20,
            'dp_score' => 10,
            'pa_score' => 18,
            'total_score' => 48,
            'completed_at' => now(),
        ]);

        $gameLog = new GameLog([
            'user_id' => $user->id,
            'score' => 2450,
            'items_smashed' => 48,
            'max_combo' => 14,
            'duration_seconds' => 30,
            'boss_defeated' => true,
            'played_at' => now()->subMinutes(5),
        ]);

        $this->info("Sending test report email to: {$user->email} ({$user->name})...");

        Mail::to($user->email)->send(new AssessmentReportMail($user, $preTest, $postTest, $gameLog));

        $this->info("✓ Email processed successfully via driver: " . config('mail.default'));

        return 0;
    }
}
