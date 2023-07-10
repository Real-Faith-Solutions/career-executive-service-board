<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProfileLibTblEducDegree>
 */
class ProfileLibTblEducDegreeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'degree' => fake()->randomElement(['Degree 1', 'Degree 2', 
            'Degree 3', 'Degree 4', 'Degree 5', 'Degree 6', 'Degree 7',
            'Degree 8', 'Degree 9', 'Degree 10']),
        ];
    }
}
