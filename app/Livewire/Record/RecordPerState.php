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

    // #[Url('uf', except: '')]
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
        foreach ($groupByRegion as $region => $states) {
            $groupByRegion[$region] = $states->sum('productions_count');
        }

        return view('livewire.record.record-per-state')
            ->title('Relatório por estado');
    }

    public function selectState($id)
    {
        $this->selectedState = $id;
        $this->stateProductions = $this->project->productions()
            ->where('state_id', $this->selectedState)
            ->get();
    }
}
