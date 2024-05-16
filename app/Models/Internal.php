<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Internal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'production_id',
        'section',
        'content',
        'total_words'
    ];

    public function production(): BelongsTo
    {
        return $this->belongsTo(Production::class);
    }
}
