<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Livewire\Component;

class ProjectShow extends Component
{
    public $project;

    public function mount($project)
    {
        $this->project = Project::query()
            ->with('bibliometric')
            ->withCount('productions')
            ->findOrFail($project);

        $this->project->bibliometric->period = $this->project->bibliometric->start_year . ' - '. $this->project->bibliometric->end_year;
    }

    public function render()
    {
        return view('livewire.project.project-show');
    }
}
