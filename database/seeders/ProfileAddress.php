<?php

namespace Database\Seeders;

use App\Models\ProfileAddress as ModelsProfileAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class ProfileAddress extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $faker = Faker::create();
        ModelsProfileAddress::create([
            'cesno' => '1',
            'type' => $faker->randomElement(['Permanent address', 'Mailing address', 'Temporary address']),
            'floor_bldg' => $faker->address,
            'no_street' => $faker->address,
            'brgy_or_district' => $faker->state,
            'city_or_municipality' => $faker->city,
            'zip_code' => $faker->postcode,
            'encoder'  => $faker->name,
            'last_updated_by' => $faker->dateTime,
        ]);
        ModelsProfileAddress::create([
            'cesno' => '2',
            'type' => $faker->randomElement(['Permanent address', 'Mailing address', 'Temporary address']),
            'floor_bldg' => $faker->address,
            'no_street' => $faker->address,
            'brgy_or_district' => $faker->state,
            'city_or_municipality' => $faker->city,
            'zip_code' => $faker->postcode,
            'encoder'  => $faker->name,
            'last_updated_by' => $faker->dateTime,
        ]);
        ModelsProfileAddress::create([
            'cesno' => '3',
            'type' => $faker->randomElement(['Permanent address', 'Mailing address', 'Temporary address']),
            'floor_bldg' => $faker->address,
            'no_street' => $faker->address,
            'brgy_or_district' => $faker->state,
            'city_or_municipality' => $faker->city,
            'zip_code' => $faker->postcode,
            'encoder'  => $faker->name,
            'last_updated_by' => $faker->dateTime,
        ]);
        ModelsProfileAddress::create([
            'cesno' => '4',
            'type' => $faker->randomElement(['Permanent address', 'Mailing address', 'Temporary address']),
            'floor_bldg' => $faker->address,
            'no_street' => $faker->address,
            'brgy_or_district' => $faker->state,
            'city_or_municipality' => $faker->city,
            'zip_code' => $faker->postcode,
            'encoder'  => $faker->name,
            'last_updated_by' => $faker->dateTime,
        ]);
    }
}
