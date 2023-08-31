<?php

namespace Database\Seeders;

use App\Models\ProfileLibTblEducMajor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileLibTblEducMajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfileLibTblEducMajor::create([
            'COURSE' => 'Botany & Biology',
        ]);
        ProfileLibTblEducMajor::create([
            'COURSE' => 'Marine Ecology',
        ]);
        ProfileLibTblEducMajor::create([
            'COURSE' => 'Environmental Science & Technology',
        ]);
        ProfileLibTblEducMajor::create([
            'COURSE' => 'Business Administration',
        ]);
        ProfileLibTblEducMajor::create([
            'COURSE' => 'Geodetic Science',
        ]);
        ProfileLibTblEducMajor::create([
            'COURSE' => 'Photogeology',
        ]);
    }
}
