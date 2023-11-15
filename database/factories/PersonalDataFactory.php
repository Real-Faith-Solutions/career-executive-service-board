<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonalData>
 */
class PersonalDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            // 'picture' => 'assets/placeholder.png',
            'email' => $this->faker->unique()->safeEmail(),
            'status' => $this->faker->randomElement(['Active', 'Inactive', 'Retired', 'Deceased']),
            'title' => $this->faker->randomElement(['Dr.', 'Mr.', 'Ms.', 'Atty.']),
            'lastname' => $this->faker->lastName,
            'firstname' => $this->faker->firstName,
            'name_extension' => $this->faker->randomElement(['Sr.', 'Jr.', 'III']),
            'middlename' => $this->faker->lastName,
            'middleinitial' => 'r',
            'nickname' => $this->faker->name,
            'birth_date' => $this->faker->date,
            // 'age' => $this->faker->randomNumber(2),
            'birth_place' => $this->faker->numberBetween(1, 5),
            'gender' => $this->faker->randomElement(['Male', 'Female', 'Prefer Not to Say']),
            'gender_by_choice' => $this->faker->randomElement(['Male', 'Female', 'Prefer Not to Say']),
            'civil_status' => $this->faker->randomElement(['Single', 'Married', 'Divorce']),
            'religion' => $this->faker->numberBetween(1, 5),
            'height' => $this->faker->randomNumber(3),
            'weight' => $this->faker->randomNumber(2),
            'member_of_indigenous_group' => $this->faker->randomElement(['No', 'Yes']),
            'single_parent' => $this->faker->randomElement(['No', 'Yes']),
            'citizenship' => $this->faker->randomElement(['Filipino', 'Dual-Citizenship']),
            'dual_citizenship' => $this->faker->country(),
            'person_with_disability' => $this->faker->randomElement(['No', 'Yes']),

        ];
    }
}
