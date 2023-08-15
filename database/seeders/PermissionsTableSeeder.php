<?php

namespace Database\Seeders;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['permission_name' => 'manage-users']);
        Permission::create(['permission_name' => 'create-posts']);
        Permission::create(['permission_name' => 'edit-posts']);
    }
}
