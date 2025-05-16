<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class BulkCheckbox extends Component
{
    public $production_id;

    public $checked = false;

    public function mount($production_id)
    {
        $this->production_id = $production_id;
    }

    #[On('select-all')]
    public function selectAll()
    {
        $this->checked = true;
        $this->dispatch('add-production', $this->production_id)->to('components.bulk-dropdown');
    }

    #[On('unselect-all')]
    public function unselectAll()
    {
        $this->checked = false;
        $this->dispatch('remove-production', $this->production_id)->to('components.bulk-dropdown');
    }

    public function updatedChecked($value)
    {
        if ($value) {
            $this->dispatch('add-production', $this->production_id)->to('components.bulk-dropdown');
        } else {
            $this->dispatch('remove-production', $this->production_id)->to('components.bulk-dropdown');
        }
    }

    public function render()
    {
        return view('livewire.components.bulk-checkbox');
    }
}
