<?php

namespace App\Livewire\File;

use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Upload extends Component
{
    use WithFileUploads;

    public $production;

    public $production_id;

    public $filename;

    public $path;

    public $size;

    #[Validate('mimes:pdf')]
    public $file;

    public $pages;

    public function mount($production)
    {
        $this->production = $production;
        $this->production_id = $production->id;

        $this->filename =
            $this->production->title . ' (' .
            $this->production->year . ')';
    }

    public function updatedFile(): void
    {
        $this->validate();
        $this->size = number_format($this->file->getSize() / 1024 / 1024, 3, '.', ',');
        $this->store();
    }

    public function store(): void
    {
        $saved = $this->file->store('pdfs');
        $this->path = str_replace('pdfs/', '', $saved);
        $file = Storage::disk('s3')->get($saved);

        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseContent($file);
        $this->pages = count($pdf->getPages());

        $this->save();
    }

    public function save()
    {
        $data = $this->validate([
            'production_id' => 'required|integer',
            'filename' => 'required|string',
            'path' => 'required|string',
            'size' => 'required|decimal:3',
            'pages' => 'required|integer|min:1'
        ]);

        try {
            $file = $this->production->file()->create($data);
            // $file = File::query()->create($data);
            $this->dispatch('file-uploaded', file: $file);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function render()
    {
        return view('livewire.file.upload');
    }
}
