<?php

namespace Database\Seeders;

use App\Models\Plantilla\SectorManager as ModelsSectorManager;
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
            'encoder' => 'system encode',
        ]);
        ModelsSectorManager::create([
            'title' => 'Executive Branch',
            'description' => '-',
            'encoder' => 'system encode',
        ]);
        ModelsSectorManager::create([
            'title' => 'Judiciary',
            'description' => '-',
            'encoder' => 'system encode',
        ]);
        ModelsSectorManager::create([
            'title' => 'Legislative Branch',
            'description' => '-',
            'encoder' => 'system encode',
        ]);
        ModelsSectorManager::create([
            'title' => 'Local Government Sector',
            'description' => '-',
            'encoder' => 'system encode',
        ]);
        ModelsSectorManager::create([
            'title' => 'Private Sector',
            'description' => '-',
            'encoder' => 'system encode',
        ]);
        ModelsSectorManager::create([
            'title' => 'Private Universities and Colleges',
            'description' => '-',
            'encoder' => 'system encode',
        ]);
        ModelsSectorManager::create([
            'title' => 'State Universities and Colleges',
            'description' => '-',
            'encoder' => 'system encode',
        ]);
    }
}
