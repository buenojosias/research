<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WordCount extends Model
{
    use HasFactory;

    protected $fillable = [
        'research_id',
        'word',
        'publication_types',
        'records',
        'sections'
    ];

    protected function casts(): array
    {
        return [
            'publication_types' => 'array',
            'records' => 'array',
            'sections' => 'array'
        ];
    }

    public function research(): BelongsTo
    {
        return $this->belongsTo(Research::class);
    }
}
