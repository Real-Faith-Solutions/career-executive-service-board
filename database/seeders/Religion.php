<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Religion as ModelsReligion;
class Religion extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsReligion::create([
            'name' => 'Roman Catholic',
        ]);
        ModelsReligion::create([
            'name' => 'Islam',
        ]);
        ModelsReligion::create([
            'name' => 'Hinduism',
        ]);
        ModelsReligion::create([
            'name' => 'Buddhism',
        ]);
        ModelsReligion::create([
            'name' => 'Judaism',
        ]);
    }
}
