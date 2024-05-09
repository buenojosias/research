<?php

namespace App\Livewire\Production;

use App\Enums\RegionEnum;
use App\Models\Research;
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

    public $research;
    public $publications;

    public $has_monographies;
    public $has_periodicals;
    public $once;
    public $periodicals;
    public $states;
    public $regions;

    public function mount(Research $research)
    {
        $this->once = true;

        $this->research = $research;

        $this->has_monographies = in_array('dissertação', $this->research->types) ||
            in_array('tese', $this->research->types) ||
            in_array('artigoCientífico', $this->research->types);

        $this->has_periodicals = in_array('periódico', $this->research->types);
        $this->regions = RegionEnum::cases();

        // TODO: criar filtro por termos pesquisados
    }

    public function render()
    {
        $this->publications = $this->research->publications()
            ->whereAny(['title', 'subtitle'], 'like', "%$this->q%")
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
            ->with('state')
            ->get();

            if ($this->once) {
                $this->registerStates();
                $this->registerPeriodicals();
                $this->once = false;
            }

        return view('livewire.production.production-index')
            ->title('Publicações da pesquisa');
    }

    public function registerStates()
    {
        $this->states = $this->publications
            ->pluck('state.abbreviation')
            ->whereNotNull()
            ->unique()
            ->toArray();
    }

    public function registerPeriodicals()
    {
        $this->periodicals = $this->publications
            ->pluck('periodical')
            ->whereNotNull()
            ->unique()
            ->toArray();
    }

}
