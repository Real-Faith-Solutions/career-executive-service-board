<?php

namespace Database\Seeders;

use App\Models\ProfileLibTblLanguageRef;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileLibTblLanguageRefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfileLibTblLanguageRef::create([
            'title' => 'Bicol',
        ]);
        ProfileLibTblLanguageRef::create([
            'title' => 'Basque',
        ]);
        ProfileLibTblLanguageRef::create([
            'title' => 'Brahui',
        ]);
        ProfileLibTblLanguageRef::create([
            'title' => 'Breton',
        ]);
        ProfileLibTblLanguageRef::create([
            'title' => 'British English',
        ]);
        ProfileLibTblLanguageRef::create([
            'title' => 'Burman-Garo',
        ]);
    }
}
