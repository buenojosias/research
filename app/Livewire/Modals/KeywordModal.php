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

        $words = str_replace('.', ';', $this->input);
        $words = array_filter(explode(';', $words));
        $words = array_map('trim', $words);

        foreach ($words as $word) {
            $word = \Str::ucfirst($word);
            $this->production->keywords()->create([
                'value' => $word,
            ]);
        }

        $this->dispatch('keyword-added');
        $this->reset('input');
        $this->modal = false;
    }
}
