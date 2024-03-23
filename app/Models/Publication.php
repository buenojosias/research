<?php

namespace App\Models;

use App\Enums\PublicationTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publication extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'research_id',
        'searched_terms',
        'repository',
        'type',
        'language',
        'title',
        'subtitle',
        'year',
        'author_forename',
        'author_lastname',
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
            'type' => PublicationTypeEnum::class,
        ];
    }

    public function research(): BelongsTo
    {
        return $this->belongsTo(Research::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
