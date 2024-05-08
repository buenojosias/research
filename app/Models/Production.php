<?php

namespace App\Models;

use App\Enums\ProductionTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Production extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'bibliometric_id',
        'searched_terms',
        'repository',
        'type',
        'language',
        'title',
        'subtitle',
        'year',
        'authors',
        'institution',
        'program',
        'periodical',
        'city',
        'state_id',
        'url',
        'doi'
    ];

    protected function casts(): array
    {
        return [
            'searched_terms' => 'array',
            'authors' => 'array',
            'type' => ProductionTypeEnum::class,
        ];
    }

    public function bibliometric(): BelongsTo
    {
        return $this->belongsTo(Bibliometric::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function internals(): HasMany
    {
        return $this->hasMany(Internal::class);
    }

    public function keywords(): HasOne
    {
        return $this->hasOne(Keyword::class);
    }

    public function abstract(): HasOne
    {
        return $this->hasOne(Internal::class)->where(function($query) {
            $query->where('section', 'abstract');
        });
    }

    public function body(): HasOne
    {
        return $this->hasOne(Internal::class)->where(function($query) {
            $query->where('section', 'body');
        });
    }

    public function file(): MorphOne
    {
        return $this->MorphOne(File::class, 'fileable');
    }

    public function wordRankings(): HasMany
    {
        return $this->hasMany(WordRanking::class);
    }
}
