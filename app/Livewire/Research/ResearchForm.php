<?php

namespace App\Livewire\Research;

use App\Enums\PublicationTypeEnum;
use App\Models\Research;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ResearchForm extends Component
{
    public $research;

    public $id;

    public $pid;

    #[Validate('required|integer')]
    public $user_id;

    #[Validate('nullable|integer')]
    public $student_id;

    #[Validate('required|string|min:5')]
    public $theme;

    #[Validate('required:array')]
    public $repositories = [];

    #[Validate('required:array')]
    public $types = [];

    #[Validate('required:array')]
    public $terms = [];

    #[Validate('required:array')]
    public $combinations = [];

    #[Validate('required|integer|digits:4|min:2000|max:2024')]
    public $start_year;

    #[Validate('required|integer|digits:4|min:2000|max:2024')]
    public $end_year;

    #[Validate('required|array')]
    public $languages = ['Portugês'];

    #[Validate('required|date|before_or_equal:now')]
    public $requested_at;

    public $students = [];
    public $avaliable_types = [];
    public int $current_year;

    public function mount($research = null)
    {
        $this->user_id = auth()->user()->id;

        if($research) {
            $this->research = Research::where('pid', $research)->firstOrFail();
            $this->id = $this->research->id;
            $this->pid = $this->research->pid;
            $this->student_id = $this->research->student_id;
            $this->theme = $this->research->theme;
            $this->repositories = $this->research->repositories;
            $this->types = $this->research->types;
            $this->terms = $this->research->terms;
            $this->combinations = $this->research->combinations;
            $this->start_year = $this->research->start_year;
            $this->end_year = $this->research->end_year;
            $this->languages = $this->research->languages;
            $this->requested_at = $this->research->requested_at;
        } else {
            $this->research = null;
            $this->requested_at = date('Y-m-d');
        }

        $this->students = auth()->user()->students()->select(['id', 'name'])->get()->toArray();
        $this->avaliable_types = PublicationTypeEnum::cases();
        $this->current_year = intval(date('Y'));
    }

    public function render()
    {
        return view('livewire.research.research-form');
    }

    public function save()
    {
        $data = $this->validate();
        $data['pid'] = $this->pid ?? substr(time(), 1);

        try {
            $research = Research::updateOrCreate([
                'pid' => $this->pid,
                'user_id' => $this->user_id,
            ],
                $data
            );
            session()->flash('status', 'Pesquisa salva com sucesso.');
            $this->redirectRoute('researches.show', $research, navigate: true);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
