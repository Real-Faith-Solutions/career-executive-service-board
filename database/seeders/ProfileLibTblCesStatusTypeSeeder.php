<?php

namespace Database\Seeders;

use App\Models\ProfileLibTblCesStatusType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileLibTblCesStatusTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfileLibTblCesStatusType::create([
            'description' => '-',
        ]);
        ProfileLibTblCesStatusType::create([
            'description' => 'Conferment',
        ]);
        ProfileLibTblCesStatusType::create([
            'description' => 'Original',
        ]);
        ProfileLibTblCesStatusType::create([
            'description' => 'Adjustment',
        ]);
        ProfileLibTblCesStatusType::create([
            'description' => 'Promotion',
        ]);
        ProfileLibTblCesStatusType::create([
            'description' => 'Restoration',
        ]);
    }
}
