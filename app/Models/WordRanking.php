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
        'project_id',
        'production_id',
        'title',
        'description',
        'words_limit',
        'filters',
        'records',
        'productions_flag',
        'config_flag',
    ];

    protected function casts(): array
    {
        return [
            'filters' => 'array',
            'records' => 'array',
            'production_flag' => 'boolean',
            'config_flag' => 'boolean',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function production(): BelongsTo
    {
        return $this->belongsTo(Production::class);
    }
}
