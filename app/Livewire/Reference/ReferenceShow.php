<?php

namespace App\Livewire\Reference;

use App\Models\Project;
use Livewire\Component;

class ReferenceShow extends Component
{
    public $project;

    public $reference;

    public $productions;

    public function mount(Project $project, $reference)
    {
        $this->project = $project;

        $this->reference = $this->project->references()->findOrFail($reference);

        $this->productions = $this->reference->productions()
            ->withCount(['citations' => function($q){
                $q->where('reference_id', $this->reference->id);
            }])
            ->get();
    }

    public function render()
    {
        return view('livewire.reference.reference-show')
            ->title('Detalhes da referência');
    }
}
