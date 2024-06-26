<?php

namespace App\Livewire\Content;

use App\Models\Project;
use Livewire\Component;

class ContentAbstract extends Component
{
    public $prods;

    public function mount(Project $project)
    {
        $this->prods = $project
            ->productions()
            ->with(['keywords'])
            ->with('abstract')
            ->get();
    }

    public function render()
    {
        $productions = $this->prods->groupBy('type');

        return view('livewire.content.content-abstract', compact('productions'));
    }
}
