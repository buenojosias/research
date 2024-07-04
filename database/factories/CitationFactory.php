<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CitationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'content' => fake()->text(),
            'type' => fake()->randomElement(['Direta', 'Indireta'])
        ];
    }
}
