<?php

namespace App\Livewire\Group;

use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class AttachGroup extends Component
{
    use Interactions;

    public $project;
    public $productions = [];
    public $groups = [];

    #[Validate('required|integer', as: 'Grupo')]
    public $selectedGroup;

    #[Validate('nullable|string|max:255', as: 'Nota')]
    public $note;
    public $slide = false;

    public function mount($project)
    {
        $this->project = $project;
    }

    #[On('update-productions-list')]
    public function updateProductionsList($productions)
    {
        $this->productions = $productions;
    }

    #[On('open-slide')]
    public function openSlide()
    {
        if (!empty($this->productions) && empty($this->groups)) {
            $this->getGroups();
        }
        $this->slide = true;
    }

    public function getGroups()
    {
        $this->groups = $this->project->groups()->get();
    }

    public function render()
    {
        return view('livewire.group.attach-group');
    }

    public function attachGroup()
    {
        $this->validate();
        $group = $this->project->groups()->find($this->selectedGroup);
        foreach ($this->productions as $production) {
            $group->productions()->syncWithoutDetaching([$production => ['note' => $this->note]]);
        }
        $this->slide = false;
        $this->dispatch('unselect-all')->to('components.bulk-checkbox');
        $this->reset(['selectedGroup', 'note']);
        $this->toast()->success('Produções adicionadas ao grupo.')->send();
    }

    #[On('group-created')]
    public function groupCreated()
    {
        $this->getGroups();
    }
}
