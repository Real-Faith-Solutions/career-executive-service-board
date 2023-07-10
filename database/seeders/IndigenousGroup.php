<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IndigenousGroup as ModelsIndigenousGroup;

class IndigenousGroup extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsIndigenousGroup::create([
            'name' => 'Not a member',
        ]);
        ModelsIndigenousGroup::create([
            'name' => 'Igorot',
        ]);
        ModelsIndigenousGroup::create([
            'name' => 'Lumad',
        ]);
        ModelsIndigenousGroup::create([
            'name' => 'Mangyan',
        ]);
        ModelsIndigenousGroup::create([
            'name' => 'B`laan',
        ]);
        ModelsIndigenousGroup::create([
            'name' => 'Tagbanua',
        ]);
    }
}
