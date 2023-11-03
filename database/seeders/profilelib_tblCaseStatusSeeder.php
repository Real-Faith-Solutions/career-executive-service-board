<?php

namespace Database\Seeders;

use App\Models\ProfileLibTblCaseStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class profilelib_tblCaseStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfileLibTblCaseStatus::create([
            'TITLE' => 'Pending'
        ]);
        ProfileLibTblCaseStatus::create([
            'TITLE' => 'Pending'
        ]);
        ProfileLibTblCaseStatus::create([
            'TITLE' => 'Dismissed'
        ]);
        ProfileLibTblCaseStatus::create([
            'TITLE' => 'On Appeal'
        ]);
        ProfileLibTblCaseStatus::create([
            'TITLE' => 'Convicted'
        ]);
        ProfileLibTblCaseStatus::create([
            'TITLE' => 'Acquitted'
        ]);
        ProfileLibTblCaseStatus::create([
            'TITLE' => 'Final and Executory'
        ]);
        ProfileLibTblCaseStatus::create([
            'TITLE' => 'For Arraignment'
        ]);
        ProfileLibTblCaseStatus::create([
            'TITLE' => 'Awaiting for Formal Investigation'
        ]);
    }
}
