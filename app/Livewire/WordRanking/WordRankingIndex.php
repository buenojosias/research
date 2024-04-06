<?php

namespace App\Livewire\WordRanking;

use App\Models\Research;
use Livewire\Component;

class WordRankingIndex extends Component
{
    public $research;

    public $wordrankings = [];

    public function mount(Research $research)
    {
        $wordrankings = $research->wordRankings;

        foreach ($wordrankings as $wr) {
            $wr->publications_count = count($wr->records);
            $wr->total_count = 0;
            foreach($wr->records as $record) {
                $wr->total_count += $record['count'];
            }
        }

        $this->wordrankings = $wordrankings;

        // dd($this->wordrankings);
    }

    public function render()
    {
        return view('livewire.word-ranking.word-ranking-index')
            ->title('Ranking de palavras');
    }
}
