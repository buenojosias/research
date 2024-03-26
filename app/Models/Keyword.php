<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Keyword extends Model
{
    use HasFactory;

    protected $fillable = [
        'publication_id',
        'data'
    ];

    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }

    public function publication(): BelongsTo
    {
        return $this->belongsTo(Publication::class);
    }
}
