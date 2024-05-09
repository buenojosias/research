<?php

namespace Database\Seeders;

use App\Models\Bibliometric;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BibliometricSeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::all();

        $projects->each(function (Project $project) {
            Bibliometric::factory()->create([
                'project_id' => $project->id,
                'user_id' => $project->user_id
            ]);
        });
    }
}
