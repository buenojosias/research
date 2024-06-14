<?php

namespace App\Livewire\Record;

use App\Models\Production;
use App\Models\Project;
use Livewire\Component;

class RecordPerSearch extends Component
{
    public $project;

    public $selectedWords = [];

    public $bibliometricTypes = [];
    public $bibliometricRepositories = [];

    public $bibliometricTerms = [];

    public $selectedTypes = [];

    public $withTrashed = false;

    public function mount(Project $project)
    {
        $this->project = $project;

        $bibliometric = $project->bibliometric;

        $this->bibliometricTypes = $bibliometric->types;
        $this->bibliometricRepositories = $bibliometric->repositories;
        $this->bibliometricTerms = $bibliometric->terms;
    }

    public function render()
    {
        // VERSÃO 1
        sort($this->selectedWords);

        $selectedWordsJson = json_encode($this->selectedWords);

        $records = Production::query()
            ->select(['id', 'title', 'type', 'year', 'searched_terms'])
            ->where('project_id', $this->project->id)
            ->whereRaw('JSON_LENGTH(searched_terms) = ?', [count($this->selectedWords)])
            ->whereRaw('JSON_CONTAINS(searched_terms, ?)', [$selectedWordsJson])
            ->when($this->selectedTypes, function($query) {
                $query->whereIn('type', $this->selectedTypes);
            })
            ->when($this->withTrashed, function($query) {
                $query->withTrashed();
            })
            ->get()
            ->groupBy('type');

        // FIM VERSÃO 1


        // VERSÃO 2
        $productions = collect($this->project->productions);

        $groupedByWords = $productions->groupBy(function ($production) {
            $words = $production->searched_terms;
            sort($words);
            return json_encode($words);
        });

        $tableByType = [];
        $tableByRepository = [];

        $typeTotals = [];
        $repositoryTotals = [];

        $types = $this->bibliometricTypes;
        $repositories = $this->bibliometricRepositories;

        foreach($types as $type) {
            $typeTotals[$type] = 0;
        }
        $typeTotals['total'] = 0;

        foreach($repositories as $repository) {
            $repositoryTotals[$repository] = 0;
        }
        $repositoryTotals['total'] = 0;

        foreach ($groupedByWords as $words => $group) {
            $wordsArray = json_decode($words, true);
            $wordsKey = implode(' AND ', $wordsArray);

            $typeTotal = 0;
            $repositoryTotal = 0;

            foreach ($types as $type) {
                $count = $group->filter(function ($production) use ($type) {
                    return $production->type->value === $type;
                })->count();

                $tableByType[$wordsKey][$type] = $count;
                $typeTotals[$type] += $count;
                $typeTotal += $count;
            }

            foreach ($repositories as $repository) {
                $count = $group->filter(function ($production) use ($repository) {
                    return $production->repository === $repository;
                })->count();

                $tableByRepository[$wordsKey][$repository] = $count;
                $repositoryTotals[$repository] += $count;
                $repositoryTotal += $count;
            }

            $tableByType[$wordsKey]['total'] = $typeTotal;
            $tableByRepository[$wordsKey]['total'] = $repositoryTotal;

            $typeTotals['total'] += $typeTotal;
            $repositoryTotals['total'] += $repositoryTotal;
        }
        // FIM VERSÃO 2

        return view('livewire.record.record-per-search', compact('records', 'tableByType', 'tableByRepository', 'types', 'repositories', 'typeTotals', 'repositoryTotals'))
            ->title('Relatório por combinações buscadas');
    }
}
