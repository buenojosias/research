<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WordAnalysisConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'research_id',
        'min_lenght',
        'combinations',
        'excluded_words',
    ];

    protected function casts(): array
    {
        return [
            'combinations' => 'array',
            'excluded_words' => 'array',
        ];
    }

    public function research(): BelongsTo
    {
        return $this->belongsTo(Research::class);
    }
}
