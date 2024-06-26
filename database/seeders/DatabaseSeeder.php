<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            StateSeeder::class,
            StudentSeeder::class,
            ProjectSeeder::class,
            // BibliometricSeeder::class,
            ProductionSeeder::class,
            InternalSeeder::class,
        ]);
    }
}
