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
            'Title' => 'Agrarian Reform',
        ]);

        ProfileLibTblExpertiseGen::create([
            'Title' => 'Agriculture',
        ]);

        ProfileLibTblExpertiseGen::create([
            'Title' => 'Arts/Humanities',
        ]);

        ProfileLibTblExpertiseGen::create([
            'Title' => 'Business Management',
        ]);

        ProfileLibTblExpertiseGen::create([
            'Title' => 'Communication Arts',
        ]);

        ProfileLibTblExpertiseGen::create([
            'Title' => 'Culture',
        ]);

        ProfileLibTblExpertiseGen::create([
            'Title' => 'Economics',
        ]);

        ProfileLibTblExpertiseGen::create([
            'Title' => 'Education',
        ]);

        ProfileLibTblExpertiseGen::create([
            'Title' => 'Election',
        ]);

        ProfileLibTblExpertiseGen::create([
            'Title' => 'Energy Development and Management',
        ]);

        ProfileLibTblExpertiseGen::create([
            'Title' => 'Finance',
        ]);

        ProfileLibTblExpertiseGen::create([
            'Title' => 'Foreign Affairs',
        ]);

        ProfileLibTblExpertiseGen::create([
            'Title' => 'Health and Medical Science',
        ]);

        ProfileLibTblExpertiseGen::create([
            'Title' => 'Human Resource Management',
        ]);

        ProfileLibTblExpertiseGen::create([
            'Title' => 'Information Technology/MIS',
        ]);
    }
}
