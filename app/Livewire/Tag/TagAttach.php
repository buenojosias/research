<?php

namespace App\Livewire\Tag;

use App\Models\Production;
use Livewire\Attributes\On;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class TagAttach extends Component
{
    use Interactions;

    public $project;
    public $production;
    public $tags = [];
    public $modal = false;
    public $selectedTags = [];

    #[On('open-attach-modal')]
    public function openAttachModel(Production $production)
    {
        $this->selectedTagId = null;
        $this->production = $production;

        $this->project = $this->production->project;
        $this->tags = $this->project->tags()
            ->whereNull('parent_id')
            ->whereDoesntHave('productions', function ($query) {
                $query->where('productions.id', $this->production->id);
            })
            ->with('subtags', function ($query) {
                $query->whereDoesntHave('productions', function ($query) {
                    $query->where('productions.id', $this->production->id);
                });
            })
            ->get()
            ->sortBy('name');

        $this->modal = true;
    }

    public function render()
    {
        return view('livewire.tag.tag-attach');
    }

    public function submit()
    {
        $this->dispatch('tag-attached');
        if (empty($this->selectedTags)) {
            $this->dialog()->error('Selecione pelo menos uma tag para vincular!')->send();
            return;
        }
        $this->production->tags()->attach($this->selectedTags);
        $this->selectedTags = [];

        // $this->dispatch('tag-attached');
        $this->modal = false;
    }

    #[On('create-tag')]
    public function createTag($term)
    {
        $createdTag = $this->project->tags()->create([
            'name' => $term
        ]);
        // $this->tags = $this->project->tags()->select('id', 'name')->get()->toArray();
        $this->selectedTagId = $createdTag->id;
        $this->submit();
    }
}
