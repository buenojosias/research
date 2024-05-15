<?php

namespace App\Livewire\File;

use App\Models\Project;
use Livewire\Component;

class FileIndex extends Component
{
    public $project;

    public $bibliometric;

    public $files = [];

    public function mount(Project $project)
    {
        $this->project = $project;

        $this->bibliometric = $project->bibliometric;

        $this->files = $this->bibliometric->productions()
            ->has('file')
            ->with('file')
            ->get();

            // dd($this->files->toArray());
    }

    public function render()
    {
        return view('livewire.file.file-index')
            ->title('Arquivos da bibliometria');
    }
}
