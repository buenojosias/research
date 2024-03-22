<?php

namespace Database\Factories;

use App\Enums\DegreeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => rand(2, 5),
            'name' => fake()->name(),
            'email' => fake()->email(),
            'whatsapp' => fake()->phoneNumber(),
            'institution' => fake()->randomElement([
                null,
                fake()->company()
            ]),
            'program' => fake()->randomElement([
                null,
                'Programa de Pós-Graduação em ' . fake()->sentence()
            ]),
            'degree' => fake()->randomElement([
                null,
                fake()->randomElement(DegreeEnum::cases())->value
            ]),
            'advisor' => fake()->name(),
        ];
    }
}
