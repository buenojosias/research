<?php

namespace App\Livewire\WordCount;

use App\Models\Project;
use Livewire\Component;

class WordCountIndex extends Component
{
    public $project;

    public $wordcounts = [];

    public function mount(Project $project)
    {
        $this->project = $project;

        $wordcounts = $project->wordCounts;

        foreach ($wordcounts as $wc) {
            $wc->productoins_count = count($wc->records);
            $wc->total_count = 0;
            foreach($wc->records as $record) {
                $wc->total_count += $record['count'];
            }
        }

        $this->wordcounts = $wordcounts;
    }

    public function render()
    {
        return view('livewire.word-count.word-count-index')
            ->title('Contagem de palavras');
    }
}
