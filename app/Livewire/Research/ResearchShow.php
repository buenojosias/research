<?php

namespace App\Livewire\Research;

use App\Models\Publication;
use App\Models\Research;
use Livewire\Component;

class ResearchShow extends Component
{
    public $research;

    public $publications;

    public $types;

    public function mount(Research $research)
    {
        $this->research = $research;
        $this->research->period = $research->start_year . ' - '. $research->end_year;
        $this->research->load('student');
        $this->publications = $research->publications()->take(6)->get();

        $this->types = $research->publications()
            ->select('type', \DB::raw('COUNT(*) as count'))
            ->groupBy('type')
            ->get();
    }

    public function render()
    {
        return view('livewire.research.research-show')
            ->title($this->research->title);
    }
}
