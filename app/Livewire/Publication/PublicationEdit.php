<?php

namespace App\Livewire\Publication;

use App\Models\Research;
use App\Models\State;
use Livewire\Attributes\Validate;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class PublicationEdit extends Component
{
    use Interactions;

    public $research;
    public $publication;
    public $years = [];
    public $states = [];
    public $terms = [];
    public $author = [];
    public $authors_display = [];

    #[Validate('required|url')]
    public $url;

    #[Validate('required|string|in_array:research.repositories.*')]
    public $repository;

    #[Validate('required|string')]
    public $title;

    #[Validate('nullable|string')]
    public $subtitle;

    #[Validate('required|integer|digits:4|in_array:years.*')]
    public $year;

    #[Validate('required|array')]
    public $authors = [];

    // #[Validate('required|string|in_array:research.types.*')]
    #[Validate('required')]
    public $type;

    #[Validate('required|string|in_array:research.languages.*')]
    public $language;

    #[Validate('required|array')]
    public $searched_terms = [];

    #[Validate('nullable|string')]
    public $institution;

    #[Validate('nullable|string')]
    public $program;

    #[Validate('nullable|string')]
    public $city;

    #[Validate('nullable|integer|in_array:states.*.id')]
    public $state_id;

    #[Validate('nullable|string')]
    public $periodical;

    #[Validate('nullable|string')]
    public $doi;

    public function mount(Research $research, $publication)
    {
        $this->research = $research;
        $this->publication = $research->publications()->findOrFail($publication);

        for($i = $this->research->start_year; $i <= $this->research->end_year; $i++) {
            array_push($this->years, $i);
        }

        $this->states = State::select('id', 'abbreviation')->orderBy('abbreviation')->get()->toArray();

        $this->terms = $this->research->terms;

        $this->url = $this->publication->url;
        $this->repository = $this->publication->repository;
        $this->title = $this->publication->title;
        $this->subtitle = $this->publication->subtitle;
        $this->year = $this->publication->year;
        $this->authors = $this->publication->authors;
        $this->type = $this->publication->type;
        $this->language = $this->publication->language;
        $this->searched_terms = $this->publication->searched_terms;
        $this->institution = $this->publication->institution;
        $this->program = $this->publication->program;
        $this->city = $this->publication->city;
        $this->state_id = $this->publication->state_id;
        $this->periodical = $this->publication->periodical;
        $this->doi = $this->publication->doi;

        foreach($this->authors as $author) {
            array_push($this->authors_display, ' ' . $author['forename'] .' '. $author['lastname']);
        }
    }

    public function save()
    {
        $data = $this->validate();

        try {
            $this->publication->update($data);
        } catch (\Throwable $th) {
            dump($th);
        }
        $this->toast()->success('Salvo', 'Informações salvas com sucesso.')->send();
    }
    public function render()
    {
        return view('livewire.publication.publication-edit')
            ->title('Editar publicação');
    }

    public function addAuthor()
    {
        $this->validate([
            'author.forename' => 'required|string',
            'author.lastname' => 'required|string',
        ]);
        array_push($this->authors, [ 'forename' => $this->author['forename'], 'lastname' => $this->author['lastname'] ]);
        array_push($this->authors_display, ' ' . $this->author['forename'] .' '. $this->author['lastname']);
        $this->reset('author');
    }

    public function removeAuthor($key)
    {
        array_splice($this->authors, $key, 1);
        array_splice($this->authors_display, $key, 1);
    }
}
