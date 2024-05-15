<?php

namespace Database\Seeders;

use App\Models\Keyword;
use App\Models\Production;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeywordSeeder extends Seeder
{
    public function run(): void
    {
        $productions = Production::select('id')->inRandomOrder('id')->limit(20)->get();
        $productions->each(function (Production $production){
            Keyword::factory(1)->create([
                'production_id' => $production->id
            ]);
        });
    }
}
