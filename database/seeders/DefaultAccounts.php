<?php

namespace Database\Seeders;

use App\Models\PersonalData;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class DefaultAccounts extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create(); // Create a Faker instance

        // seeding admin 
        $admin = PersonalData::create([
            'email' => 'admin@ces.com',
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

        $user = $admin->users()->Create([
            'email' => $admin->email,
            'password' => Hash::make('12345'),
            'is_active'		            => 'Active',
            'last_updated_by'           => 'system encode',
            'encoder'                   => 'system encode',
            'default_password_change'   => 'true',
        ]);

        $user->assignRole('admin');
        // end seeding admin

        // seeding users
        $personalDataRecords = PersonalData::where('email', '!=', 'admin@ces.com')->get();

        foreach ($personalDataRecords as $personalData) {

            $user = $personalData->users()->Create([
                'email' => $personalData->email,
                'password' => Hash::make('12345'),
                'is_active'		            => 'Active',
                'last_updated_by'           => 'system encode',
                'encoder'                   => 'system encode',
                'default_password_change'   => 'true',
            ]);
    
            $user->assignRole('user');

        }
        // end seeding users

    }
}
