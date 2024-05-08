<?php

namespace Database\Factories;

use App\Enums\ProductionTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductionFactory extends Factory
{
    public function definition(): array
    {
        $city = fake()->randomElement([
            null,
            fake()->city(),
        ]);

        if ($city) {
            $state_id = rand(1, 27);
        }

        $authors = [];

        for ($i = 1; $i <= rand(1, 3); $i++) {
            array_push($authors, [
                'forename' => fake()->firstName() . ' ' . fake()->lastName(),
                'lastname' => fake()->lastName(),
            ]);
        }

        return [
            'searched_terms' => fake()->words(rand(1, 3)),
            'repository' => fake()
                ->randomElement([
                    'Scielo',
                    'Scopus',
                    'Capes',
                    'Web of Science'
                ]),
            'type' => fake()
                ->randomElement(ProductionTypeEnum::cases())->value,
            'language' => fake()
                ->randomElement([
                    'Português',
                    'Inglês',
                    'Português',
                    'Espanhol',
                    'Português'
                ]),
            'title' => rtrim(fake()->sentence(), "."),
            'subtitle' => fake()
                ->randomElement([
                    null,
                    lcfirst(rtrim(fake()->sentence(), ".")),
                ]),
            'year' => rand(2010, 2024),
            'authors' => $authors,
            'institution' => fake()
                ->randomElement([
                    null,
                    fake()->sentence(),
                ]),
            'program' => fake()
                ->randomElement([
                    null,
                    fake()->sentence(),
                ]),
            'periodical' => fake()
                ->randomElement([
                    null,
                    fake()->company(),
                ]),
            'city' => fake()
                ->randomElement([
                    null,
                    fake()->city(),
                ]),
            'state_id' => $state_id ?? null,
            'url' => fake()->url(),
            'doi' => fake()
                ->randomElement([
                    null,
                    fake()->uuid(),
                ]),
        ];
    }
}
