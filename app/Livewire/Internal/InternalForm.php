<?php

namespace App\Livewire\Internal;

use App\Models\Publication;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class InternalForm extends Component
{
    use Interactions;

    public $section;

    public $publication;

    public $file;

    public $internal;

    public $content;

    public $total_words;

    public int $first_page;

    public int $last_page;

    public $path;

    #[On('file-uploaded')]
    public function fileUploaded($file)
    {
        $this->file = $this->publication->file()->find($file['id']);
        $this->path = str_replace('files/', '', $this->file->path);
        $this->toast()->success('Arquivo enviado com sucesso.')->send();
    }

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
        $this->file = $this->publication->file;

        if ($this->file)
            $this->path = str_replace('files/', '', $this->file->path);

        $this->internal = $this->publication->internals()
            ->where('section', $this->section)
            ->first();

        if ($this->internal)
            $this->content = $this->internal->content;
    }

    public function extractText()
    {
        $this->validate([
            'first_page' => 'required|integer|min:1|lte:file.pages',
        ]);
        $this->validate([
            'last_page' => 'required|integer|gte:first_page|lte:file.pages',
        ]);

        $path = storage_path('app/'.$this->file->path);
        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile($path);

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
