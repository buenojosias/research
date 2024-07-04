<?php

namespace Database\Seeders;

use App\Models\Reference;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReferenceSeeder extends Seeder
{
    public function run(): void
    {
        // $references = Reference::factory(20)->create();
        $references = Reference::inRandomOrder()->limit(5)->get();

        foreach ($references as $reference) {
            for ($i=1; $i <= rand(1,2); $i++) {
                $reference->productions()->syncWithPivotValues(rand(101,103), ['suffix' => 'b']);
            }
        }
    }
}
