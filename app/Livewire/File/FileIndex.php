<?php

namespace App\Livewire\File;

use App\Models\Research;
use Livewire\Component;

class FileIndex extends Component
{
    public $research;

    public $files = [];

    public function mount(Research $research)
    {
        $this->research = $research;

        $this->files = $research->files()
            ->with('publication')
            ->get();
    }

    public function render()
    {
        return view('livewire.file.file-index')
            ->title('Arquivos da pesquisa');
    }
}
