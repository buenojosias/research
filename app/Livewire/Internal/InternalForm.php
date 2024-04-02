<?php

namespace App\Livewire\Internal;

use App\Models\Publication;
use Livewire\Attributes\Validate;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class InternalForm extends Component
{
    use Interactions;

    public $section;

    public $publication;

    public $internal;

    public $content;

    public $total_words;

    public $first_page;

    public $last_page;

    public function mount(Publication $publication)
    {
        if (request()->routeIs('*.publications.abstract')) {
            $this->section = 'abstract';
        } else if (request()->routeIs('*.publications.body')) {
            $this->section = 'body';
        } else {
            return abort(404);
        }

        $this->publication = $publication;

        $this->internal = $this->publication->internals()
            ->where('section', $this->section)
            ->first();

        if ($this->internal)
            $this->content = $this->internal->content;
    }

    public function extractText()
    {
        $this->validate([
            'first_page' => 'required|integer|min:1',
        ]);
        $this->validate([
            'last_page' => 'required|integer|min:' . $this->first_page,
        ]);

        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile('uploads/teste.pdf');

        $text = '';

        for ($i = $this->first_page - 1; $i <= $this->last_page - 1; $i++) {
            $pages = $pdf->getPages()[$i];
            $text .= $pages->getText();
        }

        $text = preg_replace('/\n|\r\n|\r|<br \/>/', '', $text);
        $extracted = preg_replace('/<br \/>/', '', $text);
        $extracted = trim($extracted);
        $this->content = $extracted;
    }

    public function save()
    {
        $this->validate([
            'content' => 'required|string',
        ]);

        $words = preg_split('/\s+|(?<!\pL)(?<!\d)(?!\d*\pL)/u', $this->content, -1, PREG_SPLIT_NO_EMPTY);
        $this->total_words = count($words);

        if (
            $this->publication->internals()->updateOrCreate(
                [
                    'section' => $this->section,
                ],
                [
                    'content' => $this->content,
                    'total_words' => $this->total_words,
                ]
            )
        )
            $this->toast()->success('Conteúdo salvo com sucesso.')->send();
        ;
    }

    public function render()
    {
        return view('livewire.internal.internal-form')
            ->title($this->section == 'abstract' ? 'Resumo da publicação' : 'Conteúdo completo da publicação');
    }
}
