<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GenderByBirth as ModelsGenderByBirth;

class GenderByBirth extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsGenderByBirth::create([
            'name' => 'Male'
        ]);
        ModelsGenderByBirth::create([
            'name' => 'Female'
        ]);
    }
}
