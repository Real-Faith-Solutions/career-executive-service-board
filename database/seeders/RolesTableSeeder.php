<?php

namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['role_name' => 'admin']);
        Role::create(['role_name' => 'editor']);
        Role::create(['role_name' => 'user']);
    }
}
