<?php

namespace App\Livewire\Note;

use Livewire\Attributes\On;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class NoteCreate extends Component
{
    use Interactions;

    public $project;
    public $production = null;
    public $content = null;
    public $modal = false;

    public function mount($project)
    {
        $this->project = $project;
    }

    #[On('open-modal')]
    public function openModal($production = null)
    {
        $this->production = $production;
        $this->modal = true;
    }

    public function render()
    {
        return view('livewire.note.note-create');
    }

    public function save()
    {
        $this->validate([
            'content' => 'required|string|max:255',
        ]);

        $this->project->notes()->create([
            'production_id' => $this->production['id'] ?? null,
            'content' => $this->content,
        ]);

        $this->toast()->success('Anotação criada com sucesso!')->send();
        $this->reset(['modal', 'production', 'content']);
        $this->dispatch('refresh-notes');
    }
}
