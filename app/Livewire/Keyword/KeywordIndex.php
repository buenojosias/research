<?php

namespace App\Livewire\Keyword;

use App\Models\Keyword;
use App\Models\Research;
use Livewire\Attributes\Url;
use Livewire\Component;

class KeywordIndex extends Component
{
    public $research;

    public $keywords;

    public $kw_publ = [];

    #[Url('palavra', except: '')]
    public $selectedKeyword = '';

    public function mount(Research $research)
    {
        $this->research = $research;

        $data = $research->keywords()
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
        $this->kw_publ = $this->research->keywords()
            ->whereJsonContains('data', $word)
            ->with('publication')
            ->get();
    }

    public function render()
    {
        return view('livewire.keyword.keyword-index');
    }
}
