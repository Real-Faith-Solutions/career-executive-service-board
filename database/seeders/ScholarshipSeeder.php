<?php

namespace Database\Seeders;

use App\Models\Scholarships;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScholarshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Scholarships::create([
            'cesno' => 1,
            'type' => 'Foreign',
            'title' => 'Faculty Exchange Fellowship',
            'sponsor' => 'Trinity College of Hartfort, Connecticut, USA',
            'from_dt' => 1972,
            'to_dt' => 1973,
        ]);
    }
}
