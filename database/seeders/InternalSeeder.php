<?php

namespace Database\Seeders;

use App\Models\Production;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InternalSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $productions = Production::all();

        foreach ($productions as $production) {
            $seed_abstract = $faker->boolean();
            $seed_body = $faker->boolean();

            if($seed_abstract) {
                \DB::table('internals')->insert([
                    'production_id' => $production->id,
                    'section' => 'Resumo',
                    'content' => $faker->paragraph(),
                    'total_words' => rand(30, 100),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            if($seed_body) {
                \DB::table('internals')->insert([
                    'production_id' => $production->id,
                    'section' => 'Textual',
                    'content' => $faker->paragraphs(rand(5, 50), true),
                    'total_words' => rand(100, 5000),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
