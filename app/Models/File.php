<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'fileable',
        'filename',
        'path',
        'size',
        'pages'
    ];

    protected function casts(): array
    {
        return [
            'size' => 'float'
        ];
    }

    public function fileable(): MorphTo
    {
        return $this->morphTo();
    }

    // public function production(): BelongsTo
    // {
    //     return $this->belongsTo(Production::class);
    // }
}
