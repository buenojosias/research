<?php

namespace Database\Factories;

use App\Enums\PublicationTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Research>
 */
class ResearchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start_year = rand(2015, 2021);

        return [
            'pid' => fake()->randomNumber(9),
            'title' => rtrim(fake()->sentence(), '.'),
            'repositories' => fake()
                ->randomElements(
                    [
                        'Scielo',
                        'Scopus',
                        'Capes',
                        'Web of Science'
                    ],
                    rand(1, 2)
                ),
            'types' => fake()
                ->randomElements(
                    PublicationTypeEnum::class,
                    rand(1, 2)
                )
            ,
            'terms' => [
                'a' => fake()->word(),
                'b' => fake()->word()
            ],
            'combinations' => ["A", "B", "A+B"],
            'start_year' => $start_year,
            'end_year' => rand($start_year + 1, 2024),
            'languages' => fake()
                ->randomElements(
                    [
                        'Português',
                        'Inglês',
                        'Espanhol'
                    ],
                    rand(1, 2)
                ),
            'requested_at' => fake()->dateTimeBetween('-30 days', 'now'),
        ];
    }
}
