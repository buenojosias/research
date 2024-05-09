<?php

namespace App\Livewire\Bibliometric;

use App\Models\Research;
use Livewire\Attributes\Title;
use Livewire\Component;

class BibliometricIndex extends Component
{
    #[Title('Pesquisas')]

    public function render()
    {
        $researches = Research::query()
            ->with('student')
            ->withCount('publications')
            ->get();

        return view('livewire.bibliometric.bibliometric-index', compact(['researches']));
    }
}

// Formulário para cadastro
// Admin: mostrar todos com user
// Não admin: mostrar apenas as suas
// Quantidade de publicações
