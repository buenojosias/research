<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Production;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $productions = Production::withoutGlobalScopes()->wheredoesntHave('authorss')->orderBy('id')->limit(20)->get();

        foreach ($productions as $production) {
            $authors = $production->authors;
            foreach ($authors as $author) {
                Author::create([
                    'production_id' => $production->id,
                    'forename' => trim($author['forename']),
                    'lastname' => trim($author['lastname'])
                ]);
            }
            // $production->authors = null;
            // $production->save();
        }
    }

    public function check()
    {
        $productions = Production::with('authorss')->orderBy('id')->get();

        return view('authors-index', compact('productions'));
    }
}
