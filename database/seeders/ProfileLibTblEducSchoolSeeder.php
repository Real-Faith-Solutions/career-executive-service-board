<?php

namespace Database\Seeders;

use App\Models\ProfileLibTblEducSchool;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileLibTblEducSchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfileLibTblEducSchool::create([
            'SCHOOL' => 'International Statistical Programme Center, Washington',
        ]);
        ProfileLibTblEducSchool::create([
            'SCHOOL' => 'George Washington University',
        ]);
        ProfileLibTblEducSchool::create([
            'SCHOOL' => 'Wayne State University',
        ]);
        ProfileLibTblEducSchool::create([
            'SCHOOL' => 'Rice University, Houston',
        ]);
        ProfileLibTblEducSchool::create([
            'SCHOOL' => 'Araullo University',
        ]);
        ProfileLibTblEducSchool::create([
            'SCHOOL' => 'Air Link International Aviation School',
        ]);
    }
}
