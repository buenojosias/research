<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class DashboardIndex extends Component
{
    public $user;

    public $projects = [];

    public function mount()
    {
        $this->user = auth()->user();

        $this->projects = $this->user->projects;
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-index');
    }
}
