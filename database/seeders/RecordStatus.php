<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RecordStatus as ModelsRecordStatus;

class RecordStatus extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsRecordStatus::create([
            'name' => 'Active',
        ]);
        ModelsRecordStatus::create([
            'name' => 'Inactive',
        ]);
        ModelsRecordStatus::create([
            'name' => 'Retired',
        ]);
        ModelsRecordStatus::create([
            'name' => 'Deceased',
        ]);
    }
}
