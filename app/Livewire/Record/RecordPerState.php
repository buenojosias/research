<?php

namespace App\Livewire\Record;

use App\Models\Production;
use App\Models\Project;
use App\Models\State;
use Livewire\Attributes\Url;
use Livewire\Component;

class RecordPerState extends Component
{
    public $project;

    public $states = [];

    public $selectedState = '';

    public $stateProductions = [];

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function render()
    {
        $this->states = State::query()
            ->has('productions')
            ->withCount([
                'productions' => function ($query) {
                    $query->where('project_id', $this->project->id);
                }
            ])
            ->orderBy('name')
            ->get();

        $groupByRegion = $this->states->groupBy('region');
        $countByRegion = [];

        return view('livewire.record.record-per-state', compact(
            'groupByRegion'
        ))
            ->title('Relatório por estado');
    }

    public function selectState($id)
    {
        $this->selectedState = $id;
        $stateProductions = $this->project->productions()
            ->where('state_id', $this->selectedState)
            ->orderBy('city')
            ->get();

        $stateProductions = $stateProductions->map(function ($production) {
            $production->city = $production->city ?? 'Cidade não informada';
            return $production;
        });

        $this->stateProductions = collect($stateProductions->groupBy('city'));

        $this->stateProductions;
    }
}
