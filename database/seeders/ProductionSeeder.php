<?php

namespace Database\Seeders;

use App\Models\Bibliometric;
use App\Models\Keyword;
use App\Models\Production;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{
    public function run(): void
    {
        $bibliometrics = Bibliometric::all();

        foreach ($bibliometrics as $bibliometric) {
            Production::factory(rand(3, 6))
                ->has(Keyword::factory())
                ->create([
                    'bibliometric_id' => $bibliometric->id,
                ])
                // ->each(function ($production) {
                //     Keyword::factory(1)->create([
                //         'production_id' => $production->id
                //     ]);
                // })
            ;
        }
    }
}
