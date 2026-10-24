<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'dimension',
        'dimension_name',
        'question_text',
        'is_reversed',
        'scale_min',
        'scale_max',
        'scale_labels',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'is_reversed' => 'boolean',
            'scale_labels' => 'array',
            'scale_min' => 'integer',
            'scale_max' => 'integer',
            'order' => 'integer',
            'number' => 'integer',
        ];
    }

    public function answers(): HasMany
    {
        return $this->hasMany(AssessmentAnswer::class);
    }
}
