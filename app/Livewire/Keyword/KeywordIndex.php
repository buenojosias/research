<?php

namespace App\Livewire\Keyword;

use App\Models\Production;
use App\Models\Project;
use Livewire\Attributes\Url;
use Livewire\Component;

class KeywordIndex extends Component
{
    public $project;

    public $bibliometric;

    public $keywords;

    public $kw_publ = [];

    #[Url('palavra', except: '')]
    public $selectedKeyword = '';

    public $production_types = [];

    public function mount(Project $project)
    {
        $this->project = $project;

        $this->bibliometric = $project->bibliometric;

        if ($this->selectedKeyword)
            $this->selectWord($this->selectedKeyword);
    }

    public function ksort()
    {
        ksort($this->keywords);
    }

    public function arsort()
    {
        arsort($this->keywords);
    }

    public function selectWord($word)
    {
        $this->selectedKeyword = $word;
        $this->kw_publ = $this->project->keywords()
            ->whereJsonContains('data', $word)
            ->when($this->production_types, function ($q) {
                $q->whereRelation('production', function ($query) {
                    $query->whereIn('type', $this->production_types);
                });
            })
            ->with('production')
            ->get();
    }

    public function deleteProduction($id)
    {
        Production::where('id', $id)->first()->delete();
    }

    public function render()
    {
        $data = $this->project->keywords()
            ->when($this->production_types, function ($q) {
                $q->whereRelation('production', function ($query) {
                    $query->whereIn('type', $this->production_types);
                });
            })
            ->select('data')
            ->get()
            ->pluck('data')
            ->toArray();

        $allData = array_merge(...$data);
        $allData = array_filter($allData);
        $allData = array_map('strtolower', $allData);

        $this->keywords = array_count_values($allData);

        return view('livewire.keyword.keyword-index');
    }
}
