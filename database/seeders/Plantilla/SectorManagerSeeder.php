<?php

namespace Database\Seeders\Plantilla;

use App\Models\Plantilla\SectorManager;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectorManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SectorManager::create([
            'title' => 'Constitutional Offices',
            'description' => '-',
            'encoder' => 'system encode',
        ]);
        SectorManager::create([
            'title' => 'Executive Branch',
            'description' => '-',
            'encoder' => 'system encode',
        ]);
        SectorManager::create([
            'title' => 'Judiciary',
            'description' => '-',
            'encoder' => 'system encode',
        ]);
        SectorManager::create([
            'title' => 'Legislative Branch',
            'description' => '-',
            'encoder' => 'system encode',
        ]);
        SectorManager::create([
            'title' => 'Local Government Sector',
            'description' => '-',
            'encoder' => 'system encode',
        ]);
        SectorManager::create([
            'title' => 'Private Sector',
            'description' => '-',
            'encoder' => 'system encode',
        ]);
        SectorManager::create([
            'title' => 'Private Universities and Colleges',
            'description' => '-',
            'encoder' => 'system encode',
        ]);
        SectorManager::create([
            'title' => 'State Universities and Colleges',
            'description' => '-',
            'encoder' => 'system encode',
        ]);
    }
}
