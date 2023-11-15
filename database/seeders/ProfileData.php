<?php

namespace Database\Seeders;

use App\Models\PersonalData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class ProfileData extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $faker = Faker::create();
        PersonalData::create([
            'status' => $faker->randomElement(['Active', 'Inactive','Retired', 'Deceased']),
            'title' => $faker->randomElement(['Dr.', 'Mr.', 'Ms.', 'Atty.']),
            'lastname' => $faker->lastName,
            'firstname' => $faker->firstName,
            'name_extension' => $faker->randomElement(['Sr.', 'Jr.', 'III']),
            'middlename' => $faker->lastName,
            'middleinitial' => 'r',
            'nickname' => $faker->name,
            'birthdate'=> $faker->date,
            'age' => $faker->randomNumber(2),
            'birth_place' => $faker->address,
            'gender' => $faker->randomElement(['Male', 'Female', 'Prefer Not to Say']),
            'gender_by_choice' => $faker->randomElement(['Male', 'Female', 'Prefer Not to Say']),
            'civil_status' => $faker->randomElement(['Single', 'Married', 'Divorce']),
            'religion' => $faker->randomElement(['Catholic', 'Muslim', 'Buddhism']),
            'height' => $faker->randomNumber(3),
            'weight' => $faker->randomNumber(2),
            'member_of_indigenous_group' => $faker->randomElement(['No', 'Yes']),
            'single_parent' => $faker->randomElement(['No', 'Yes']),
            'citizenship' => $faker->randomElement(['Filipino', 'Dual-Citizenship']),
            'dual_citizenship' => $faker->randomElement(['Japanese', 'Canadian']),
            'person_with_disability' => $faker->randomElement(['No', 'Yes']),
            'gsis' => $faker->randomNumber(9),
            'pagibig' => $faker->randomNumber(9),
            'philhealth' => $faker->randomNumber(9),
            'sss_no' => $faker->randomNumber(9),
            'tin' => $faker->randomNumber(9),
            'picture' => 'assets/placeholder.png',
        ]);
        PersonalData::create([
            'status' => $faker->randomElement(['Active', 'Inactive', 'Retired', 'Deceased']),
            'title' => $faker->randomElement(['Dr.', 'Mr.', 'Ms.', 'Atty.']),
            'lastname' => $faker->lastName,
            'firstname' => $faker->firstName,
            'name_extension' => $faker->randomElement(['Sr.', 'Jr.', 'III']),
            'middlename' => $faker->lastName,
            'middleinitial' => 'r',
            'nickname' => $faker->name,
            'birthdate' => $faker->date,
            'age' => $faker->randomNumber(2),
            'birth_place' => $faker->address,
            'gender' => $faker->randomElement(['Male', 'Female', 'Prefer Not to Say']),
            'gender_by_choice' => $faker->randomElement(['Male', 'Female', 'Prefer Not to Say']),
            'civil_status' => $faker->randomElement(['Single', 'Married', 'Divorce']),
            'religion' => $faker->randomElement(['Catholic', 'Muslim', 'Buddhism']),
            'height' => $faker->randomNumber(3),
            'weight' => $faker->randomNumber(2),
            'member_of_indigenous_group' => $faker->randomElement(['No', 'Yes']),
            'single_parent' => $faker->randomElement(['No', 'Yes']),
            'citizenship' => $faker->randomElement(['Filipino', 'Dual-Citizenship']),
            'dual_citizenship' => $faker->randomElement(['Japanese', 'Canadian']),
            'person_with_disability' => $faker->randomElement(['No', 'Yes']),
            'gsis' => $faker->randomNumber(9),
            'pagibig' => $faker->randomNumber(9),
            'philhealth' => $faker->randomNumber(9),
            'sss_no' => $faker->randomNumber(9),
            'tin' => $faker->randomNumber(9),
            'picture' => 'assets/placeholder.png',
        ]);

        PersonalData::create([
            'status' => $faker->randomElement(['Active', 'Inactive', 'Retired', 'Deceased']),
            'title' => $faker->randomElement(['Dr.', 'Mr.', 'Ms.', 'Atty.']),
            'lastname' => $faker->lastName,
            'firstname' => $faker->firstName,
            'name_extension' => $faker->randomElement(['Sr.', 'Jr.', 'III']),
            'middlename' => $faker->lastName,
            'middleinitial' => 'r',
            'nickname' => $faker->name,
            'birthdate' => $faker->date,
            'age' => $faker->randomNumber(2),
            'birth_place' => $faker->address,
            'gender' => $faker->randomElement(['Male', 'Female', 'Prefer Not to Say']),
            'gender_by_choice' => $faker->randomElement(['Male', 'Female', 'Prefer Not to Say']),
            'civil_status' => $faker->randomElement(['Single', 'Married', 'Divorce']),
            'religion' => $faker->randomElement(['Catholic', 'Muslim', 'Buddhism']),
            'height' => $faker->randomNumber(3),
            'weight' => $faker->randomNumber(2),
            'member_of_indigenous_group' => $faker->randomElement(['No', 'Yes']),
            'single_parent' => $faker->randomElement(['No', 'Yes']),
            'citizenship' => $faker->randomElement(['Filipino', 'Dual-Citizenship']),
            'dual_citizenship' => $faker->randomElement(['Japanese', 'Canadian']),
            'person_with_disability' => $faker->randomElement(['No', 'Yes']),
            'gsis' => $faker->randomNumber(9),
            'pagibig' => $faker->randomNumber(9),
            'philhealth' => $faker->randomNumber(9),
            'sss_no' => $faker->randomNumber(9),
            'tin' => $faker->randomNumber(9),
            'picture' => 'assets/placeholder.png',
        ]);

        PersonalData::create([
            'status' => $faker->randomElement(['Active', 'Inactive', 'Retired', 'Deceased']),
            'title' => $faker->randomElement(['Dr.', 'Mr.', 'Ms.', 'Atty.']),
            'lastname' => $faker->lastName,
            'firstname' => $faker->firstName,
            'name_extension' => $faker->randomElement(['Sr.', 'Jr.', 'III']),
            'middlename' => $faker->lastName,
            'middleinitial' => 'r',
            'nickname' => $faker->name,
            'birthdate' => $faker->date,
            'age' => $faker->randomNumber(2),
            'birth_place' => $faker->address,
            'gender' => $faker->randomElement(['Male', 'Female', 'Prefer Not to Say']),
            'gender_by_choice' => $faker->randomElement(['Male', 'Female', 'Prefer Not to Say']),
            'civil_status' => $faker->randomElement(['Single', 'Married', 'Divorce']),
            'religion' => $faker->randomElement(['Catholic', 'Muslim', 'Buddhism']),
            'height' => $faker->randomNumber(3),
            'weight' => $faker->randomNumber(2),
            'member_of_indigenous_group' => $faker->randomElement(['No', 'Yes']),
            'single_parent' => $faker->randomElement(['No', 'Yes']),
            'citizenship' => $faker->randomElement(['Filipino', 'Dual-Citizenship']),
            'dual_citizenship' => $faker->randomElement(['Japanese', 'Canadian']),
            'person_with_disability' => $faker->randomElement(['No', 'Yes']),
            'gsis' => $faker->randomNumber(9),
            'pagibig' => $faker->randomNumber(9),
            'philhealth' => $faker->randomNumber(9),
            'sss_no' => $faker->randomNumber(9),
            'tin' => $faker->randomNumber(9),
            'picture' => 'assets/placeholder.png',
        ]);

        PersonalData::create([
            'status' => $faker->randomElement(['Active', 'Inactive', 'Retired', 'Deceased']),
            'title' => $faker->randomElement(['Dr.', 'Mr.', 'Ms.', 'Atty.']),
            'lastname' => $faker->lastName,
            'firstname' => $faker->firstName,
            'name_extension' => $faker->randomElement(['Sr.', 'Jr.', 'III']),
            'middlename' => $faker->lastName,
            'middleinitial' => 'r',
            'nickname' => $faker->name,
            'birthdate' => $faker->date,
            'age' => $faker->randomNumber(2),
            'birth_place' => $faker->address,
            'gender' => $faker->randomElement(['Male', 'Female', 'Prefer Not to Say']),
            'gender_by_choice' => $faker->randomElement(['Male', 'Female', 'Prefer Not to Say']),
            'civil_status' => $faker->randomElement(['Single', 'Married', 'Divorce']),
            'religion' => $faker->randomElement(['Catholic', 'Muslim', 'Buddhism']),
            'height' => $faker->randomNumber(3),
            'weight' => $faker->randomNumber(2),
            'member_of_indigenous_group' => $faker->randomElement(['No', 'Yes']),
            'single_parent' => $faker->randomElement(['No', 'Yes']),
            'citizenship' => $faker->randomElement(['Filipino', 'Dual-Citizenship']),
            'dual_citizenship' => $faker->randomElement(['Japanese', 'Canadian']),
            'person_with_disability' => $faker->randomElement(['No', 'Yes']),
            'gsis' => $faker->randomNumber(9),
            'pagibig' => $faker->randomNumber(9),
            'philhealth' => $faker->randomNumber(9),
            'sss_no' => $faker->randomNumber(9),
            'tin' => $faker->randomNumber(9),
            'picture' => 'assets/placeholder.png',
        ]);
    }
}