<?php

namespace App\Livewire\Production;

use App\Models\Project;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductionCitation extends Component
{
    use WithPagination;

    public $project;
    public $production;

    #[Url('ref', except: '')]
    public $ref = '';

    public $q;

    public function mount(Project $project, $production)
    {
        $this->project = $project;

        $this->production = $project->productions()->findOrFail($production);
    }

    public function render()
    {
        $citations = $this->production->citations()
            ->where('content', 'like', '%'.$this->q.'%')
            ->with('reference')
            ->paginate();

        return view('livewire.production.production-citation', compact('citations'))
            ->layout('layouts.production')
            ->layoutData([
                'title' => 'Citações da produção',
                'project' => $this->project,
                'production' => $this->production,
            ]);
    }
}
