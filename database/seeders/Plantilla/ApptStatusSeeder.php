<?php

namespace Database\Seeders\Plantilla;

use App\Models\Plantilla\ApptStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApptStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ApptStatus::create([
            'appt_stat_code' => 1,
            'title' => 'Acting',
        ]);
        ApptStatus::create([
            'appt_stat_code' => 2,
            'title' => 'Concurrent',
        ]);
        ApptStatus::create([
            'appt_stat_code' => 3,
            'title' => 'Contractual',
        ]);
        ApptStatus::create([
            'appt_stat_code' => 4,
            'title' => 'Detail',
        ]);
        ApptStatus::create([
            'appt_stat_code' => 5,
            'title' => 'OIC',
        ]);
        ApptStatus::create([
            'appt_stat_code' => 6,
            'title' => 'Secondment',
        ]);
        ApptStatus::create([
            'appt_stat_code' => 7,
            'title' => 'Permanent',
        ]);
        ApptStatus::create([
            'appt_stat_code' => 8,
            'title' => 'Temporary',
        ]);
        ApptStatus::create([
            'appt_stat_code' => 9,
            'title' => 'Co-terminus',
        ]);
        ApptStatus::create([
            'appt_stat_code' => 10,
            'title' => 'Reassignment',
        ]);
        ApptStatus::create([
            'appt_stat_code' => 13,
            'title' => 'Mandatory Retirement',
        ]);
        ApptStatus::create([
            'appt_stat_code' => 17,
            'title' => 'Designation',
        ]);
    }
}
