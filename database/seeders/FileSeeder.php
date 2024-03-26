<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\Publication;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $publications = Publication::select(['id','author_lastname'])->inRandomOrder('id')->limit(20)->get();

        foreach($publications as $publication) {
            File::factory(1)->create([
                'publication_id' => $publication->id,
                'filename' => $publication->author_lastname . ' - ' . $faker->sentence() . 'pdf',
                'path' => $faker->url(),
                'size' => $faker->randomFloat(2, 1, 50)
            ]);
        };
    }
}
