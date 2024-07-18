<?php

namespace App\Livewire\Dashboard;

use App\Models\Project;
use App\Models\Student;
use Livewire\Component;

class DashboardIndex extends Component
{
    public $projects = [];

    public $students = [];

    public function mount()
    {
        $this->projects = Project::withCount('productions')->get();
        $this->students = Student::all();
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-index');
    }
}
