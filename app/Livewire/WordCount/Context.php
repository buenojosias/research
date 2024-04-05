<?php

namespace App\Livewire\WordCount;

use App\Models\Internal;
use Livewire\Attributes\On;
use Livewire\Component;

class Context extends Component
{
    public $contexts = [];

    public $ctxWord;

    public $ctxContent;

    public $slide = false;

    public function openSlide()
    {
        $this->generateContext();
        $this->slide = true;
    }

    public function mount($word, $content)
    {
        $this->slide = false;

        // $this->ctxWord = $word;
        $cleanWord = $this->removeCharacters($word);
        $cleanContent = $this->removeCharacters($content);

        $this->ctxContent = trim(preg_replace('/\s\s+/', ' ', $content));
        $this->ctxContent = str_replace($cleanWord, str_replace(' ', '_', $cleanWord), $this->ctxContent);
        $this->ctxWord = str_replace(' ', '_', $word);

        $this->openSlide();
    }

    public function generateContext()
    {
        $words = explode(' ', $this->ctxContent);

        foreach ($words as $index => $word) {
            $ctxWord = $this->removeCharacters($this->ctxWord);
            $word = $this->removeCharacters($word);
            $rm_dots = str_replace(['.',',',';','\n','"'], '', $word);
            if (strcasecmp($rm_dots, $ctxWord) == 0) {
                $initialPosition = max(0, $index - 10);
                $finalPosition = min(count($words) - 1, $index + 10);

                $contextBefore = array_slice($words, $initialPosition, $index - $initialPosition);
                $contextAfter = array_slice($words, $index + 1, $finalPosition - $index);

                $this->contexts[] = [
                    'word' => str_replace('_', ' ', $word),
                    'before' => trim(implode(' ', $contextBefore)),
                    'after' => trim(implode(' ', $contextAfter))
                ];
            }
        }
    }

    public function render()
    {
        return view('livewire.word-count.context');
    }

    public function removeCharacters($value)
    {
        return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"), $value);
    }
}
