<?php

namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::create(['role_name' => 'admin']);
        $power_user = Role::create(['role_name' => 'power_user']);
        $rank_officer = Role::create(['role_name' => 'rank_officer']);
        $cesb_operator = Role::create(['role_name' => 'cesb_operator']);
        $training_officer = Role::create(['role_name' => 'training_officer']);
        $cespes_operator = Role::create(['role_name' => 'cespes_operator']);
        $agency_hr_operator = Role::create(['role_name' => 'agency_hr_operator']);
        $user = Role::create(['role_name' => 'user']);

        $admin->assignPermission('create-posts');
        $admin->assignPermission('edit-posts');
        $admin->assignPermission('manage-users');
        $admin->assignPermission('add-profile');
        
        $user->assignPermission('create-posts');
        $user->assignPermission('edit-posts');
    }
}
