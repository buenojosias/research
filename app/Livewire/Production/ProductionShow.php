<?php

namespace App\Livewire\Production;

use App\Models\Project;
use Livewire\Component;

class ProductionShow extends Component
{
    public $project;
    public $production;

    public function mount(Project $project, $production)
    {
        // TODO: Verificar se Research será mesmo usado e possivelmente excluir
        $this->project = $project;
        $this->production = $project
            ->productions()
            ->withTrashed()
            ->with('state','file')
            ->findOrFail($production);
    }

    public function remove()
    {
        $this->production->delete();
    }

    public function delete()
    {
        $this->production->forceDelete();
        $this->redirectRoute('project.bibliometrics.productions.index', ['project' => $this->project], navigate: true);
    }

    public function restore()
    {
        $this->production->restore();
    }

    public function render()
    {
        return view('livewire.production.production-show')
            ->title($this->production->title);
    }
}
