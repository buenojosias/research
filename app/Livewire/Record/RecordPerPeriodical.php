<?php

namespace App\Livewire\Record;

use App\Models\Production;
use App\Models\Project;
use Livewire\Component;

class RecordPerPeriodical extends Component
{
    public $project;
    public $productions = [];
    public $selectedPeriodical = '';
    public $periodicalProductions = [];

    public function mount(Project $project)
    {
        $this->project = $project;

        $this->productions = Production::query()
            ->select('id', 'project_id', 'repository', 'periodical', 'year')
            ->where('project_id', $this->project->id)
            ->where('type', 'Periódico')
            ->get();
    }

    public function render()
    {
        $productionsByPeriodical = $this->productions->sortBy('periodical')->groupBy('periodical');

        $years = $this->productions->pluck('year')->unique()->sort()->values();
        $repositories = $this->productions->pluck('repository')->unique()->sort()->values();

        $tableByYear = [];
        $tableByRepository = [];

        $yearTotals = [];
        $repositoryTotals = [];

        foreach($years as $year) {
            $yearTotals[$year] = 0;
        }
        $yearTotals['total'] = 0;

        foreach($repositories as $repository) {
            $repositoryTotals[$repository] = 0;
        }
        $repositoryTotals['total'] = 0;

        foreach ($productionsByPeriodical as $periodical => $group) {
            $yearTotal = 0;
            $repositoryTotal = 0;

            foreach ($years as $year) {
                $count = $group->filter(function ($production) use ($year) {
                    return $production->year == $year;
                })->count();

                $tableByYear[$periodical][$year] = $count;
                $yearTotals[$year] += $count;
                $yearTotal += $count;
            }

            foreach ($repositories as $repository) {
                $count = $group->filter(function ($production) use ($repository) {
                    return $production->repository == $repository;
                })->count();

                $tableByRepository[$periodical][$repository] = $count;
                $repositoryTotals[$repository] += $count;
                $repositoryTotal += $count;
            }

            $tableByYear[$periodical]['total'] = $yearTotal;
            $tableByRepository[$periodical]['total'] = $repositoryTotal;

            $repositoryTotals['total'] += $repositoryTotal;
        }

        return view(
            'livewire.record.record-per-periodical',
            compact(
                    'productionsByPeriodical',
                    'years', 'tableByYear', 'yearTotals',
                    'repositories', 'tableByRepository', 'repositoryTotals',
                )
        )
            ->title('Relatório por periódico');
    }

    public function selectPeriodical($key)
    {
        $this->selectedPeriodical = $key;
        $this->periodicalProductions = $this->project->productions()
            ->where('periodical', $this->selectedPeriodical)
            ->get();
    }

    public function selectWithoutPeriodical()
    {
        $this->selectedPeriodical = 'não informado';
        $this->periodicalProductions = $this->project->productions()
            ->whereNull('periodical')
            ->get();
    }

}
