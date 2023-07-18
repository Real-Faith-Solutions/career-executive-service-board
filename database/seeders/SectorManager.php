<?php

namespace Database\Seeders;

use App\Models\SectorManager as ModelsSectorManager;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SectorManager extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        ModelsSectorManager::create([
            'title' => 'Constitutional Offices',
            'description' => '-',
            'encoder' => 'System Encode',
        ]);
        ModelsSectorManager::create([
            'title' => 'Executive Branch',
            'description' => '-',
            'encoder' => 'System Encode',
        ]);
        ModelsSectorManager::create([
            'title' => 'Judiciary',
            'description' => '-',
            'encoder' => 'System Encode',
        ]);
        ModelsSectorManager::create([
            'title' => 'Legislative Branch',
            'description' => '-',
            'encoder' => 'System Encode',
        ]);
        ModelsSectorManager::create([
            'title' => 'Local Government Sector',
            'description' => '-',
            'encoder' => 'System Encode',
        ]);
        ModelsSectorManager::create([
            'title' => 'Private Sector',
            'description' => '-',
            'encoder' => 'System Encode',
        ]);
        ModelsSectorManager::create([
            'title' => 'Private Universities and Colleges',
            'description' => '-',
            'encoder' => 'System Encode',
        ]);
        ModelsSectorManager::create([
            'title' => 'State Universities and Colleges',
            'description' => '-',
            'encoder' => 'System Encode',
        ]);
    }
}
