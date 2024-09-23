<?php

namespace App\Livewire\Production;

use App\Models\Project;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class ProductionGoal extends Component
{
    use Interactions;

    public $project;

    public $production;

    public $generalGoal;

    public $specificGoals;

    public $editingGeneral = false;

    public $creatingSpecific = false;

    public $specificContent;

    public function mount(Project $project, $production)
    {
        $this->project = $project;

        $this->production = $project->productions()
            ->select(['id', 'title', 'subtitle', 'year'])
            ->with('goals')
            ->findOrFail($production);

        $this->generalGoal = $this->production->goals->where('level', 'Geral')->first()->content ?? null;
    }

    public function render()
    {
        $this->specificGoals = $this->production->goals->where('level', 'Específico');
        return view('livewire.production.production-goal')
            ->layout('layouts.production')
            ->layoutData([
                'title' => 'Objetivos da produção',
                'project' => $this->project,
                'production' => $this->production,
            ]);
    }

    public function saveGeneralGoal()
    {
        $this->production->generalGoal()->updateOrCreate(
            ['level' => 'Geral'],
            ['content' => $this->generalGoal]
        );

        $this->editingGeneral = false;
        $this->toast()->success('Objetivo salvo com sucesso.')->send();
    }

    public function saveSpecificGoal($id = null)
    {
        if ($id) {
            $goal = $this->production->specificGoals()->findOrFail($id);
            $goal->content = $this->specificGoals->find($id)->content;
            dd($goal->content);
        } else {
            $this->production->specificGoals()->create([
                'level' => 'Específico',
                'content' => $this->specificContent
            ]);
        }
        $this->creatingSpecific = false;
        $this->reset('specificContent');
        $this->toast()->success('Objetivo específico salvo com sucesso.')->send();
    }

    public function deleteSpecificGoal($id): void
    {
        $this->dialog()
            ->question('Remover este objetivo específico?')
            ->confirm('Confirmar', 'confirmDelete', $id)
            ->cancel()
            ->send();
    }

    public function confirmDelete($id): void
    {
        $this->production->goals()->find($id)->delete();
        $this->toast()->success('Objetivo removido com sucesso.')->send();
    }
}
