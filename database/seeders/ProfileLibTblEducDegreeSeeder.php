<?php

namespace Database\Seeders;

use App\Models\ProfileLibTblEducDegree;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileLibTblEducDegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfileLibTblEducDegree::create([
            'DEGREE' => 'Doctor of Laws',
        ]);
        ProfileLibTblEducDegree::create([
            'DEGREE' => 'Master of Arts',
        ]);
        ProfileLibTblEducDegree::create([
            'DEGREE' => 'Doctor of Medicine',
        ]);
        ProfileLibTblEducDegree::create([
            'DEGREE' => 'Doctor of Veterinary Medicine',
        ]);
        ProfileLibTblEducDegree::create([
            'DEGREE' => 'Diploma',
        ]);
        ProfileLibTblEducDegree::create([
            'DEGREE' => 'Master of Laws',
        ]);
    }
}
