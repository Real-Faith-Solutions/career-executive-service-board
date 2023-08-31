<?php

namespace Database\Seeders;

use App\Models\ProfileLibTblCesStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileLibTblCesStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfileLibTblCesStatus::create([
            'description' => 'CESO I',
        ]);
        ProfileLibTblCesStatus::create([
            'description' => 'CESO II',
        ]);
        ProfileLibTblCesStatus::create([
            'description' => 'CESO III',
        ]);
        ProfileLibTblCesStatus::create([
            'description' => 'CESO IV',
        ]);
        ProfileLibTblCesStatus::create([
            'description' => 'CESO V',
        ]);
        ProfileLibTblCesStatus::create([
            'description' => 'CESO VI',
        ]);
        ProfileLibTblCesStatus::create([
            'description' => 'Eligible',
        ]);
        ProfileLibTblCesStatus::create([
            'description' => 'CSEE',
        ]);
        ProfileLibTblCesStatus::create([
            'description' => '-',
        ]);
    }
}
