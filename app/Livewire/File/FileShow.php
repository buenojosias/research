<?php

namespace App\Livewire\File;

use App\Models\Research;
use Livewire\Attributes\On;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class FileShow extends Component
{
    use Interactions;

    public $research;

    public $publication;

    public $file;

    public $path;

    #[On('file-uploaded')]
    public function fileUploaded($file)
    {
        $this->file = $this->publication->file()->find($file['id']);
        $this->path = str_replace('files/', '', $this->file->path);
        $this->toast()->success('Arquivo enviado com sucesso.')->send();
    }

    public function mount(Research $research, $publication)
    {
        $this->research = $research;

        $this->publication = $research->productions()
            ->select(['id', 'title', 'subtitle', 'year', 'author_lastname'])
            ->with('file')
            ->findOrFail($publication);

        $this->file = $this->publication->file;

        // $this->path = storage_path($this->file->path);
        if ($this->file)
            $this->path = str_replace('files/', '', $this->file->path);
    }

    public function render()
    {
        return view('livewire.file.file-show')
            ->title('Arquivo da publicação');
    }
}
