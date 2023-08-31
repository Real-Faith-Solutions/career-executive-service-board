<?php

namespace Database\Seeders;

use App\Models\ProfileLibTblAppAuthority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileLibTblAppAuthoritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfileLibTblAppAuthority::create([
            'description' => 'Ferdinand E. Marcos',
        ]);
        ProfileLibTblAppAuthority::create([
            'description' => 'Corazon C. Aquino',
        ]);
        ProfileLibTblAppAuthority::create([
            'description' => 'Fidel V. Ramos',
        ]);
        ProfileLibTblAppAuthority::create([
            'description' => 'Gloria Macapagal Arroyo',
        ]);
        ProfileLibTblAppAuthority::create([
            'description' => 'Joseph Ejercito Estrada',
        ]);
        ProfileLibTblAppAuthority::create([
            'description' => 'Benigno Aquino Jr.',
        ]);
        ProfileLibTblAppAuthority::create([
            'description' => 'Rodrigo Roa Duterte',
        ]);
        ProfileLibTblAppAuthority::create([
            'description' => '-',
        ]);
    }
}
