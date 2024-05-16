<?php

namespace App\Livewire\File;

use App\Models\Project;
use Livewire\Component;

class FileIndex extends Component
{
    public $project;

    public $productions = [];

    public function mount(Project $project)
    {
        $this->project = $project;

        $this->productions = $project->productions()
            ->has('file')
            ->with('file')
            ->get();

            // dd($this->productions->toArray());
    }

    public function render()
    {
        return view('livewire.file.file-index')
            ->title('Arquivos da bibliometria');
    }
}
