<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Intervention extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'tension_before',
        'tension_after',
        'tension_diff',
        'duration_seconds',
        'tempo_ms',
        'taps_count',
        'completed',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'tension_before' => 'integer',
            'tension_after' => 'integer',
            'tension_diff' => 'integer',
            'duration_seconds' => 'integer',
            'tempo_ms' => 'integer',
            'taps_count' => 'integer',
            'completed' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
