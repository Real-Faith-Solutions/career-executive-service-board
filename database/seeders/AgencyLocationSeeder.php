<?php

namespace Database\Seeders;

use App\Models\Plantilla\AgencyLocationLibrary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgencyLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        AgencyLocationLibrary::create([
            'title' => 'Central/Main Office',
        ]);
        AgencyLocationLibrary::create([
            'title' => 'Regional/Branch Office',
        ]);
    }
}
