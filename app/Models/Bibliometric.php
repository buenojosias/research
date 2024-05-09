<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bibliometric extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'user_id',
        'repositories',
        'types',
        'terms',
        'combinations',
        'start_year',
        'end_year',
        'languages',
    ];

    protected function casts(): array
    {
        return [
            'repositories' => 'array',
            'types' => 'array',
            'terms' => 'array',
            'combinations' => 'array',
            'languages' => 'array',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function productions(): HasMany
    {
        return $this->hasMany(Production::class);
    }

    public function files(): HasManyThrough
    {
        return $this->hasManyThrough(File::class, Production::class);
    }

    public function wordCounts(): HasMany
    {
        return $this->hasMany(WordCount::class);
    }

    public function wordRankings(): HasMany
    {
        return $this->hasMany(WordRanking::class);
    }

    public function keywords(): HasManyThrough
    {
        return $this->hasManyThrough(Keyword::class, Production::class);
    }

    public function wordAnalysisConfig(): HasOne
    {
        return $this->hasOne(WordAnalysisConfig::class);
    }
}
