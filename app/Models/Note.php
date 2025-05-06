<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'project_id',
        'production_id',
        'content',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function production()
    {
        return $this->belongsTo(Production::class);
    }
}
