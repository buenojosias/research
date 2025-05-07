<?php

namespace App\Livewire\Group;

use App\Models\Project;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class GroupShow extends Component
{
    use Interactions;

    public $project;
    public $group;
    public $showAbstract = false;
    // public $groupProductions = [];

    public function mount(Project $project, $group)
    {
        $this->project = $project;
        $this->group = $this->project->groups()->findOrFail($group);
    }

    #[Computed]
    public function groupProductions()
    {
        return $this->group->productions()
            ->select(['id', 'title', 'subtitle', 'type', 'year'])
            ->with('authors')
            ->get()
            ->sortBy('title');
    }

    #[On('productions-attached')]
    public function productionsAttached()
    {
        $this->groupProductions();
    }

    public function render()
    {
        return view('livewire.group.group-show')
            ->title('Grupo de produções');
    }

    public function detach($id)
    {
        $this->dialog()->confirm()
            ->question('Remover produção do grupo?')
            ->confirm(method: 'detachConfirmed', params: $id)
            ->cancel('Cancelar')
            ->send();
    }

    public function detachConfirmed($id)
    {
        $this->group->productions()->detach($id);
        $this->dispatch('production-detached');
        $this->toast()->success('Produção removida do grupo com sucesso.')->send();
    }

    public function loadAbstract()
    {
        $this->groupProductions->load('abstract');
        $this->showAbstract = true;
    }
}
