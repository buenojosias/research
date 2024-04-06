<?php

namespace App\Livewire\WordRanking;

use App\Models\WordRanking;
use Livewire\Component;

class WordRankingShow extends Component
{
    public $research;

    public $wordranking;

    public $totalCount;

    public $records = [];

    public function mount($research, $wordranking)
    {
        $this->research = $research;

        $this->wordranking = WordRanking::query()
            // ->where('research_id', $research)
            ->findOrFail($wordranking);

        $this->records = $this->wordranking->records;

        $this->totalCount = 0;

        foreach($this->records as $record) {
            $this->totalCount += $record['count'];
        }
    }

    public function render()
    {
        return view('livewire.word-ranking.word-ranking-show')
            ->title('Ranking de palavras');
    }
}
