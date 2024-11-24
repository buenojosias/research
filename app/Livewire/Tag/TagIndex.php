<?php

namespace App\Livewire\Tag;

use App\Models\Project;
use App\Models\Tag;
use Livewire\Attributes\Validate;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class TagIndex extends Component
{
    use Interactions;

    public $project;
    public $tags = [];
    public $selectedTag = null;
    public $commonTags = [];

    #[Validate('required|string', as: 'Nome da tag')]
    public $newTag = '';

    public $modal = false;

    public function mount(Project $project)
    {
        $this->project = $project;
        // $this->getTags();

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

    public function loadTags()
    {
        $this->tags = $this->project->tags()
            ->whereNull('parent_id')
            ->withCount('productions')
            ->with('subtags', function ($query) {
                $query->withCount('productions');
            })
            ->get()
            ->sortBy('name');
    }

    public function render()
    {
        $this->loadTags();
        return view('livewire.tag.tag-index');
    }

    public function selectTag(Tag $tag)
    {
        $this->selectedTag = $tag;
        $this->selectedTag->load('productions');

        // foreach ($this->tags as $tagB) {
        //     if ($this->selectedTag->id != $tagB->id) {
        //         $commonProductions = $this->selectedTag->productions->intersect($tagB->productions);

        //         if ($commonProductions->count() > 0) {
        //             $this->commonTags[] = [
        //                 'tagA' => $this->selectedTag->name,
        //                 'tagB' => $tagB->name,
        //                 'common_productions_count' => $commonProductions->count()
        //             ];
        //         }
        //     }
        // }
    }

    public function unselectTag()
    {
        $this->selectedTag = null;
    }

    public function createTag()
    {
        $this->validate();

        $tag = explode(':', $this->newTag);
        $parentTag = $this->project->tags()->firstOrCreate(['name' => $tag[0], 'parent_id' => null]);

        if ($tag[1] ?? false) {
            $subTag = $parentTag->subtags()->firstOrCreate(['project_id' => $parentTag->project_id, 'name' => $tag[1]]);
        }
        $this->toast()->success('Tag salva.')->send();
        $this->modal = false;
        $this->newTag = '';
    }
}