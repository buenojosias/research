<?php

namespace App\Livewire\Record;

use App\Models\Production;
use App\Models\Project;
use Livewire\Component;

class RecordPerCity extends Component
{
    public $project;

    public $selectedCity = '';

    public $productions = [];

    public $cityProductions = [];

    public function mount(Project $project)
    {
        $this->project = $project;

        $this->productions = Production::query()
            ->with('state')
            ->select(['id', 'state_id', 'title', 'type', 'year', 'city'])
            ->where('project_id', $this->project->id)
            ->orderBy('city')
            ->get();
    }

    public function render()
    {
        $productionsByCity = $this->productions->sortBy('city')->groupBy('city');

        $years = $this->productions->pluck('year')->unique()->sort()->values();

        $types = $this->productions->map(function ($production) {
            return $production->type->value;
        })->unique();

        $tableByYear = [];
        $tableByType = [];

        $yearTotals = [];
        $typeTotals = [];

        foreach ($years as $year) {
            $yearTotals[$year] = 0;
        }
        $yearTotals['total'] = 0;

        foreach ($types as $type) {
            $typeTotals[$type] = 0;
        }
        $typeTotals['total'] = 0;

        foreach ($productionsByCity as $city => $group) {
            $yearTotal = 0;
            $typeTotal = 0;

            foreach ($years as $year) {
                $count = $group->filter(function ($production) use ($year) {
                    return $production->year == $year;
                })->count();

                $tableByYear[$city][$year] = $count;
                $yearTotals[$year] += $count;
                $yearTotal += $count;
            }

            foreach ($types as $type) {
                $count = $group->filter(function ($production) use ($type) {
                    return $production->type->value == $type;
                })->count();

                $tableByType[$city][$type] = $count;
                $typeTotals[$type] += $count;
                $typeTotal += $count;
            }

            $tableByYear[$city]['total'] = $yearTotal;
            $tableByType[$city]['total'] = $typeTotal;

            $yearTotals['total'] += $yearTotal;
            $typeTotals['total'] += $typeTotal;
        }

        foreach ($years as $year) {
            $yearTotals[$year] = 0;
        }
        $yearTotals['total'] = 0;

        foreach ($types as $type) {
            $typeTotals[$type] = 0;
        }
        $typeTotals['total'] = 0;

        return view('livewire.record.record-per-city',
            compact(
                'productionsByCity',
                'years', 'tableByYear', 'yearTotals',
                'types', 'tableByType', 'typeTotals',
            )
        )
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
