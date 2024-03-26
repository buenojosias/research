<?php

namespace App\Livewire\Publication;

use App\Models\Publication;
use App\Models\Research;
use Livewire\Component;

class PublicationShow extends Component
{
    public $research;
    public $publication;

    public function mount(Research $research, $publication)
    {
        // TODO: Verificar se Research será mesmo usado e possivelmente excluir
        $this->research = $research;
        $this->publication = $research
            ->publications()
            ->with(['state','abstract','file'])
            ->findOrFail($publication);
    }

    public function render()
    {
        return view('livewire.publication.publication-show')
            ->title($this->publication->title);
    }
}
