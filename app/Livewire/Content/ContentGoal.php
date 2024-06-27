<?php

namespace App\Livewire\Content;

use App\Models\Project;
use Livewire\Component;

class ContentGoal extends Component
{
    public $productions;

    public $productionsWithGoal;

    public $productionsWithoutGoal;

    public function mount(Project $project)
    {
        $this->productions = $project
            ->productions()
            ->whereIn('type', ['Tese', 'Dissertação', 'Artigo científico'])
            ->with('goals')
            ->get();

        $this->productionsWithGoal = $this->productions->filter(
            fn($item) => $item
                ->goals
                ->count()
        );

        $this->productionsWithoutGoal = $this->productions->filter(
            fn($item) => $item
                ->goals
                ->isEmpty()
        );
    }


    public function render()
    {
        return view('livewire.content.content-goal');
    }
}
