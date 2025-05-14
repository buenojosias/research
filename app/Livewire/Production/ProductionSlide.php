<?php

namespace App\Livewire\Production;

use Livewire\Attributes\On;
use Livewire\Component;

class ProductionSlide extends Component
{
    public $project;
    public $production;
    public $slide = false;

    public function mount($project)
    {
        $this->project = $project;
    }

    #[On('preview-production')]
    public function loadProduction($id)
    {
        $this->production = $this->project->productions()->with('authors', 'keywords', 'abstract')->findOrFail($id);
        $this->slide = true;
    }

    public function render()
    {
        return view('livewire.production.production-slide');
    }
}
