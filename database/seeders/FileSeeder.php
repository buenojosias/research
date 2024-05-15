<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\Production;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $productions = Production::select(['id','year'])->inRandomOrder('id')->limit(10)->get();

        foreach($productions as $production) {
            File::factory(1)->create([
                'production_id' => $production->id,
                'filename' => $production->year . ' - ' . $faker->sentence() . 'pdf',
                'path' => $faker->url(),
                'size' => $faker->randomFloat(2, 1, 50),
                'pages' => rand(10, 200)
            ]);
        };
    }
}
