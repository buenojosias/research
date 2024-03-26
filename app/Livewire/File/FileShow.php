<?php

namespace App\Livewire\File;

use App\Models\Publication;
use Livewire\Component;

class FileShow extends Component
{
    public $publication;

    public $file;

    public function mount($publication)
    {
        $this->publication = Publication::query()
            ->select(['id', 'title', 'subtitle', 'year', 'author_lastname'])
            ->with('file')
            ->findOrFail($publication);

        $this->file = $this->publication->file;
    }

    public function render()
    {
        return view('livewire.file.file-show')
            ->title('Arquivo da publicação');
    }
}
