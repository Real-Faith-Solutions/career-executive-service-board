<?php

namespace Database\Factories\Plantilla;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plantilla\PositionLevelLibrary>
 */
class PositionLevelLibraryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'seq' => $this->faker->unique()->numberBetween(1, 65),
            'title' => $this->faker->jobTitle,
            'acronym' => "etc",
            'sg' => $this->faker->numberBetween(10, 30),
            'pl_func_name' => $this->faker->name,

        ];
    }
}
