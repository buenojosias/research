<?php

namespace App\Livewire\Group;

use App\Models\Project;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class GroupIndex extends Component
{
    public $project;

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    #[Computed()]
    public function groups()
    {
        return $this->project->groups()->withCount('productions')->get();
    }

    #[On('group-created')]
    public function groupCreated()
    {
        $this->groups();
    }

    public function render()
    {
        return view('livewire.group.group-index')
            ->title('Groups de produções');
    }
}
