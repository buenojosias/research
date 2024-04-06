<?php

namespace App\Livewire\WordRanking;

use App\Models\Internal;
use App\Models\Research;
use Livewire\Attributes\Validate;
use Livewire\Component;

class WordRankingCreate extends Component
{
    public $research;

    public $publications = [];

    #[Validate('required|array')]
    public $sections = ['abstract'];

    #[Validate('required|array')]
    public $publication_types = ['Dissertação'];

    #[Validate('required|integer')]
    public $minLenght = 4;

    #[Validate('required|integer')]
    public $wordsLimit = 50;

    public $combinedWords = ['fusca azul', 'Odio ullam'];

    public $excludedWords = [];

    public $results = [];

    public $selectedResult;

    public function mount(Research $research)
    {
        $this->research = $research;
    }

    public function generate()
    {
        $internalsContent = Internal::query()
            ->whereRelation('publication', fn($q) => $q->whereIn('type', $this->publication_types))
            ->whereIn('section', $this->sections)
            ->when($this->publications, function ($q) {
                $q->whereIn('publication_id', $this->publications);
            })
            ->pluck('content')
            ->toArray();

        $allContent = implode(' ', $internalsContent);

        $words = str_word_count(strtolower($allContent), 1);

        $wordCount = [];
        foreach ($words as $word) {
            if (strlen($word) >= $this->minLenght && !in_array($word, $this->excludedWords)) {
                $wordCount[$word]['id'] = rand(00000000, 99999000);
                $wordCount[$word]['word'] = $word;
                $wordCount[$word]['count'] = isset($wordCount[$word]['count']) ? $wordCount[$word]['count'] + 1 : 1;
                $wordCount[$word]['internals'] = array_unique(
                    array_merge(
                        isset($wordCount[$word]['internals']) ? $wordCount[$word]['internals'] : [],
                        array_keys(array_filter($internalsContent, function ($content) use ($word) {
                            return stripos($content, $word) !== false;
                        }))
                    )
                );
            }
        }

        foreach ($this->combinedWords as $combinedWord) {
            $wordParts = explode(' ', $combinedWord);
            $combinedCount = substr_count($allContent, $combinedWord);
            foreach ($wordParts as $part) {
                if (isset($wordCount[$part])) {
                    $wordCount[$part]['count'] -= $combinedCount;
                    $wordCount[$combinedWord] = [
                        'id' => rand(00000000, 99999000),
                        'word' => $combinedWord,
                        'count' => $combinedCount,
                        'internals' => array_keys(array_filter($internalsContent, function ($content) use ($combinedWord) {
                            return stripos($content, $combinedWord) !== false;
                        }))
                    ];
                }
            }
        }

        uasort($wordCount, function ($a, $b) {
            return $b['count'] - $a['count'];
        });

        $this->results = collect(array_slice($wordCount, 0, $this->wordsLimit));
        // dump($this->results);
    }

    public function selectResult($id)
    {
        return;
        // dump('hi');
        // $this->reset('selectedResult');
        // sleep(2);
        // $this->selectedResult = $this->results->where('id', $id)->first();
        // $this->dispatch('load-publications', $data = $this->selectedResult);
    }

    public function render()
    {
        return view('livewire.word-ranking.word-ranking-create')
            ->title('Gerar ranking de palavras');
    }
}
