<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ThankYouCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'recipient_name',
        'message',
    ];

    /**
     * Get the user (sender) who wrote this thank you card.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
