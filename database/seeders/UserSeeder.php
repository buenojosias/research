<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
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

        User::factory(1)->create();
    }
}
