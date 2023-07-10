<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CivilStatus as ModelsCivilStatus;
class CivilStatus extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsCivilStatus::create([
            'name' => 'Single',
        ]);
        ModelsCivilStatus::create([
            'name' => 'Married',
        ]);
        ModelsCivilStatus::create([
            'name' => 'Divorce',
        ]);
        ModelsCivilStatus::create([
            'name' => 'Widowed',
        ]);
        ModelsCivilStatus::create([
            'name' => 'Seperated',
        ]);
    }
}
