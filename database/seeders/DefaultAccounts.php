<?php

namespace Database\Seeders;

use App\Models\PersonalData;
use App\Models\ProfileLibTblAppAuthority;
use App\Models\ProfileLibTblCesStatus;
use App\Models\ProfileLibTblCesStatusAcc;
use App\Models\ProfileLibTblCesStatusType;
use App\Models\ProfileTblCesStatus;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class DefaultAccounts extends Seeder
{

    private ProfileTblCesStatus $profileTblCesStatus;

    public function run(): void
    {
        $faker = Faker::create(); // Create a Faker instance

        // seeding admin 
        $admin = PersonalData::create([
            'emailadd' => 'admin@ces.com',
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
            'password' => Hash::make('C3$board'),
            'is_active'		            => 'Active',
            'last_updated_by'           => 'system encode',
            'encoder'                   => 'system encode',
            'default_password_change'   => 'true',
        ]);

        $user->assignRole('admin');
        // end seeding admin

        // seeding power user 
        $power_user = PersonalData::create([
            'email' => 'power_user@ces.com',
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

        $user = $power_user->users()->Create([
            'email' => $power_user->email,
            'password' => Hash::make('C3$board'),
            'is_active'		            => 'Active',
            'last_updated_by'           => 'system encode',
            'encoder'                   => 'system encode',
            'default_password_change'   => 'true',
        ]);

        $user->assignRole('power_user');
        // end seeding power user

        // seeding rank officer 
        $rank_officer = PersonalData::create([
            'emailadd' => 'rank_officer@ces.com',
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

        $user = $rank_officer->users()->Create([
            'email' => $rank_officer->email,
            'password' => Hash::make('C3$board'),
            'is_active'		            => 'Active',
            'last_updated_by'           => 'system encode',
            'encoder'                   => 'system encode',
            'default_password_change'   => 'true',
        ]);

        $user->assignRole('rank_officer');
        // end seeding rank officer

        // seeding cesb operator 
        $cesb_operator = PersonalData::create([
            'emailadd' => 'cesb_operator@ces.com',
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

        $user = $cesb_operator->users()->Create([
            'email' => $cesb_operator->email,
            'password' => Hash::make('C3$board'),
            'is_active'		            => 'Active',
            'last_updated_by'           => 'system encode',
            'encoder'                   => 'system encode',
            'default_password_change'   => 'true',
        ]);

        $user->assignRole('cesb_operator');
        // end seeding cesb operator

        // seeding training officer 
        $training_officer = PersonalData::create([
            'emailadd' => 'training_officer@ces.com',
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

        $user = $training_officer->users()->Create([
            'email' => $training_officer->email,
            'password' => Hash::make('C3$board'),
            'is_active'		            => 'Active',
            'last_updated_by'           => 'system encode',
            'encoder'                   => 'system encode',
            'default_password_change'   => 'true',
        ]);

        $user->assignRole('training_officer');
        // end seeding training officer

        // seeding cespes operator 
        $cespes_operator = PersonalData::create([
            'emailadd' => 'cespes_operator@ces.com',
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

        $user = $cespes_operator->users()->Create([
            'email' => $cespes_operator->email,
            'password' => Hash::make('C3$board'),
            'is_active'		            => 'Active',
            'last_updated_by'           => 'system encode',
            'encoder'                   => 'system encode',
            'default_password_change'   => 'true',
        ]);

        $user->assignRole('cespes_operator');
        // end seeding cespes operator

        // seeding agency hr operator 
        $agency_hr_operator = PersonalData::create([
            'emailadd' => 'agency_hr_operator@ces.com',
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

        $user = $agency_hr_operator->users()->Create([
            'email' => $agency_hr_operator->email,
            'password' => Hash::make('C3$board'),
            'is_active'		            => 'Active',
            'last_updated_by'           => 'system encode',
            'encoder'                   => 'system encode',
            'default_password_change'   => 'true',
        ]);

        $user->assignRole('agency_hr_operator');
        // end seeding agency hr operator

        // seeding users
        $personalDataRecords = PersonalData::whereNotIn('emailadd', [
            'admin@ces.com',
            'power_user@ces.com',
            'rank_officer@ces.com',
            'cesb_operator@ces.com',
            'training_officer@ces.com',
            'cespes_operator@ces.com',
            'agency_hr_operator@ces.com'
        ])->get();

        foreach ($personalDataRecords as $personalData) {

            $user = $personalData->users()->Create([
                'email' => $personalData->email,
                'password' => Hash::make('C3$board'),
                'is_active'		            => 'Active',
                'last_updated_by'           => 'system encode',
                'encoder'                   => 'system encode',
                'default_password_change'   => 'true',
            ]);

            $profileTblCesStatus = $personalData->profileTblCesStatus()->Create([
                'cesstat_code' => $faker->randomElement(ProfileLibTblCesStatus::pluck('code')->toArray()),
                'acc_code' => $faker->randomElement(ProfileLibTblCesStatusType::pluck('code')->toArray()),
                'type_code' => $faker->randomElement(ProfileLibTblCesStatusAcc::pluck('code')->toArray()),
                'official_code' => $faker->randomElement(ProfileLibTblAppAuthority::pluck('code')->toArray()),
                'resolution_no' => $faker->randomNumber(9),
                'appointed_dt' => Carbon::now()->format('Y-m-d'),
            ]);

            $profileTblCesStatus->latestCesStatusCode($personalData->cesno);
    
            $user->assignRole('user');

        }
        // end seeding users

    }
}
