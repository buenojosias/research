<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use Illuminate\Http\Request;

class KeywordController extends Controller
{
    public function index()
    {
        $keywords = Keyword::whereJsonLength('data', '>', 0)->orderBy('id')->limit(10)->get();

        foreach ($keywords as $keyword) {
            $count = count($keyword->data);
            foreach ($keyword->data as $kw) {
                Keyword::create([
                    'production_id' => $keyword->production_id,
                    'value' => $kw,
                    'data' => [],
                ]);
                $count--;
            }
            if($count == 0) {
                $keyword->delete();
            }
        }
    }

    public function check()
    {
        $keywords = Keyword::orderBy('production_id')->get();

        return view('keywords-index', compact('keywords'));
    }
}
