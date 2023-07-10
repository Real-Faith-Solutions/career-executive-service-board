<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NameExtension as ModelsNameExtension;

class NameExtension extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsNameExtension::create([
            'name' => 'Jr'
        ]);
        ModelsNameExtension::create([
            'name' => 'Sr'
        ]);
        ModelsNameExtension::create([
            'name' => 'I'
        ]);
        ModelsNameExtension::create([
            'name' => 'II'
        ]);
        ModelsNameExtension::create([
            'name' => 'III'
        ]);
    }
}
