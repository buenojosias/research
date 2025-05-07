<?php

namespace App\Livewire\Record;

use App\Models\Production;
use App\Models\Project;
use Livewire\Component;

class RecordPerDescriptor extends Component
{
    public $project;

    public $selectedWords = [];

    public $bibliometricTypes = [];
    public $bibliometricRepositories = [];

    public $bibliometricTerms = [];

    public $selectedTypes = [];

    public $bibliometricYears = [];

    public $withTrashed = false;
    public $descriptor = null;
    public $selectedProductions = [];

    public function mount(Project $project)
    {
        $this->project = $project;

        $bibliometric = $project->bibliometric;

        $this->bibliometricTypes = $bibliometric->types;
        $this->bibliometricRepositories = $bibliometric->repositories;
        $this->bibliometricTerms = $bibliometric->terms;
        for ($i = intval($bibliometric->start_year); $i <= $bibliometric->end_year; $i++) {
            array_push($this->bibliometricYears, $i);
        }
    }

    public function updatedSelectedProductions($value)
    {
        $this->dispatch('update-productions-list', $this->selectedProductions);
    }

    public function render()
    {
        // VERSÃO 1
        sort($this->selectedWords);

        $selectedWordsJson = json_encode($this->selectedWords);

        $records = Production::query()
            ->select(['id', 'title', 'subtitle', 'type', 'year', 'searched_terms'])
            ->with('authors')
            ->where('project_id', $this->project->id)
            ->whereRaw('JSON_LENGTH(searched_terms) = ?', [count($this->selectedWords)])
            ->whereRaw('JSON_CONTAINS(searched_terms, ?)', [$selectedWordsJson])
            ->when($this->selectedTypes, function($query) {
                $query->whereIn('type', $this->selectedTypes);
            })
            ->when($this->withTrashed, function($query) {
                $query->withTrashed();
            })
            ->get();
            // ->groupBy('type');
        // FIM VERSÃO 1

        // VERSÃO 2
        $productions = collect($this->project->productions);

        $groupedByWords = $productions->groupBy(function ($production) {
            $words = $production->searched_terms;
            sort($words);
            return json_encode($words);
        });

        $tableByWord = [];
        $tableByType = [];
        $tableByRepository = [];
        $tableByYear = [];

        $typeTotals = [];
        $repositoryTotals = [];
        $yearTotals = [];

        $types = $this->bibliometricTypes;
        $repositories = $this->bibliometricRepositories;
        $years = $this->bibliometricYears;

        foreach ($groupedByWords as $words => $group) {
            $wordsArray = json_decode($words, true);
            $wordsKey = implode(' AND ', $wordsArray);

            $tableByWord[$wordsKey] = [
                'total' => $group->count(),
            ];
        }

        foreach($types as $type) {
            $typeTotals[$type] = 0;
        }
        $typeTotals['total'] = 0;

        foreach($repositories as $repository) {
            $repositoryTotals[$repository] = 0;
        }
        $repositoryTotals['total'] = 0;

        foreach($years as $year) {
            $yearTotals[$year] = 0;
        }
        $yearTotals['total'] = 0;

        foreach ($groupedByWords as $words => $group) {
            $wordsArray = json_decode($words, true);
            $wordsKey = implode(' AND ', $wordsArray);

            $wordTotal = 0;
            $typeTotal = 0;
            $repositoryTotal = 0;
            $yearTotal = 0;

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

            foreach ($years as $year) {
                $count = $group->filter(function ($production) use ($year) {
                    return $production->year == $year;
                })->count();

                $tableByYear[$wordsKey][$year] = $count;
                $yearTotals[$year] += $count;
                $yearTotal += $count;
            }

            $tableByType[$wordsKey]['total'] = $typeTotal;
            $tableByRepository[$wordsKey]['total'] = $repositoryTotal;
            $tableByYear[$wordsKey]['total'] = $yearTotal;

            $typeTotals['total'] += $typeTotal;
            $repositoryTotals['total'] += $repositoryTotal;
            $yearTotals['total'] += $yearTotal;
        }
        // FIM VERSÃO 2

        return view('livewire.record.record-per-descriptor', compact('records', 'tableByWord', 'tableByType', 'tableByRepository', 'tableByYear', 'types', 'repositories', 'years', 'typeTotals', 'repositoryTotals', 'yearTotals'))
            ->title('Relatório por descritores');
    }

    public function selectWord($word)
    {
        $this->descriptor = $word;
        $words = explode(' AND ', $word);
        $this->selectedWords = array_map('trim', $words);
    }
}
