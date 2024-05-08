<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'theme' => rtrim(fake()->sentence(), '.'),
            'requested_at' => fake()->dateTimeBetween('-30 days', 'now'),
        ];
    }
}
