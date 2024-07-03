<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Citation extends Model
{
    use HasFactory;

    protected $fillable = [
        'production_id',
        'reference_id',
        'content',
        'type',
    ];

    public function production(): BelongsTo
    {
        return $this->belongsTo(Production::class);
    }

    public function reference(): BelongsTo
    {
        return $this->belongsTo(Reference::class);
    }
}
