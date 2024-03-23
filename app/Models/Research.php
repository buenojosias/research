<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Research extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'student_id',
        'name',
        'repositories',
        'types',
        'terms',
        'combinations',
        'start_year',
        'end_year',
        'langagues',
        'requested_at',
    ];

    protected function casts(): array
    {
        return [
            'repositories' => 'array',
            'types' => 'array',
            'terms' => 'array',
            'combinations' => 'array',
            'langagues' => 'array',
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

    public function publications(): HasMany
    {
        return $this->hasMany(Publication::class);
    }
}
