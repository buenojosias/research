<?php

namespace App\Livewire\Production;

use App\Models\Publication;
use App\Models\Research;
use Livewire\Component;

class ProductionShow extends Component
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
        return view('livewire.production.production-show')
            ->title($this->publication->title);
    }
}
