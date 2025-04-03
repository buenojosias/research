<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ProjectScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        if (! auth()->user()->selected_project_id) {
            redirect()->route('projects.index');
        }
        $builder->where('project_id', auth()->user()->selected_project_id);
    }
}
