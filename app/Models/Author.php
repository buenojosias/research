<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['production_id', 'forename', 'lastname'];

    protected $appends = ['full_name'];

    public function production()
    {
        return $this->belongsTo(Production::class);
    }

    public function getFullNameAttribute()
    {
        return $this->forename . ' ' . $this->lastname;
    }
}
