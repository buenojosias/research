<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ProjectForm extends Component
{
    #[On('open-form-modal')]
    public function openFormModal()
    {
        $this->modal = true;
    }

    public $modal = false;

    public $selectedProject;

    public $id;

    #[Validate('required|integer')]
    public $user_id;

    #[Validate('nullable|integer')]
    public $student_id;

    #[Validate('required|string|min:5')]
    public $theme;

    #[Validate('required|date|before_or_equal:now')]
    public $requested_at;

    public $students = [];

    public function mount($project = null)
    {
        $this->students = auth()->user()->students()->select(['id', 'name'])->get()->toArray();
        $this->user_id = auth()->user()->id;

        if ($project) {
            $this->selectedProject = $project;
            $this->id = $project->id;
            $this->theme = $project->theme;
            $this->requested_at = $project->requested_at;
            $this->student_id = $project->student_id;
        } else {
            $this->selectedProject = null;
            $this->requested_at = date('Y-m-d');
        }
    }

    public function render()
    {
        return view('livewire.project.project-form');
    }

    public function save()
    {
        $data = $this->validate();

        if ($this->selectedProject) {
            $this->selectedProject->update($data);
            $this->dispatch('project-updated');
            $this->modal = false;
        } else {
            $project = Project::create($data);
            session()->flash('status', 'Projeto criado com sucesso.');
            $this->redirectRoute('project.show', $project, navigate: true);
        }
    }
}
