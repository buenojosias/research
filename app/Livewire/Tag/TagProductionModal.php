<?php

namespace App\Livewire\Tag;

use App\Models\Production;
use Livewire\Attributes\On;
use Livewire\Component;

class TagProductionModal extends Component
{
    public $production;
    public $tags = [];
    public $modal = false;

    #[On('select-production')]
    public function selectProduction(Production $production)
    {
        $this->production = $production;
        $this->tags = $this->production->tags()
            ->doesntHave('subtags')
            ->with('parent')
            ->orderBy('name')
            ->get();

        $this->modal = true;
    }

    #[On('tag-attached')]
    public function tagAttached()
    {
        $this->tags = $this->production->tags;
    }

    public function detachTag($tag)
    {
        $this->production->tags()->detach($tag['id']);

        $this->tags = $this->production->tags;
    }

    public function render()
    {
        return view('livewire.tag.tag-production-modal');
    }
}
