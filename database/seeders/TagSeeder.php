<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::withoutGlobalScopes()->with('productions')->get();

        $projects->each(function (Project $project) {
            $productions = $project->productions->pluck('id');

            $tags = Tag::factory()->count(rand(4, 8))->create([
                'project_id' => $project->id,
            ]);

            $tags->each(function ($tag) use ($productions) {
                $production_ids = $productions->shuffle()->take(rand(2, 4));
                $tag->productions()->attach($production_ids);
            });
        });
    }
}
