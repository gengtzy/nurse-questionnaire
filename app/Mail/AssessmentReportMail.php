<?php

namespace App\Mail;

use App\Models\Assessment;
use App\Models\GameLog;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AssessmentReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public ?Assessment $preTest;
    public Assessment $postTest;
    public ?GameLog $gameLog;
    public float $diffPercentage;
    public int $diffTotal;
    public int $diffEE;
    public int $diffDP;
    public int $diffPA;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, ?Assessment $preTest, Assessment $postTest, ?GameLog $gameLog)
    {
        $this->user = $user;
        $this->preTest = $preTest;
        $this->postTest = $postTest;
        $this->gameLog = $gameLog;

        $this->diffPercentage = $preTest ? round($postTest->percentage - $preTest->percentage, 2) : 0;
        $this->diffTotal = $preTest ? ($postTest->total_score - $preTest->total_score) : 0;
        $this->diffEE = $preTest ? ($postTest->ee_score - $preTest->ee_score) : 0;
        $this->diffDP = $preTest ? ($postTest->dp_score - $preTest->dp_score) : 0;
        $this->diffPA = $preTest ? ($postTest->pa_score - $preTest->pa_score) : 0;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Laporan Hasil Evaluasi Burnout & Relaksasi - ' . $this->user->name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.assessment-report',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
