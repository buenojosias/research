<?php

namespace App\Livewire\Publication;

use App\Models\Research;
use Livewire\Attributes\Title;
use Livewire\Component;

class PublicationIndex extends Component
{
    #[Title('Publicações da pesquisa')]

    public $research;

    public function mount(Research $research)
    {
        $this->research = $research;
    }

    public function render()
    {
        $publications = $this->research->publications()->with('state')->paginate();

        return view('livewire.publication.publication-index', compact(['publications']));
    }
}
