<?php

namespace App\Livewire\Bibliometric;

use App\Models\Project;
use Livewire\Component;

class BibliometricShow extends Component
{
    public $project;

    public $bibliometric;

    public $productions;

    public $types;

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->bibliometric = $project->bibliometric;

        if (!$this->bibliometric) {
            redirect()->route('project.bibliometrics.create', $project);
        }

        if ($this->bibliometric) {
            $this->bibliometric->period = $this->bibliometric->start_year . ' - ' . $this->bibliometric->end_year;
        }

        $this->types = $project->productions()
            ->select('type', \DB::raw('COUNT(*) as count'))
            ->groupBy('type')
            ->get();
    }

    public function render()
    {
        return view('livewire.bibliometric.bibliometric-show')
            ->title('Bibliometria');
    }
}
