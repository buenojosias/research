<?php

namespace App\Livewire\Production;

use App\Models\Project;
use App\Models\Tag;
use Livewire\Attributes\On;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class ProductionTags extends Component
{
    use Interactions;

    public $project;
    public $production;

    public $tags = [];

    public $selectedTag;

    public function mount(Project $project, $production)
    {
        $this->project = $project;

        $this->production = $project
            ->productions()
            ->findOrFail($production);
    }

    public function getTags()
    {
        $this->tags = $this->production->tags()
            ->doesntHave('subtags')
            ->with('parent')
            ->orderBy('name')
            ->get();
    }

    public function render()
    {
        $this->tags = $this->production->tags()
            ->with('parent')
            ->orderBy('name')
            ->get();

        return view('livewire.production.production-tags')
            ->layout('layouts.production')
            ->layoutData([
                'title' => 'Tags da produção',
                'project' => $this->project,
                'production' => $this->production,
            ]);
    }

    public function selectTag(Tag $tag)
    {
        $this->selectedTag = $tag;
        $this->selectedTag->load([
            'productions' => function ($query) {
                $query->where('production_id', '<>', $this->production->id);
            }
        ]);
    }

    #[On('tag-attached')]
    public function tagAttached()
    {
        $this->toast()->success('Tag vinculada com sucesso!')->send();
    }

    public function detachTag($tag)
    {
        $this->production->tags()->detach($tag['id']);
        $this->getTags();
        $this->toast()->success('Tag removida com sucesso!')->send();
    }
}
