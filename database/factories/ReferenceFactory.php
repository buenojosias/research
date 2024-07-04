<?php

namespace Database\Factories;

use App\Enums\ReferenceTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReferenceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'project_id' => 2,
            'type' => fake()->randomElement(ReferenceTypeEnum::cases())->value,
            'short_author' => fake()->lastName(),
            'long_author' => fake()->name(),
            'year' => fake()->year('-10 years'),
            'title' => rtrim(fake()->sentence(), "."),
            'full' => fake()->paragraph()
        ];
    }
}
