<?php

namespace App\Livewire\Student;

use App\Models\Student;
use Livewire\Attributes\Title;
use Livewire\Component;

class StudentIndex extends Component
{
    #[Title('Estudantes')]

    public $sort_field;

    public $sort_order;

    public function render()
    {
        $students = Student::query()
            ->with(['user'])
            ->when($this->sort_field, function($q) {
                $q->orderBy($this->sort_field, $this->sort_order ?? 'asc');
            })
            ->get();

        return view('livewire.student.student-index', compact(['students']));
    }
}

// NOT ADMIN: Listar apenas estudantes que pertencem ao usuário
// ADMIN: mostrar user
// Mostrar número de pesquisas por estudante
// Link para formulário de cadastro
