<?php

namespace Database\Seeders;

use App\Models\PersonalData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DefaultAccounts extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create(); // Create a Faker instance

        PersonalData::create([
            'email' => $faker->unique()->safeEmail,
            'status' => $faker->randomElement(['Active', 'Inactive', 'Retired', 'Deceased']),
            'title' => $faker->randomElement(['Dr.', 'Mr.', 'Ms.', 'Atty.']),
            'lastname' => $faker->lastName,
            'firstname' => $faker->firstName,
            'name_extension' => $faker->randomElement(['Sr.', 'Jr.', 'III']),
            'middlename' => $faker->lastName,
            'middleinitial' => 'r',
            'nickname' => $faker->name,
            'birth_date' => $faker->date,
            'birth_place' => $faker->numberBetween(1, 5),
            'gender' => $faker->randomElement(['Male', 'Female', 'Prefer Not to Say']),
            'gender_by_choice' => $faker->randomElement(['Male', 'Female', 'Prefer Not to Say']),
            'civil_status' => $faker->randomElement(['Single', 'Married', 'Divorce']),
            'religion' => $faker->numberBetween(1, 5),
            'height' => $faker->randomNumber(3),
            'weight' => $faker->randomNumber(2),
            'member_of_indigenous_group' => $faker->randomElement(['No', 'Yes']),
            'single_parent' => $faker->randomElement(['No', 'Yes']),
            'citizenship' => $faker->randomElement(['Filipino', 'Dual-Citizenship']),
            'dual_citizenship' => $faker->country(),
            'person_with_disability' => $faker->randomElement(['No', 'Yes']),
        ]);
    }
}
