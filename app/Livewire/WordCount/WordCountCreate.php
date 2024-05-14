<?php

namespace App\Livewire\WordCount;

use App\Models\Internal;
use App\Models\Project;
use App\Models\WordCount;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class WordCountCreate extends Component
{
    public $project;

    public $bibliometric;

    public $content = '';

    #[Validate('required|string|min:4')]
    public $word = '';

    #[Validate('required|array')]
    public $sections = [];

    #[Validate('required|array')]
    public $production_types = [];

    public $results = [];

    public $data = [];

    public $savedModal = false;

    public $savedWordCount;

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->bibliometric = $project->bibliometric;
    }

    public function generate()
    {
        $this->validate();
        $this->word = trim($this->word);
        $results = Internal::query()
            // ->whereRelation('publication', 'research_id', $this->research->id)
            ->whereHas('production', fn($query) => $query->whereIn('type', $this->production_types))
            ->whereIn('section', $this->sections)
            ->when(strpos($this->word, ' ') !== false, function ($query) {
                $query->where('content', 'LIKE', "%$this->word%");
            })
            ->when(strpos($this->word, ' ') === false, function ($query) {
                $query->whereFullText('content', $this->word);
            })
            ->get();

        $this->results = $results;

        $this->fillInternals();
    }

    public function fillInternals()
    {
        $this->results->load('productions');

        $this->results->map(function ($result) {
            $word = $this->removeCharacters($this->word);
            $content = $this->removeCharacters($result->content);

            // $result->count = substr_count(strtoupper($result->content), strtoupper(' '.$this->word.' '));
            $result->count = preg_match_all('/\b' . preg_quote($word, '/') . '\b/i', $content);
            $percentage = $result->count * 100 / $result->total_words;
            $result->percentage = number_format($percentage, 2, ',', '.');
            return $result;
        });
    }

    public function save()
    {
        foreach ($this->results as $result) {
            // $count = substr_count(strtoupper($result['content']), strtoupper($this->word));
            $count = preg_match_all('/\b' . preg_quote($this->word, '/') . '\b/i', $result->content);
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
                'internal_id' => $result->id,
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
            $this->savedWordCount = WordCount::create($wordCount);
            $this->savedModal = true;
            $this->reset(['word', 'results', 'data']);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function loadContext($id, $section)
    {
        $this->fillInternals();
        $content = $this->results->where('id', $id)->where('section', $section)->first();
        $this->content = $content->content;
    }

    #[On('close-slide')]
    public function closeSlide()
    {
        $this->content = null;
        $this->fillInternals();
    }

    public function render()
    {
        return view('livewire.word-count.word-count-create')
            ->title('Nova contagem de palavras');
    }

    public function removeCharacters($value)
    {
        return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $value);
    }
}
