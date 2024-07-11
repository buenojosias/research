<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SearchResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'repository',
        'terms',
        'sections',
        'types',
        'language',
        'year',
        'quantity'
    ];

    protected function casts(): array
    {
        return [
            'terms' => 'array',
            'sections' => 'array',
            'types' => 'array',
            'quantity' => 'integer',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

}
