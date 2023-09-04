<?php

namespace Database\Seeders;

use App\Models\ProfileLibTblExpertiseGen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileLibTblExpertiseGenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfileLibTblExpertiseGen::create([
            'Title' => 'Sample Specialization',
        ]);
    }
}
