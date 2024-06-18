<?php

namespace App\Livewire\Record;

use App\Models\Production;
use App\Models\Project;
use Livewire\Component;

class RecordPerAuthor extends Component
{
    public $project;

    public $authors;

    public $selectedAuthor = '';

    public $authorProductions = [];

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function ksort()
    {
        ksort($this->authors);
    }

    public function arsort()
    {
        arsort($this->authors);
    }

    public function selectAuthor($author)
    {
        $parts = explode(',', $author);

        if (count($parts) !== 2) {
            return null;
        }

        $lastname = trim($parts[0]);
        $forename = trim($parts[1]);

        $nameObject = [
            'forename' => $forename,
            'lastname' => $lastname,
        ];

        $productions = Production::whereJsonContains('authors', $nameObject)->get();
        dd($nameObject, $productions);
    }

    public function render()
    {
        $data = $this->project->productions()
            ->select('authors')
            ->get()
            ->pluck('authors');

        $authors = $data->map(function ($item) {
            return $item[0]['lastname'] . ', ' . $item[0]['forename'];
        });

        $allData = $authors->toArray();
        $allData = array_filter($allData);

        $this->authors = array_count_values($allData);
        $this->ksort();

        return view('livewire.record.record-per-author')
            ->title('Relatório por autor');;
    }
}
