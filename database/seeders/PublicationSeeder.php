<?php

namespace Database\Seeders;

use App\Models\Keyword;
use App\Models\Research;
use App\Models\Publication;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublicationSeeder extends Seeder
{
    public function run(): void
    {
        $researches = Research::all();

        foreach ($researches as $research) {
            Publication::factory(rand(1, 12))->create([
                'research_id' => $research->id,
            ])
            ->each(function($publication) {
                Keyword::factory(1)->create([
                    'publication_id' => $publication->id
                ]);
            });
        }
    }
}
