<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WordAnalysisConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'bibliometric_id',
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

    public function bibliometric(): BelongsTo
    {
        return $this->belongsTo(Bibliometric::class);
    }
}
