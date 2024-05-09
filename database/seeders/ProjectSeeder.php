<?php

namespace Database\Seeders;

use App\Models\Bibliometric;
use App\Models\Project;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $students = Student::query()->select(['id', 'user_id'])->get();

        $students->each(function (Student $student) {
            Project::factory(rand(0, 1))
                ->create([
                    'user_id' => $student->user_id,
                    'student_id' => $student->id
                ]);
            Project::factory(rand(1, 1))
                ->create([
                    'user_id' => $student->user_id,
                ]);
        });
    }
}
