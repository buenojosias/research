<?php

namespace Database\Factories;

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
            'title' => fake()->sentence(),
            'repositories' => fake()->randomElements([
                    'Scielo', 'Scopus', 'Capes', 'Web of Science'
                ], rand(1, 2))
            ,
            'types' => fake()->randomElements([
                    'Tese', 'Dissertação', 'Artigo'
                ], rand(1, 2))
            ,
            'terms' => json_encode([
                'a' => fake()->word(),
                'b' => fake()->word()
            ]),
            'combinations' => json_encode([ 'A', 'B', 'A+B' ]),
            'start_year' => $start_year,
            'end_year' => rand($start_year+1, 2024),
            'langagues' => json_encode(['Português']),
            'requested_at' => fake()->dateTimeBetween('-30 days', 'now'),
        ];
    }
}
