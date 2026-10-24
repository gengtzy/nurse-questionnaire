<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GameLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'assessment_id',
        'score',
        'items_smashed',
        'max_combo',
        'duration_seconds',
        'boss_defeated',
        'played_at',
    ];

    protected function casts(): array
    {
        return [
            'score' => 'integer',
            'items_smashed' => 'integer',
            'max_combo' => 'integer',
            'duration_seconds' => 'integer',
            'boss_defeated' => 'boolean',
            'played_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class);
    }
}
