<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Livewire\Component;

class ProjectIndex extends Component
{
    public $projects = [];

    public function mount()
    {
        $this->projects = Project::query()
            ->with('student')
            ->withCount('bibliometric')
            ->get();
    }

    public function render()
    {
        return view('livewire.project.project-index')
            ->title('Projetos');
    }
}
