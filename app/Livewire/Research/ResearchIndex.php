<?php

namespace App\Livewire\Research;

use App\Models\Research;
use Livewire\Attributes\Title;
use Livewire\Component;

class ResearchIndex extends Component
{
    #[Title('Pesquisas')]

    public function render()
    {
        $researches = Research::query()
            ->with('student')
            ->get();

        return view('livewire.research.research-index', compact(['researches']));
    }
}

// Formulário para cadastro
// Admin: mostrar todos com user
// Não admin: mostrar apenas as suas
// Quantidade de publicações
