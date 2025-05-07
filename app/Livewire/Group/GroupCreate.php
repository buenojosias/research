<?php

namespace App\Livewire\Group;

use Livewire\Attributes\On;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class GroupCreate extends Component
{
    use Interactions;

    public $project;
    public $name;
    public $description;
    public $modal = false;

    public function mount($project)
    {
        $this->project = $project;
    }

    public function render()
    {
        return view('livewire.group.group-create');
    }

    #[On(('open-modal'))]
    public function openModal()
    {
        $this->modal = true;
    }

    public function createGroup()
    {
        $data = $this->validate([
            'name' => 'required|string|max:255|unique:groups,name,NULL,id,project_id,' . $this->project->id,
            'description' => 'nullable|string|max:255',
        ]);

        $this->project->groups()->create($data);

        $this->reset(['name', 'description']);
        $this->dispatch('group-created');
        $this->toast()->success('Grupo criado com sucesso.')->send();
        $this->modal = false;
    }
}
