<?php

namespace App\Models;

use App\Enums\ReferenceTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reference extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'type',
        'display_author',
        'year',
        'title',
    ];

    protected function casts(): array
    {
        return [
            ReferenceTypeEnum::class,
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function productions(): BelongsToMany
    {
        return $this->belongsToMany(Production::class)->withPivot('suffix');
    }

    public function citations(): HasMany
    {
        return $this->hasMany(Citation::class);
    }
}
