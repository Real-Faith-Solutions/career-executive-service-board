<?php

namespace Database\Seeders;

use App\Models\TrainingLibCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainingLibCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TrainingLibCategory::create([
            'description' => 'SALAMIN',
        ]);

        TrainingLibCategory::create([
            'description' => 'DIWA',
        ]);

        TrainingLibCategory::create([
            'description' => 'GABAY',
        ]);

        TrainingLibCategory::create([
            'description' => 'IELP',
        ]);

        TrainingLibCategory::create([
            'description' => 'PRW',
        ]);

        TrainingLibCategory::create([
            'description' => 'ALAB',
        ]);

        TrainingLibCategory::create([
            'description' => 'PADM',
        ]);

        TrainingLibCategory::create([
            'description' => 'DM',
        ]);

        TrainingLibCategory::create([
            'description' => 'POWER PRINCIPLE',
        ]);

        TrainingLibCategory::create([
            'description' => 'SALDIWA',
        ]);

        TrainingLibCategory::create([
            'description' => 'FMPM',
        ]);

        TrainingLibCategory::create([
            'description' => 'PSEA',
        ]);

        TrainingLibCategory::create([
            'description' => 'Agrarian Reform',
        ]);

        TrainingLibCategory::create([
            'description' => 'Agriculture',
        ]);

        TrainingLibCategory::create([
            'description' => 'Arts/Humanities',
        ]);
    }
}
