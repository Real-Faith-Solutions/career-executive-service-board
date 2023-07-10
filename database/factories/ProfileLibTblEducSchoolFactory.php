<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProfileLibTblEducSchool>
 */
class ProfileLibTblEducSchoolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'SCHOOL' => fake()->randomElement(['School 1', 'School 2', 
            'School 3', 'School 4', 'School 5', 'School 6', 'School 7',
            'School 8', 'School 9', 'School 10']),
        ];
    }
}
