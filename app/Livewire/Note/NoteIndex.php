<?php

namespace App\Livewire\Note;

use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class NoteIndex extends Component
{
    use Interactions;

    public $project;
    public $notes = [];

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function render()
    {
        $this->notes = $this->project->notes()
            ->with('production')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.note.note-index')
            ->title('Anotações');
    }

    #[On('refresh-notes')]
    public function refreshNotes()
    {
        $this->render();
    }

    public function delete($noteId)
    {
        $this->dialog()
            ->question('Você tem certeza que deseja excluir essa anotação?')
            ->confirm(method: 'deleteConfirmed', params: $noteId)
            ->send();
    }

    public function deleteConfirmed($noteId)
    {
        $note = $this->project->notes()->find($noteId);

        if ($note) {
            $note->delete();
            $this->toast()->success('Anotação excluída com sucesso!')->send();
        } else {
            $this->toast()->error('Anotação não encontrada.')->send();
        }
    }
}
