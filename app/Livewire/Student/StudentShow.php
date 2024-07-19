<?php

namespace App\Livewire\Student;

use App\Models\Student;
use Livewire\Component;

class StudentShow extends Component
{
    public $student;

    public function mount(Student $student)
    {
        $student->load('projects');
        $this->student = $student;
    }

    public function render()
    {
        return view('livewire.student.student-show')
            ->title('Estudante');
    }
}
