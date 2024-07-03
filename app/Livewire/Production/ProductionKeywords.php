<?php

namespace App\Livewire\Production;

use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class ProductionKeywords extends Component
{
    use Interactions;

    public $project;
    public $production;

    public $keywords = [];

    public function mount(Project $project, $production)
    {
        $this->project = $project;
        $this->production = $project
            ->productions()
            ->findOrFail($production);

        $this->keywords = $this->production->keywords;
    }

    public function render()
    {
        return view('livewire.production.production-keywords')
            ->layout('layouts.production')
            ->layoutData([
                'title' => 'Palavras-chave da produção',
                'project' => $this->project,
                'production' => $this->production,
            ]);
    }

    #[On('keyword-added')]
    public function reloadKeyWords()
    {
        $this->keywords = $this->production->keywords;
        $this->toast()->success('Palavra-chave adicionada.')->send();
    }

    public function deleteKeyword($keyword)
    {
        $object = json_decode($this->keywords, true);
        $data = $object['data'];
        array_splice($data, $keyword, 1);
        $json = $data;
        $this->keywords->data = $json;

        if ($this->keywords->update(['data' => $json]))
            $this->toast()->success('Palavra-chave removida.')->send();
    }

}
