<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'parent_id',
        'name'
    ];

    public $timestamps = false;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function productions()
    {
        return $this->belongsToMany(Production::class);
    }

    public function parent()
    {
        return $this->belongsTo(Tag::class, 'parent_id');
    }

    public function subtags()
    {
        return $this->hasMany(Tag::class, 'parent_id');
    }
}
