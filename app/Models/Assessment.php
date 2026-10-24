<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'status',
        'ee_score',
        'dp_score',
        'pa_score',
        'total_score',
        'percentage',
        'category',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'ee_score' => 'integer',
            'dp_score' => 'integer',
            'pa_score' => 'integer',
            'total_score' => 'integer',
            'percentage' => 'decimal:2',
            'completed_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(AssessmentAnswer::class);
    }

    public function gameLog(): HasOne
    {
        return $this->hasOne(GameLog::class);
    }
}
