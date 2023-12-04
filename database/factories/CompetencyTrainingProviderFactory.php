<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProfileLibCities>
 */
class CompetencyTrainingProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'provider' => fake()->name(),
            'house_bldg'=> fake()->city(),
            'st_road'=> fake()->sentence(),
            'brgy_vill' => fake()->city(),
            'city_code' => fake()->randomDigit(),
            'contactno' => fake()->randomDigit(),
            'emailadd' => fake()->email(),
            'contactperson' => fake()->name(),
        ];
    }
}
