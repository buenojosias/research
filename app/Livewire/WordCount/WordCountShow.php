<?php

namespace App\Livewire\WordCount;

use App\Models\Internal;
use App\Models\Project;
use App\Models\WordCount;
use Livewire\Attributes\On;
use Livewire\Component;

class WordCountShow extends Component
{
    public $project;

    public $bibliometric;

    public $wordcount;

    public $records = [];

    public $word = '';

    public $content = '';


    public function mount(Project $project, $wordcount)
    {
        $this->project = $project;

        $this->bibliometric = $project->bibliometric;

        $this->wordcount = WordCount::query()
            ->where('bibliometric_id', $this->bibliometric->id)
            ->findOrFail($wordcount);

        $this->records = $this->wordcount->records;
        $this->word = $this->wordcount->word;
    }

    public function loadContext($internal_id, $section)
    {
        $content = Internal::query()
            ->select('content')
            ->where('section', $section)
            ->findOrFail($internal_id);

        $this->content = $content->content;
    }

    #[On('close-slide')]
    public function closeSlide()
    {
        $this->content = null;
    }

    public function render()
    {
        return view('livewire.word-count.word-count-show')
            ->title('Contagem de palavras: '. $this->wordcount->word);
    }
}
