<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class BulkDropdown extends Component
{
    public $selectedProductions = [];
    public $project;

    public function mount($project)
    {
        $this->project = $project;
    }

    #[On('add-production')]
    public function addProduction($production_id)
    {
        if (in_array($production_id, $this->selectedProductions)) {
            return;
        }
        $this->selectedProductions[] = $production_id;
        $this->dispatch('update-productions-list', $this->selectedProductions)->to('group.attach-group');
    }

    #[On('remove-production')]
    public function removeProduction($production_id)
    {
        $this->selectedProductions = array_diff($this->selectedProductions, [$production_id]);
        $this->dispatch('update-productions-list', $this->selectedProductions)->to('group.attach-group');
    }

    public function render()
    {
        return view('livewire.components.bulk-dropdown');
    }
}
