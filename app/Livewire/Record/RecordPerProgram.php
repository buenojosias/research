<?php

namespace App\Livewire\Record;

use App\Models\Production;
use App\Models\Project;
use Livewire\Component;

class RecordPerProgram extends Component
{
    public $project;

    // public $cities = [];

    // #[Url('programa', except: '')]
    public $selectedProgram = '';

    public $programProductions = [];

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function render()
    {
        $programs = Production::query()
            ->select(['id', 'state_id', 'title', 'program'])
            ->where('project_id', $this->project->id)
            ->orderBy('program')
            ->get()
            ->groupBy('program');

        return view('livewire.record.record-per-program', compact('programs'))
            ->title('Relatório por programa');
    }

    public function selectProgram($key)
    {
        $this->selectedProgram = $key;
        $this->programProductions = $this->project->productions()->where('program', $this->selectedProgram)->get();
    }

    public function selectWithoutProgram()
    {
        $this->selectedProgram = 'não informado';
        $this->programProductions = $this->project->productions()->whereNull('program')->get();
    }
}
