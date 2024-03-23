<?php

namespace App\Models;

use App\Enums\DegreeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'whatsapp',
        'institution',
        'program',
        'degree',
        'advisor'
    ];

    protected function casts(): array
    {
        return [
            'degree' => DegreeEnum::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function researches(): HasMany
    {
        return $this->hasMany(Research::class);
    }
}
