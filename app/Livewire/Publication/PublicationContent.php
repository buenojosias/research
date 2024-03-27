<?php

namespace App\Livewire\Publication;

use App\Models\Research;
use Livewire\Component;

class PublicationContent extends Component
{
    public $tab = 'Palavras-chave';

    public $research;

    public $publication;

    public $keywords;

    public $abstract;

    public $body;

    public function mount(Research $research, $publication)
    {
        $this->research = $research;

        $this->publication = $research->publications()
            ->select(['id', 'title', 'subtitle', 'year', 'author_lastname'])
            ->findOrFail($publication);

        $this->loadKeywords();
    }

    public function updatedTab()
    {
        if($this->tab === 'Palavras-chave')
            return $this->loadKeywords();

        if($this->tab === 'Resumo')
            return $this->loadAbstract();

        if($this->tab === 'Texto completo')
            return $this->loadBody();
    }

    public function loadKeywords()
    {
        if(!$this->abstract)
            $this->keywords = $this->publication->keywords ?? [];
    }

    public function loadAbstract()
    {
        if(!$this->abstract)
            $this->abstract = $this->publication->abstract ?? 'empty';
    }

    public function loadBody()
    {
        if(!$this->body)
            $this->body = $this->publication->body ?? 'empty';
    }

    public function render()
    {
        return view('livewire.publication.publication-content');
    }
}
