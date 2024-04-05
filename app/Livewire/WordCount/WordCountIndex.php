<?php

namespace App\Livewire\WordCount;

use App\Models\Research;
use Livewire\Component;

class WordCountIndex extends Component
{
    public $research;

    public $wordcounts = [];

    public function mount(Research $research)
    {
        $wordcounts = $research->wordCounts;

        foreach ($wordcounts as $wc) {
            $wc->publications_count = count($wc->records);
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
