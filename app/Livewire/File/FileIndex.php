<?php

namespace App\Livewire\File;

use App\Models\Project;
use Livewire\Component;

class FileIndex extends Component
{
    public $project;

    public $productions = [];
    public $noFileProductions = [];

    public function mount(Project $project)
    {
        $this->project = $project;

        $productions = $project->productions()
            // ->has('file')
            ->with('file')
            ->get();

        $this->productions = $productions->filter(function ($production) {
            return $production->file;
        });
        $this->noFileProductions = $productions->filter(function ($production) {
            return !$production->file;
        });
    }

    public function render()
    {
        return view('livewire.file.file-index')
            ->title('Arquivos da bibliometria');
    }
}
