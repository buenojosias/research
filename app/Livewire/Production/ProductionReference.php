<?php

namespace App\Livewire\Production;

use App\Models\Project;
use Livewire\Component;

class ProductionReference extends Component
{
    public $project;
    public $production;

    public function mount(Project $project, $production)
    {
        $this->project = $project;

        $this->production = $project->productions()->findOrFail($production);
    }

    public function render()
    {
        return view('livewire.production.production-reference')
            ->layout('layouts.production')
            ->layoutData([
                'title' => 'Referências da produção',
                'project' => $this->project,
                'production' => $this->production,
            ]);
    }
}
