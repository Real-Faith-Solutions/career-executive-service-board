<?php

namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::create(['role_name' => 'admin']);
        Role::create(['role_name' => 'editor']);
        $userRole = Role::create(['role_name' => 'user']);

        $adminRole->assignPermission('create-posts');
        $adminRole->assignPermission('edit-posts');
        $adminRole->assignPermission('manage-users');
        
        $userRole->assignPermission('create-posts');
        $userRole->assignPermission('edit-posts');
    }
}
