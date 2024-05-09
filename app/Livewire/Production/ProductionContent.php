<?php

namespace App\Livewire\Production;

use App\Models\Research;
use Livewire\Attributes\On;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class ProductionContent extends Component
{
    use Interactions;

    public $tab = 'Palavras-chave';

    public $research;

    public $publication;

    public $keywords;

    public $abstract;

    public $body;

    public $editing = false;

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
        if(!$this->keywords)
            $this->keywords = $this->publication->keywords ?? [];
    }

    #[On('keyword-added')]
    public function reloadKeyWords()
    {
        $this->keywords = $this->publication->keywords;
        $this->toast()->success('Palavra-chave adicionada.')->send();
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

    public function deleteKeyword($keyword)
    {
        $object = json_decode($this->keywords, true);
        $data = $object['data'];
        array_splice($data, $keyword, 1);
        $json = $data;
        $this->keywords->data = $json;

        if($this->keywords->update(['data' => $json]))
            $this->toast()->success('Palavra-chave removida.')->send();
    }

    public function render()
    {
        return view('livewire.production.production-content');
    }
}
