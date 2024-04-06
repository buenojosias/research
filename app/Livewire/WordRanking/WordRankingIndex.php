<?php

namespace App\Livewire\WordRanking;

use Livewire\Component;

class WordRankingIndex extends Component
{
    public $research;

    public function mount($research)
    {
        $this->research = $research;
    }

    public function render()
    {
        return view('livewire.word-ranking.word-ranking-index')
            ->title('Ranking de palavras');
    }
}
