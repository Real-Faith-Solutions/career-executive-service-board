<?php

namespace Database\Seeders;

use App\Models\ProfileLibTblCesStatusAcc;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileLibTblCesStatusAccSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfileLibTblCesStatusAcc::create([
            'description' => 'Examination',
        ]);
        ProfileLibTblCesStatusAcc::create([
            'description' => 'Motu Proprio',
        ]);
        ProfileLibTblCesStatusAcc::create([
            'description' => 'Testimonial Nomination',
        ]);
        ProfileLibTblCesStatusAcc::create([
            'description' => 'Training',
        ]);
        ProfileLibTblCesStatusAcc::create([
            'description' => 'MNSA E.O 145 ',
        ]);
        ProfileLibTblCesStatusAcc::create([
            'description' => 'Others',
        ]);
    }
}
