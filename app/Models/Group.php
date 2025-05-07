<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'project_id',
        'name',
        'description',
    ];

    public function productions()
    {
        return $this->belongsToMany(Production::class, 'group_production')
            ->withPivot('note');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
