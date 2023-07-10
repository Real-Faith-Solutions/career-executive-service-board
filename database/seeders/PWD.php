<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PWD as ModelsPWD;

class PWD extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsPWD::create([
            'name' => 'Visual Impairment',
        ]);
        ModelsPWD::create([
            'name' => 'Hearing Loss',
        ]);
        ModelsPWD::create([
            'name' => 'Mobility Impairment',
        ]);
        ModelsPWD::create([
            'name' => 'Intellectual Disability',
        ]);
        ModelsPWD::create([
            'name' => 'Mental Health Condition',
        ]);
    }
}
