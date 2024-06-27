<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Goal extends Model
{
    protected $fillable = [
        'production_id',
        'level',
        'content'
    ];

    public function production(): BelongsTo
    {
        return $this->belongsTo(Production::class);
    }
}
