<?php

namespace App\Livewire\Reference;

use App\Models\Project;
use Livewire\Component;

class ReferenceProject extends Component
{
    public $project;
    public $references;

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function render()
    {
        $this->references = $this->project->productions()
            ->select('id', 'title', 'subtitle', 'year', 'type', 'institution', 'periodical', 'url', 'doi', 'city', 'created_at')
            ->with('authors')
            ->get()
            ->sortBy(function ($production) {
                return $production->authors->first()->lastname ?? '';
            });

        $this->references->map(function ($production) {
            $accessAt = $production->created_at->format('d'). ' ';
            $accessAt .= \App\Enums\MonthEnum::from($production->created_at->format('m'))->toAbbr(). ' ';
            $accessAt .= $production->created_at->format('Y');
            return $production->access_at = $accessAt;
        });

        return view('livewire.reference.reference-project')
            ->title('Referências do projeto');
    }
}
