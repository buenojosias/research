<?php

namespace App\Livewire\Production;

use App\Enums\RegionEnum;
use App\Models\Project;
use Livewire\Attributes\Url;
use Livewire\Component;

class ProductionIndex extends Component
{
    #[Url(except: '')]
    public $q = '';

    public $anos = [];

    #[Url(except: '')]
    public $repo = '';

    #[Url(except: '')]
    public $tipo = '';

    public $idioma = '';

    #[Url(except: '')]
    public $uf = '';

    #[Url(except: '')]
    public $regiao = '';

    #[Url(except: '')]
    public $periodico = '';

    public $project;

    public $bibliometric;

    public $productions;

    public $has_monographies;
    public $has_periodicals;
    public $show_deleted = false;
    public $once;
    public $periodicals;
    public $states;
    public $regions;
    public $highlighted = false;

    public function mount(Project $project)
    {
        $this->once = true;

        $this->project = $project;

        $this->bibliometric = $project->bibliometric;

        $this->has_monographies = in_array('Dissertação', $this->bibliometric->types) ||
            in_array('Tese', $this->bibliometric->types) ||
            in_array('artigoCientífico', $this->bibliometric->types);

        $this->has_periodicals = in_array('Periódico', $this->bibliometric->types);
        $this->regions = RegionEnum::cases();

        // TODO: criar filtro por termos pesquisados
    }

    public function render()
    {
        $this->productions = $this->project->productions()
            ->when($this->q, function($query) {
                $query->whereAny(['title', 'subtitle'], 'like', "%$this->q%");
            })
            ->when($this->anos, function ($query) {
                $query->whereIn('year', $this->anos);
            })
            ->when($this->repo, function ($query) {
                $query->where('repository', $this->repo);
            })
            ->when($this->tipo, function ($query) {
                $query->where('type', $this->tipo);
            })
            ->when($this->periodico, function ($query) {
                $query->where('periodical', $this->periodico);
            })
            ->when($this->idioma, function ($query) {
                $query->where('language', $this->idioma);
            })
            ->when($this->regiao, function ($query) {
                $query->whereRelation('state', 'region', $this->regiao);
            })
            ->when($this->uf, function ($query) {
                $query->whereRelation('state', 'abbreviation', $this->uf);
            })
            ->when($this->show_deleted, function ($query) {
                $query->withTrashed();
            })
            ->when($this->highlighted, function($query) {
                $query->whereHighlighted(true);
            })
            ->with(['state', 'authors'])
            ->orderBy('title')
            ->get();

            if ($this->once) {
                $this->registerStates();
                $this->registerPeriodicals();
                $this->once = false;
            }

        return view('livewire.production.production-index')
            ->title('Produções encontradas');
    }

    public function registerStates()
    {
        $this->states = $this->productions
            ->pluck('state.abbreviation')
            ->whereNotNull()
            ->unique()
            ->toArray();
    }

    public function registerPeriodicals()
    {
        $this->periodicals = $this->productions
            ->pluck('periodical')
            ->whereNotNull()
            ->unique()
            ->toArray();
    }

}
