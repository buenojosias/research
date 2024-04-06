<?php

namespace App\Livewire\WordCount;

use App\Models\Internal;
use Livewire\Attributes\On;
use Livewire\Component;

class WordCountContext extends Component
{
    public $contexts = [];

    public $ctxWord;

    public $ctxContent;

    public $finalWord;
    public $finalContent;

    public $slide = false;

    public function openSlide()
    {
        $this->generateContext();
        $this->slide = true;
    }

    public function mount($word, $content)
    {
        $this->slide = false;

        // Armazenar variável fixa
        $this->ctxContent = trim(preg_replace('/\s\s+/', ' ', $content));
        $this->ctxWord = $word;

        // Criar nova variável sem caracteres especiais
        $cleanWord = $this->removeCharacters($word);
        $cleanContent = $this->removeCharacters($content);

        // Criar nova variável em minúscula
        $lowerWord = strtolower($cleanWord);
        $lowerContent = strtolower($cleanContent);

        // Converter espaço em underline
        $noSpaceWord = str_replace(' ', '_', $lowerWord);
        $noSpaceContent = str_replace($lowerWord, $noSpaceWord, $lowerContent);

        // Armazenar valores em variáveis públicas para usar depois
        $this->finalWord = $noSpaceWord;
        $this->finalContent = $noSpaceContent;

        // $this->ctxContent = str_replace($cleanWord, $tmpWord, $this->ctxContent);
        // $this->ctxWord = str_replace(' ', '_', $word);
        // dump($this->ctxContent);

        $this->openSlide();
    }

    public function generateContext()
    {
        $words = explode(' ', $this->finalContent);

        foreach ($words as $index => $word) {
            $word = $this->removeCharacters($word);
            $noDotWords = str_replace(['.',',',';','\n','"'], '', $word);
            if (strcasecmp($noDotWords, $this->finalWord) == 0) {
                $initialPosition = max(0, $index - 10);
                $finalPosition = min(count($words) - 1, $index + 10);

                $contextBefore = array_slice($words, $initialPosition, $index - $initialPosition);
                $contextAfter = array_slice($words, $index + 1, $finalPosition - $index);

                $this->contexts[] = [
                    'word' => str_replace('_', ' ', $this->ctxWord),
                    'before' => trim(implode(' ', $contextBefore)),
                    'after' => trim(implode(' ', $contextAfter))
                ];
            }
        }
    }

    public function render()
    {
        return view('livewire.word-count.word-count-context');
    }

    public function removeCharacters($value)
    {
        return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"), $value);
    }
}
