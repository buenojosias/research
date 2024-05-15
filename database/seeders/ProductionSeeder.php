<?php

namespace Database\Seeders;

use App\Models\Keyword;
use App\Models\Production;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::all();

        foreach ($projects as $project) {
            Production::factory(rand(3, 6))
                ->has(Keyword::factory())
                ->create([
                    'project_id' => $project->id,
                ])
            ;
        }
    }
}
