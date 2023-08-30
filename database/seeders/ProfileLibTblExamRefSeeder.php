<?php

namespace Database\Seeders;

use App\Models\ProfileLibTblExamRef;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileLibTblExamRefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfileLibTblExamRef::create([
            'TITLE' => 'CPA Examination',
        ]);
        ProfileLibTblExamRef::create([
            'TITLE' => 'Bar Examination',
        ]);
        ProfileLibTblExamRef::create([
            'TITLE' => 'Veterinary Examination',
        ]);
        ProfileLibTblExamRef::create([
            'TITLE' => 'Physicians Examination',
        ]);
        ProfileLibTblExamRef::create([
            'TITLE' => 'Forestry Licensure Examination',
        ]);
        ProfileLibTblExamRef::create([
            'TITLE' => 'Civil Engineer Examination',
        ]);
    }
}
