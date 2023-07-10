<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GenderByChoice as ModelsGenderByChoice;
class GenderByChoice extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsGenderByChoice::create([
            'name' => 'Male',
        ]);
        ModelsGenderByChoice::create([
            'name' => 'Female',
        ]);
        ModelsGenderByChoice::create([
            'name' => 'Transgender',
        ]);
        ModelsGenderByChoice::create([
            'name' => 'Gender neutral',
        ]);
        ModelsGenderByChoice::create([
            'name' => 'Non-binary',
        ]);
        ModelsGenderByChoice::create([
            'name' => 'Agender',
        ]);
        ModelsGenderByChoice::create([
            'name' => 'Pangender',
        ]);
        ModelsGenderByChoice::create([
            'name' => 'Genderqueer',
        ]);
        ModelsGenderByChoice::create([
            'name' => 'Two-spirit',
        ]);
        ModelsGenderByChoice::create([
            'name' => 'Third gender',
        ]);
    }
}
