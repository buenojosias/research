<?php

namespace App\Livewire\Reference;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class ReferenceIndex extends Component
{
    use WithPagination;

    #[Url(except: '')]
    public $q = '';

    public $project;

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function render()
    {
        $references = $this->project->references()
            ->whereAny(['title', 'short_author'], 'like', "%$this->q%")
            ->withCount(['productions', 'citations'])
            ->orderBy('short_author')
            ->orderBy('year')
            ->paginate();

        return view('livewire.reference.reference-index', compact('references'))
            ->title('Referências');
    }
}
