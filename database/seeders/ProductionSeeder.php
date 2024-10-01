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
        $projects = Project::withoutGlobalScopes()->get();

        foreach ($projects as $project) {
            Production::factory(rand(15, 40))
                ->has(Keyword::factory())
                ->hasAuthors(rand(1, 3))
                ->create([
                    'project_id' => $project->id,
                ])
            ;
        }
    }
}
