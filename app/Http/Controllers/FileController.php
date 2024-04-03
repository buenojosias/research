<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        $files = Storage::allFiles('files');
        dd($files);
    }

    public function show($path)
    {
        // $pdf = File::where('path', $path)->firstOrFail();
        // $path = $pdf->path;
        return Storage::response('files/'.$path);
    }
}
