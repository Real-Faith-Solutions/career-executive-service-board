<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProfileLibTblEducMajor>
 */
class ProfileLibTblEducMajorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'COURSE' => fake()->randomElement(['Course 1', 'Course 2', 
            'Course 3', 'Course 4', 'Course 5', 'Course 6', 'Course 7',
            'Course 8', 'Course 9', 'Course 10']),
        ];
    }
}
