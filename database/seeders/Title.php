<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Title as ModelsTitle;
class Title extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsTitle::create([
            'name' => 'Mr.',
        ]);
        ModelsTitle::create([
            'name' => 'Mrs.',
        ]);
        ModelsTitle::create([
            'name' => 'Dr.',
        ]);
        ModelsTitle::create([
            'name' => 'Atty.',
        ]);
    }
}
