<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Keyword extends Model
{
    use HasFactory;

    protected $fillable = [
        'production_id',
        'value',
        'data'
    ];

    public function production(): BelongsTo
    {
        return $this->belongsTo(Production::class);
    }
}
