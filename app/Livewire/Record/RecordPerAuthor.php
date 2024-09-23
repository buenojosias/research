<?php

namespace App\Livewire\Record;

use App\Models\Production;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RecordPerAuthor extends Component
{
    public $project;

    public $authors;

    public $selectedAuthor;
    public $selectedAuthorName;

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

    public function selectAuthor($name, $ids)
    {
        $this->selectedAuthor = $ids;
        $this->selectedAuthorName = $name;

        if ($this->selectedAuthor) {
            $this->authorProductions = Production::whereHas('authors', function ($query) use ($ids) {
                $query->whereIn('id', $this->selectedAuthor);
            })->get();
        }
    }

    public function render()
    {
        $this->authors = $this->project->authors->groupBy(function ($author) {
            return $author->fullname;
        })
            ->map(function ($group) {
                return [
                    'count' => $group->count(),
                    'ids' => $group->pluck('id')->toArray(),
                ];
            });

        return view('livewire.record.record-per-author')
            ->title('Relatório por autor');
        ;
    }
}
