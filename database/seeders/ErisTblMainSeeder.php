<?php

namespace Database\Seeders;

use App\Models\Eris\EradTblMain;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ErisTblMainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Use a loop to create and insert records
        for ($i = 1; $i <= 10 ; $i++) {
            EradTblMain::create([
                'acbatchno' => $faker->randomDigit(),
                'lastname' => $faker->firstName(),
                'firstname' => $faker->firstName(),
                'middlename' => $faker->firstName(),
                'position' => $faker->word(10),
                'position_remarks' => $faker->word(10),
                'department' => $faker->word(10),
                'office' => $faker->word(10),
                'c_status' => $faker->word(10),
                'c_date' => $faker->date(),
                'c_resno' => $faker->randomDigit(),
                'we_date' => $faker->date(),
                'wlocation' => $faker->word(10),
                'werating' => $faker->word(10),
                'we_remarks' => $faker->word(10),
                'encoder' => $faker->word(10),
                'e_date' => $faker->date(),
                'picture' => $faker->word(10),
                'contactno' => $faker->randomDigit(12),
                'faxno' => $faker->randomDigit(12),
                'mobileno' => $faker->randomDigit(12),
                'gender' => $faker->word(6),
                'birthdate' => $faker->date(),
                'emailadd' => $faker->unique()->safeEmail(),
                'cesno' => $faker->randomDigit(),
                'maddress' => $faker->unique()->safeEmail(),
            ]);
        }
    }
}
