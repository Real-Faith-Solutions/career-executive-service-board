<?php

namespace Database\Seeders;

use App\Models\ProfileLibTblExpertiseSpec;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileLibTblExpertiseSpecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfileLibTblExpertiseSpec::create([
            'Title' => 'Administration and Management',
        ]);
        ProfileLibTblExpertiseSpec::create([
            'Title' => 'Administrative Functions and Investigations',
        ]);
        ProfileLibTblExpertiseSpec::create([
            'Title' => 'Administrative Investigation/Prosecution',
        ]);
        ProfileLibTblExpertiseSpec::create([
            'Title' => 'Administrative Law and Corporate Law Practice',
        ]);
        ProfileLibTblExpertiseSpec::create([
            'Title' => 'Adult Education',
        ]);
        ProfileLibTblExpertiseSpec::create([
            'Title' => 'Agrarian Reform',
        ]);
    }
}
