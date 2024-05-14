<?php

namespace App\Livewire\WordRanking;

use App\Models\Project;
use Livewire\Component;

class WordRankingIndex extends Component
{
    public $project;

    public $bibliometric;

    public $wordrankings = [];

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->bibliometric = $project->bibliometric;
        $wordrankings = $this->bibliometric->wordRankings;

        foreach ($wordrankings as $wr) {
            $wr->publications_count = count($wr->records);
            $wr->total_count = 0;
            foreach($wr->records as $record) {
                $wr->total_count += $record['count'];
            }
        }

        $this->wordrankings = $wordrankings;
    }

    public function render()
    {
        return view('livewire.word-ranking.word-ranking-index')
            ->title('Ranking de palavras');
    }
}
