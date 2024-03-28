<?php

namespace Database\Seeders;

use App\Models\Research;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResearchSeeder extends Seeder
{
    public function run(): void
    {
        $students = Student::query()->select(['id', 'user_id'])->get();

        $students->each(function (Student $student) {
            Research::factory(rand(1, 2))->create([
                'user_id' => $student->user_id,
                'student_id' => $student->id
            ]);
            Research::factory(rand(1, 2))->create([
                'user_id' => $student->user_id,
            ]);
        });
    }
}
