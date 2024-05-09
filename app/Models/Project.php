<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ScopedBy(UserScope::class)]
class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'student_id',
        'theme',
        'requested_at',
    ];

    protected function casts(): array
    {
        return [
            'requested_at' => 'date:Y-m-d',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function bibliometric(): HasOne
    {
        return $this->hasOne(Bibliometric::class);
    }

    public function productions(): HasManyThrough
    {
        return $this->hasManyThrough(Production::class, Bibliometric::class);
    }
}
