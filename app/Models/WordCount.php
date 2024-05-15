<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WordCount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'word',
        'production_types',
        'records',
        'sections'
    ];

    protected function casts(): array
    {
        return [
            'production_types' => 'array',
            'records' => 'array',
            'sections' => 'array'
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
