<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
    protected $fillable = ['name', 'type', 'options'];

    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'options' => 'array',
        ];
    }

    public function bibliometric()
    {
        return $this->belongsTo(Bibliometric::class);
    }

    public function productions()
    {
        return $this->belongsToMany(Production::class)->withPivot('value')->withTimestamps();
    }
}
