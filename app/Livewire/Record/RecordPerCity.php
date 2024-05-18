<?php

namespace App\Livewire\Record;

use App\Models\Production;
use App\Models\Project;
use Livewire\Component;

class RecordPerCity extends Component
{
    public $project;

    // public $cities = [];

    // #[Url('cidade', except: '')]
    public $selectedCity = '';

    public $cityProductions = [];

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function render()
    {
        $cities = Production::query()
            ->with('state')
            ->select(['id', 'state_id', 'title', 'city'])
            ->where('project_id', $this->project->id)
            ->orderBy('city')
            ->get()
            ->groupBy('city');

        return view('livewire.record.record-per-city', compact('cities'))
            ->title('Relatório por cidade');
    }

    public function selectCity($key)
    {
        $this->selectedCity = $key;
        $this->cityProductions = $this->project->productions()->where('city', $this->selectedCity)->get();
    }

    public function selectWithoutCity()
    {
        $this->selectedCity = 'não informada';
        $this->cityProductions = $this->project->productions()->whereNull('city')->get();
    }
}
