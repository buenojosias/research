<?php

namespace App\Livewire\Keyword;

use App\Models\Project;
use Livewire\Attributes\Url;
use Livewire\Component;

class KeywordIndex extends Component
{
    public $project;

    public $keywords;

    public $kw_publ = [];

    #[Url('palavra', except: '')]
    public $selectedKeyword = '';

    public function mount(Project $project)
    {
        $this->project = $project;

        $data = $project->keywords()
            ->select('data')
            ->get()
            ->pluck('data')
            ->toArray();

        $allData = array_merge(...$data);

        $this->keywords = array_count_values($allData);

        if($this->selectedKeyword)
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
            ->with('production')
            ->get();
    }

    public function render()
    {
        return view('livewire.keyword.keyword-index');
    }
}
