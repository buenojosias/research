<?php

namespace App\Livewire\WordRanking;

use App\Models\Internal;
use App\Models\Research;
use App\Models\WordRanking;
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

    #[Validate('nullable|array')]
    public $years;

    #[Validate('required|integer')]
    public $minLenght = 4;

    #[Validate('required|integer')]
    public $wordsLimit = 50;

    public $combinedWords = ['fusca azul', 'Odio ullam'];

    public $excludedWords = [];

    public $results = [];

    public $selectedResult;

    #[Validate('nullable|string')]
    public $title;

    #[Validate('nullable|string')]
    public $description;

    public $data = [];

    public $savingModal = false;

    public $savedModal = false;

    public $savedWordRanking;

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

    public function save()
    {
        $filters = [
            'min_lenght' => $this->minLenght,
            'publication_types' => $this->publication_types,
            'internal_sections' => $this->sections,
            'years' => $this->years,
        ];
        foreach ($this->results as $result) {
            $record = [
                'id' => $result['id'],
                'word' => $result['word'],
                'count' => $result['count'],
                'internal_count' => count($result['internals']),
                'internal_ids' => $result['internals'],
            ];
            $this->data[] = $record;
        }

        $wordRanking = [
            'research_id' => $this->research->id,
            'title' => $this->title,
            'description' => $this->description,
            'words_limit' => $this->wordsLimit,
            'filters' => $filters,
            'records' => $this->data,
        ];

        // dump($wordRanking);

        try {
            $this->savedWordRanking = WordRanking::create($wordRanking);
            $this->savingModal = false;
            $this->savedModal = true;
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function clear()
    {
        $this->savedModal = false;
        $this->reset(['title', 'description', 'data', 'results']);
    }

    public function render()
    {
        return view('livewire.word-ranking.word-ranking-create')
            ->title('Gerar ranking de palavras');
    }
}
