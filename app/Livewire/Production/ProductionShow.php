<?php

namespace App\Livewire\Production;

use App\Models\Project;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class ProductionShow extends Component
{
    use Interactions;

    public $project;
    public $production;

    public function mount(Project $project, $production)
    {
        $this->project = $project;
        $this->production = $project
            ->productions()
            ->withTrashed()
            ->with('state','file','customFields')
            ->findOrFail($production);
    }

    public function highlight()
    {
        $this->toast()->success('Destaque adicionado à produção')->send();
        $this->production->update(['highlighted' => true]);
    }

    public function unhighlight()
    {
        $this->toast()->success('Destaque removido da produção')->send();
        $this->production->update(['highlighted' => false]);
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
        ->layout('layouts.production')
        ->layoutData([
            'title' => 'Produção',
            'project' => $this->project,
            'production' => $this->production,
        ]);

    }
}
