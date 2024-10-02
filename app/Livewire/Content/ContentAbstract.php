<?php

namespace App\Livewire\Content;

use App\Models\Project;
use Livewire\Component;

class ContentAbstract extends Component
{
    public $prods;

    public $showKeywords = false;

    public $showGoal = false;

    public function mount(Project $project)
    {
        $this->prods = $project
            ->productions()
            ->with(['keywords', 'generalGoal'])
            ->with('abstract')
            ->get();
    }

    public function render()
    {
        $productions = $this->prods->groupBy('type');

        return view('livewire.content.content-abstract', compact('productions'))
            ->title('Resumos');
    }
}
