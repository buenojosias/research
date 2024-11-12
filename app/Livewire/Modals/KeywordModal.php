<?php

namespace App\Livewire\Modals;

use App\Models\Keyword;
use Livewire\Component;

class KeywordModal extends Component
{
    public $production;

    public $keywords;

    public $input;

    public $modal = false;

    public function mount($production)
    {
        $this->$production = $production;
        // $this->$keywords = $production->keywords;
    }

    public function render()
    {
        return view('livewire.modals.keyword-modal');
    }

    public function submit()
    {
        $this->validate([
            'input' => 'required|string'
        ]);

        $words = explode(';', $this->input);
        foreach ($words as $word) {
            $this->production->keywords()->create([
                'value' => $word,
                'data' => []
            ]);
        }

        $this->dispatch('keyword-added');
        $this->reset('input');
        $this->modal = false;
    }
}
