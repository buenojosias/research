<?php

namespace App\Livewire\WordCount;

use App\Models\Internal;
use App\Models\Research;
use App\Models\WordCount;
use Livewire\Attributes\Validate;
use Livewire\Component;

class WordCountCreate extends Component
{
    public $research;

    #[Validate('required|string|min:4')]
    public $word = '';

    #[Validate('required|array')]
    public $sections = [];

    #[Validate('required|array')]
    public $publication_types = [];

    public $results = [];

    public $data = [];

    public function mount(Research $research)
    {
        $this->research = $research;
    }

    public function generate()
    {
        $this->validate();
        $this->results = Internal::query()
            // ->whereRelation('publication', 'research_id', $this->research->id)
            ->whereHas('publication', fn($query) => $query->whereIn('type', $this->publication_types))
            ->whereIn('section', $this->sections)
            ->where('content', 'like', '%' . $this->word . '%')
            ->with('publication')
            ->get();

        foreach ($this->results as $result) {
            $result['count'] = substr_count(strtoupper($result['content']), strtoupper($this->word));
            $percentage = $result['count'] * 100 / $result['total_words'];
            $result['percentage'] = number_format($percentage, 2, ',', '.');
        }
    }

    public function save()
    {
        foreach ($this->results as $result) {
            $count = substr_count(strtoupper($result['content']), strtoupper($this->word));
            $percent = $count * 100 / $result->total_words;
            $percentage = number_format($percent, 2, '.', ',');
            $record = [
                // Aqui são os dados retornados
                'publication' => [
                    'id' => $result->publication->id,
                    'type' => $result->publication->type,
                    'title' => $result->publication->title,
                    'year' => $result->publication->year,
                    'author_lastname' => $result->publication->author_lastname,
                ],
                'section' => $result->section,
                'total_words' => $result->total_words,
                'count' => $count,
                'percentage' => $percentage,
            ];
            array_push($this->data, $record);
        }

        $wordCount = [
            'research_id' => $this->research->id,
            'word' => $this->word,
            'publication_types' => $this->publication_types,
            'sections' => $this->sections,
            'records' => $this->data,
        ];

        try {
            $createdWordCount = WordCount::create($wordCount);
            dd($createdWordCount);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function render()
    {
        return view('livewire.word-count.word-count-create');
    }
}
