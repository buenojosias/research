<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    protected $fillable = [
        'name',
        'abbreviation',
        'region'
    ];

    public function publications(): HasMany
    {
        return $this->hasMany(Publication::class);
    }
}
