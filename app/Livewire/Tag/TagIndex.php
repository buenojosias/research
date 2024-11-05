<?php

namespace App\Livewire\Tag;

use App\Models\Project;
use Livewire\Component;

class TagIndex extends Component
{
    public $project;
    public $tags = [];
    public $commonTags = [];

    public function mount(Project $project)
    {
        $this->project = $project;

        $this->tags = $this->project->tags()
            ->whereNull('parent_id')
            ->withCount('productions')
            ->with('subtags', function ($query) {
                $query->withCount('productions');
            })
            ->get()
            ->sortBy('name');

        // SCRIPT PARA ENCONTRAR TAGS COMUNS
        // foreach ($this->tags as $tagA) {
        //     foreach ($this->tags as $tagB) {
        //         if ($tagA->id != $tagB->id) {
        //             $commonProductions = $tagA->productions->intersect($tagB->productions);

        //             if ($commonProductions->count() > 0) {
        //                 $this->commonTags[] = [
        //                     'tagA' => $tagA->name,
        //                     'tagB' => $tagB->name,
        //                     'common_productions_count' => $commonProductions->count()
        //                 ];
        //             }
        //         }
        //     }
        // }
    }

    public function render()
    {
        return view('livewire.tag.tag-index');
    }
}
