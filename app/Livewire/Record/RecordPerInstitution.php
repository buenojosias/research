<?php

namespace App\Livewire\Record;

use App\Models\Production;
use App\Models\Project;
use Livewire\Component;

class RecordPerInstitution extends Component
{
    public $project;

    // public $cities = [];

    // #[Url('instituicao', except: '')]
    public $selectedInstitution = '';

    public $institutionProductions = [];

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function render()
    {
        $institutions = Production::query()
            ->select(['id', 'title', 'institution'])
            ->where('project_id', $this->project->id)
            ->orderBy('institution')
            ->get()
            ->groupBy('institution');

        return view('livewire.record.record-per-institution', compact('institutions'))
            ->title('Relatório por instituição');
    }

    public function selectInstitution($key)
    {
        $this->selectedInstitution = $key;
        $this->institutionProductions = $this->project->productions()->where('institution', $this->selectedInstitution)->get();
    }

    public function selectWithoutInstitution()
    {
        $this->selectedInstitution = 'não informada';
        $this->institutionProductions = $this->project->productions()->whereNull('institution')->get();
    }
}
