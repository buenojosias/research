<?php

namespace Database\Seeders;

use App\Models\Keyword;
use App\Models\Publication;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeywordSeeder extends Seeder
{
    public function run(): void
    {
        $publications = Publication::select('id')->inRandomOrder('id')->limit(20)->get();
        $publications->each(function (Publication $publication){
            Keyword::factory(1)->create([
                'publication_id' => $publication->id
            ]);
        });
    }
}
