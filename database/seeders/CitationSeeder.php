<?php

namespace Database\Seeders;

use App\Models\Citation;
use App\Models\Production;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitationSeeder extends Seeder
{
    public function run(): void
    {
        $productions = Production::whereHas('references')->with('references')->get();

        foreach ($productions as $production) {
            $refs = $production->references->pluck('id')->toArray();
            for ($i=0; $i < 4; $i++) {
                $refId = $refs[array_rand($refs)];
                Citation::factory(rand(1,8))->create([
                    'production_id' => $production->id,
                    'reference_id' => $refId
                ]);
            }
        }
    }
}
