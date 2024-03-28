<?php

namespace Database\Seeders;

use App\Models\Publication;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InternalSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $publications = Publication::all();

        foreach ($publications as $publication) {
            $seed_abstract = $faker->boolean();
            $seed_body = $faker->boolean();

            if($seed_abstract) {
                \DB::table('internals')->insert([
                    'publication_id' => $publication->id,
                    'section' => 'abstract',
                    'content' => $faker->paragraph(),
                    'total_words' => rand(30, 100),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            if($seed_body) {
                \DB::table('internals')->insert([
                    'publication_id' => $publication->id,
                    'section' => 'body',
                    'content' => $faker->paragraphs(rand(5, 50), true),
                    'total_words' => rand(100, 5000),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
