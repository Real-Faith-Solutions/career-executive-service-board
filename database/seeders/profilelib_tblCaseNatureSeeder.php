<?php

namespace Database\Seeders;

use App\Models\ProfileLibTblCaseNature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class profilelib_tblCaseNatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfileLibTblCaseNature::create([
            'TITLE' => 'Administrative Case',
        ]);
        ProfileLibTblCaseNature::create([
            'TITLE' => 'Civil Case',
        ]);
        ProfileLibTblCaseNature::create([
            'TITLE' => 'Criminal Case',
        ]);
        ProfileLibTblCaseNature::create([
            'TITLE' => 'Administrative and Criminal',
        ]);
        ProfileLibTblCaseNature::create([
            'TITLE' => 'Violation of Sec. 3 (E & F) of RA 3019',
        ]);
    }
}
