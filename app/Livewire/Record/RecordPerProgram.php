<?php

namespace App\Livewire\Record;

use App\Models\Production;
use App\Models\Project;
use Livewire\Component;

class RecordPerProgram extends Component
{
    public $project;

    public $productions = [];

    public $selectedProgram = '';

    public $programProductions = [];

    public function mount(Project $project)
    {
        $this->project = $project;

        $productions = Production::query()
            ->select(['id', 'state_id', 'title', 'program', 'year', 'type'])
            ->where('project_id', $this->project->id)
            ->whereIn('type', ['Tese', 'Dissertação'])
            ->orderBy('program')
            ->get();

        $this->productions = $productions->map(function ($production) {
            $production->program = $production->program ?? 'Não informado';
            return $production;
        });
    }

    public function render()
    {
        $productionsByProgram = $this->productions->groupBy('program');

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

        foreach ($productionsByProgram as $program => $group) {
            $yearTotal = 0;
            $typeTotal = 0;

            foreach ($years as $year) {
                $count = $group->filter(function ($production) use ($year) {
                    return $production->year == $year;
                })->count();

                $tableByYear[$program][$year] = $count;
                $yearTotals[$year] += $count;
                $yearTotal += $count;
            }

            foreach ($types as $type) {
                $count = $group->filter(function ($production) use ($type) {
                    return $production->type->value == $type;
                })->count();

                $tableByType[$program][$type] = $count;
                $typeTotals[$type] += $count;
                $typeTotal += $count;
            }

            $tableByYear[$program]['total'] = $yearTotal;
            $tableByType[$program]['total'] = $typeTotal;

            $yearTotals['total'] += $yearTotal;
            $typeTotals['total'] += $typeTotal;
        }

        return view('livewire.record.record-per-program', compact(
            'productionsByProgram',
            'years',
            'tableByYear',
            'yearTotals',
            'types',
            'tableByType',
            'typeTotals',
        ))
            ->title('Relatório por programa');
    }

    public function selectProgram($key)
    {
        $this->selectedProgram = $key;
        $programProductions = $this->project->productions()
            ->where('program', $this->selectedProgram)
            ->whereIn('type', ['Tese', 'Dissertação'])
            ->get();

        $programProductions = $programProductions->map(function ($production) {
            $production->institution = $production->institution ?? 'Instituição não informada';
            return $production;
        });

        $this->programProductions = collect($programProductions->groupBy('institution'));
    }

    public function selectWithoutProgram()
    {
        $this->selectedProgram = 'não informado';
        $programProductions = $this->project->productions()
            ->whereIn('type', ['Tese', 'Dissertação'])
            ->whereNull('program')
            ->get();

        $programProductions = $programProductions->map(function ($production) {
            $production->institution = $production->institution ?? 'Instituição não informada';
            return $production;
        });

        $this->programProductions = collect($programProductions->groupBy('institution'));
    }
}
