<?php

namespace App\Livewire\Student;

use App\Models\Student;
use Livewire\Attributes\Title;
use Livewire\Component;

class StudentIndex extends Component
{
    public function render()
    {
        $students = Student::query()
            ->withCount('projects')
            ->when(auth()->user()->admin, fn($q) => $q->with('user'))
            ->get();

        return view('livewire.student.student-index', compact(['students']))
            ->title('Estudantes');
    }
}

// NOT ADMIN: Listar apenas estudantes que pertencem ao usuário
// ADMIN: mostrar user
// Link para formulário de cadastro
