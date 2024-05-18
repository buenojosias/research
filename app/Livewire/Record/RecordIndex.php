<?php

namespace App\Livewire\Record;

use App\Models\Project;
use Livewire\Component;

class RecordIndex extends Component
{
    public $project;

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function render()
    {
        return view('livewire.record.record-index')
            ->title('Estatisticas');
    }
}
