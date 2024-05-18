<?php

namespace App\Livewire\WordCloud;

use App\Models\WordRanking;
use Livewire\Component;

class WordCloudIndex extends Component
{
    public $words = [];

    public function mount()
    {
        $wordRanking = WordRanking::first();
        $this->words = $wordRanking->records;
    }

    public function render()
    {
        return view('livewire.word-cloud.word-cloud-index');
    }
}
