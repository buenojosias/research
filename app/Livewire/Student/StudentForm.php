<?php

namespace App\Livewire\Student;

use App\Models\Student;
use Livewire\Attributes\Validate;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class StudentForm extends Component
{
    use Interactions;

    public $student;

    #[Validate('required|string')]
    public $name;

    #[Validate('nullable|email')]
    public $email;

    #[Validate('nullable|string')]
    public $whatsapp;

    #[Validate('nullable|string')]
    public $institution;

    #[Validate('nullable|string')]
    public $program;

    #[Validate('nullable|string')]
    public $degree;

    #[Validate('nullable|string')]
    public $advisor;

    public function mount($student = null)
    {
        if($student) {
            $this->student = auth()->user()->students()->findOrFail($student);
            $this->name = $this->student->name;
            $this->email = $this->student->email;
            $this->whatsapp = $this->student->whatsapp;
            $this->institution = $this->student->institution;
            $this->program = $this->student->program;
            $this->degree = $this->student->degree->value;
            $this->advisor = $this->student->advisor;
        }
    }

    public function render()
    {
        return view('livewire.student.student-form')
            ->title($this->student ? 'Editar estudante' : 'Adicionar estudante');
    }

    public function save()
    {
        $data = $this->validate();
        if($data['whatsapp'] == '') { $data['whatsapp'] = null; }

        if($this->student) {
            $this->student->update($data);
            $this->toast()->success('Informações salvas com sucesso.')->send();
        } else {
            $student = auth()->user()->students()->create($data);
            $this->redirectRoute('students.show', $student, navigate: true);
        }
    }
}
