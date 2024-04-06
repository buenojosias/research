<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WordRanking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'research_id',
        'publication_id',
        'title',
        'description',
        'words_limit',
        'filters',
        'records',
        'publications_flag',
        'config_flag',
    ];

    protected function casts(): array
    {
        return [
            'filters' => 'array',
            'records' => 'array',
            'publication_flag' => 'boolean',
            'config_flag' => 'boolean',
        ];
    }

    public function research(): BelongsTo
    {
        return $this->belongsTo(Research::class);
    }

    public function publication(): BelongsTo
    {
        return $this->belongsTo(Publication::class);
    }
}
