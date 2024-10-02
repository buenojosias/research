<?php

namespace App\Livewire\Record;

use App\Models\Production;
use App\Models\Project;
use Livewire\Component;

class RecordPerInstitution extends Component
{
    public $project;

    public $productions = [];

    public $selectedInstitution = '';

    public $institutionProductions = [];

    public function mount(Project $project)
    {
        $this->project = $project;

        $this->productions = Production::query()
            ->select(['id', 'title', 'institution', 'year', 'type'])
            ->where('project_id', $this->project->id)
            ->whereNotNull('institution')
            ->orderBy('institution')
            ->get();
    }

    public function render()
    {
        $productionsByInstitution = $this->productions->sortBy('institution')->groupBy('institution');

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

        foreach ($productionsByInstitution as $institution => $group) {
            $yearTotal = 0;
            $typeTotal = 0;

            foreach ($years as $year) {
                $count = $group->filter(function ($production) use ($year) {
                    return $production->year == $year;
                })->count();

                $tableByYear[$institution][$year] = $count;
                $yearTotals[$year] += $count;
                $yearTotal += $count;
            }

            foreach ($types as $type) {
                $count = $group->filter(function ($production) use ($type) {
                    return $production->type->value == $type;
                })->count();

                $tableByType[$institution][$type] = $count;
                $typeTotals[$type] += $count;
                $typeTotal += $count;
            }

            $tableByYear[$institution]['total'] = $yearTotal;
            $tableByType[$institution]['total'] = $typeTotal;

            $yearTotals['total'] += $yearTotal;
            $typeTotals['total'] += $typeTotal;
        }

        return view(
            'livewire.record.record-per-institution',
                compact(
                    'productionsByInstitution',
                    'years', 'tableByYear', 'yearTotals',
                    'types', 'tableByType', 'typeTotals',
                )
            )
            ->title('Relatório por instituição');
    }

    public function selectInstitution($key)
    {
        $this->selectedInstitution = $key;
        $this->institutionProductions = $this->project->productions()->where('institution', $this->selectedInstitution)->get();
    }

    public function selectWithoutInstitution()
    {
        $this->selectedInstitution = 'não informada';
        $this->institutionProductions = $this->project->productions()->whereNull('institution')->get();
    }
}
