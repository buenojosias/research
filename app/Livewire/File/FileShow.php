<?php

namespace App\Livewire\File;

use App\Models\Research;
use Livewire\Component;

class FileShow extends Component
{
    public $research;

    public $publication;

    public $file;

    public $extracted;

    public function mount(Research $research, $publication)
    {
        $this->research = $research;

        $this->publication = $research->publications()
            ->select(['id', 'title', 'subtitle', 'year', 'author_lastname'])
            ->with('file')
            ->findOrFail($publication);

        $this->file = $this->publication->file;
    }

    public function render()
    {
        return view('livewire.file.file-show')
            ->title('Arquivo da publicação');
    }

    public function extractText()
    {
        $first_page = 1;
        $last_page = 5;

        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile('uploads/teste.pdf');

        $text = '';

        // $details = $pdf->getDetails();
        // $total_pages = $details['Pages'];

        for ($i = $first_page - 1; $i <= $last_page - 1; $i++) {
            $pages = $pdf->getPages()[$i];
            $text .= $pages->getText();
        }

        $text = preg_replace('/\n|\r\n|\r|<br \/>/', '', $text);
        $extracted = preg_replace('/<br \/>/', '', $text);
        $this->extracted = $extracted;
    }
}
