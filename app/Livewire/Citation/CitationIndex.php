<?php

namespace App\Livewire\Citation;

use App\Models\Project;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class CitationIndex extends Component
{
    use WithPagination;

    public $project;

    public $productions = [];

    public $references = [];

    #[Url('ano', except: '')]
    public $ano = '';

    #[Url('prod', except: '')]
    public $prod = '';

    #[Url('ref', except: '')]
    public $ref = '';

    #[Url('q', except: '')]
    public $q = '';

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function render()
    {
        $citations = $this->project->citations()
            ->when(!$this->prod, function($query) {
                $query->with('production');
            })
            ->when(!$this->ref, function($query) {
                $query->with('reference');
            })
            ->where('content', 'like', '%'.$this->q.'%')
            ->when($this->ano, function($query) {
                $query->whereRelation('production', 'year', $this->ano);
            })
            ->when($this->prod, function($query) {
                $query->where('production_id', $this->prod);
            })
            ->when($this->ref, function($query) {
                $query->where('reference_id', $this->ref);
            })
            ->paginate();

        return view('livewire.citation.citation-index', compact('citations'))
            ->title('Citações');
    }

    public function loadProductions()
    {
        $this->productions = $this->project->productions()->whereHas('citations')->get();
    }

    public function setProduction($prod = null)
    {
        $this->prod = $prod;
        $this->resetPage();
    }

    public function setYear($year = null)
    {
        $this->ano = $year;
        $this->resetPage();
    }

    public function loadReferences()
    {
        $this->references = $this->project->references()->whereHas('citations')->get();
    }

    public function setReference($ref = null)
    {
        $this->ref = $ref;
        $this->resetPage();
    }

    public function updated($q)
    {
        $this->resetPage();
    }
}
