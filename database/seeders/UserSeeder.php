<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'admin' => true
        ]);

        User::factory()->create([
            'name' => 'Josias Bueno',
            'email' => 'josias@email.com',
        ]);

        User::factory(3)->create();
    }
}
