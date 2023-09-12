<?php

namespace Database\Seeders\Plantilla;

use App\Models\Plantilla\DepartmentAgencyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentAgencyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DepartmentAgencyType::create([
            'sectorid' => 1,
            'title' => "Attach Bureau/Office",
        ]);
        DepartmentAgencyType::create([
            'sectorid' => 2,
            'title' => "National Government Agencies",
        ]);
        DepartmentAgencyType::create([
            'sectorid' => 2,
            'title' => "Government Financial Institutions and Corporation",
        ]);
        DepartmentAgencyType::create([
            'sectorid' => 2,
            'title' => "Attach Bureau/Office",
        ]);
        DepartmentAgencyType::create([
            'sectorid' => 3,
            'title' => "Court of Appeals",
        ]);
        DepartmentAgencyType::create([
            'sectorid' => 3,
            'title' => "Municipal Trial Court",
        ]);
        DepartmentAgencyType::create([
            'sectorid' => 3,
            'title' => "Regional Trial Court",
        ]);
        DepartmentAgencyType::create([
            'sectorid' => 3,
            'title' => "Sandiganbayan",
        ]);
        DepartmentAgencyType::create([
            'sectorid' => 3,
            'title' => "Supreme Court",
        ]);
        DepartmentAgencyType::create([
            'sectorid' => 3,
            'title' => "Attach Bureau/Office",
        ]);
        DepartmentAgencyType::create([
            'sectorid' => 4,
            'title' => "House",
        ]);
        DepartmentAgencyType::create([
            'sectorid' => 4,
            'title' => "Senate",
        ]);
        DepartmentAgencyType::create([
            'sectorid' => 4,
            'title' => "Attach Bureau/Office",
        ]);
        DepartmentAgencyType::create([
            'sectorid' => 5,
            'title' => "Attach Bureau/Office",
        ]);
        DepartmentAgencyType::create([
            'sectorid' => 6,
            'title' => "Private Sector",
        ]);
        DepartmentAgencyType::create([
            'sectorid' => 6,
            'title' => "Private Sector - Attach Bureau/Office",
        ]);
        DepartmentAgencyType::create([
            'sectorid' => 7,
            'title' => "State Universities and Colleges",
        ]);
        DepartmentAgencyType::create([
            'sectorid' => 7,
            'title' => "Private Universities and Colleges",
        ]);
    }
}