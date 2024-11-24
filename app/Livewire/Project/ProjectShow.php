<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;

class ProjectShow extends Component
{
    public $project;

    #[On('project-updated')]
    public function projectUpdated()
    {
        session()->flash('status', 'Projeto atualizado com sucesso.');
        $this->dispatch('$refresh');
    }

    public function mount($project)
    {
        $this->project = Project::query()
            ->with('bibliometric')
            ->withCount('productions')
            ->findOrFail($project);

        if ($this->project->bibliometric) {
            $this->project->bibliometric->period = $this->project->bibliometric->start_year . ' - ' . $this->project->bibliometric->end_year;
        }
    }

    public function render()
    {
        return view('livewire.project.project-show');
    }
}
