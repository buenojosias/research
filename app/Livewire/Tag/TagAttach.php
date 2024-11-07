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
    public $newTag = '';

    #[On('open-attach-modal')]
    public function openAttachModal(Production $production)
    {
        $this->production = $production;

        $this->project = $this->production->project;
        $this->loadTags();

        $this->modal = true;
    }

    public function loadTags()
    {
        $this->tags = $this->project->tags()
            ->whereNull('parent_id')
            ->where(function ($query) {
                $query->whereDoesntHave('productions', function ($query) {
                    $query->where('productions.id', $this->production->id);
                })
                    ->orWhereHas('subtags', function ($query) {
                        $query->whereHas('productions', function ($query) {
                            $query->where('productions.id', $this->production->id);
                        });
                    });
            })
            ->with([
                'subtags' => function ($query) {
                    $query->whereDoesntHave('productions', function ($query) {
                        $query->where('productions.id', $this->production->id);
                    });
                }
            ])
            ->get();
    }

    public function render()
    {
        return view('livewire.tag.tag-attach');
    }

    public function submit()
    {
        if (empty($this->selectedTags)) {
            $this->dialog()->error('Selecione pelo menos uma tag para vincular!')->send();
            return;
        }
        $this->production->tags()->attach($this->selectedTags);
        $this->selectedTags = [];
        $this->loadTags();

        $this->dispatch('tag-attached');
        $this->modal = false;
    }

    public function createTag()
    {
        if ($this->newTag === '') {
            $this->dialog()->error('Digite o nome da tag!')->send();
            return;
        }

        $tag = explode(':', $this->newTag);
        $parentTag = $this->project->tags()->firstOrCreate(['name' => $tag[0], 'parent_id' => null]);

        if ($tag[1] ?? false) {
            $subTag = $parentTag->subtags()->firstOrCreate(['project_id' => $parentTag->project_id, 'name' => $tag[1]]);
        }
        $this->loadTags();
        $this->selectedTags[] = $subTag->id ?? $parentTag->id;

        // $this->tags = $this->project->tags()->select('id', 'name')->get()->toArray();
        // $this->selectedTagId = $createdTag->id;
        // $this->submit();
    }
}
