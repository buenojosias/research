<?php

namespace App\Livewire\Keyword;

use App\Models\Project;
use Livewire\Attributes\Url;
use Livewire\Component;

class KeywordIndex extends Component
{
    public $project;

    public $bibliometric;

    public $keywords;

    public $keywordProductions = [];

    #[Url('palavra', except: '')]
    public $selectedKeyword = '';

    public $production_types = [];

    public function mount(Project $project)
    {
        $this->project = $project;

        $this->bibliometric = $project->bibliometric;

        if ($this->selectedKeyword)
            $this->selectWord($this->selectedKeyword);
    }

    // public function sort_by_value()
    // {
    //     $this->keywords->sortBy('value')->all();
    // }

    // public function arsort()
    // {
    //     arsort($this->keywords);
    // }

    public function selectWord($word)
    {
        $this->selectedKeyword = $word;

        $this->keywordProductions = $this->project->productions()
            ->whereHas('keywords', function ($query) {
                $query->where('value', $this->selectedKeyword);
            })
            ->when($this->production_types, function ($query) {
                $query->whereIn('type', $this->production_types);
            })
            ->with('keywords')
            ->get();
        }

    public function deleteProduction($id)
    {
        $this->project->productions()->where('id', $id)->first()->delete();
    }

    public function render()
    {
        $keywords = $this->project->keywords()
            ->select(['production_id', 'value'])
            ->whereNotNull('value')
            ->where('value', '!=', '')
            ->when($this->production_types, function ($q) {
                $q->whereRelation('production', function ($query) {
                    $query->whereIn('type', $this->production_types);
                });
            })
            ->get();

        $keywords = $keywords->map(function ($keyword) {
            $keyword->value = ucfirst($keyword->value);
            return $keyword;
        });

        $this->keywords = $keywords->sortBy('value')->groupBy('value')->all();

        return view('livewire.keyword.keyword-index');
    }
}
