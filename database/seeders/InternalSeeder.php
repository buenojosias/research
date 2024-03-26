<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InternalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 4) as $index) {
            $section = $faker->randomElement(['abstract','body']);
            // dd($faker->paragraphs(10, true));

            \DB::table('internals')->insert([
                'publication_id' => rand(1, 80),
                'section' => $section,
                'content' => $section === 'abstract' ? $faker->paragraph() : $faker->paragraphs(rand(5, 50), true),
                'words_count' => rand(100, 500),
            ]);
        }

    }
}
