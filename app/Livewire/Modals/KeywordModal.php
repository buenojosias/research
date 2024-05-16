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
        $object = json_decode($this->keywords, true);
        $data = $object['data'];
        array_push($data, strtolower($this->input));
        $json = $data;

        if($this->keywords->update(['data' => $json]))
            $this->dispatch('keyword-added');
            $this->reset('input');
            $this->modal = false;
    }
}
