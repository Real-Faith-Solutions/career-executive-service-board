<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $cesboard = User::where('email','=','admin@ces.com')->get();
        $username = User::where('email','=','user@ces.com')->get();

        if(count($cesboard) === 0){

            $admin = User::create([
                'username'                  => 'cesboard',
                'email'                     => 'admin@ces.com',
                'password'                  => Hash::make('12345'),
                'last_name'                 => 'Dela Cruz',
                'first_name'                => 'Juan',
                'middle_name'               => 'D.C',
                'contact_no'                => '09198745893',
                'employee_id'               => '12345',
                'role'                      => 'Super Administrator',
                'role_name_no'              => 1,
                'is_active'		            => 'Active',
                'last_updated_by'           => 'system encode',
                'encoder'                   => 'system encode',
                'default_password_change'   => 'true',
            ]);
            $admin->assignRole('admin');

        }
        else{

            $admin = User::where('email','=','admin@ces.com')->update([
                'username'                  => 'cesboard',
                'email'                     => 'admin@ces.com',
                'password'                  => Hash::make('12345'),
                'last_name'                 => 'Dela Cruz',
                'first_name'                => 'Juan',
                'middle_name'               => 'D.C',
                'contact_no'                => '12345678901',
                'employee_id'               => '12345',
                'role'                      => 'Super Administrator',
                'role_name_no'              => 1,
                'is_active'		            => 'Active',
                'last_updated_by'           => 'system encode',
                'encoder'                   => 'system encode',
                'default_password_change'   => 'true',
            ]);
            $admin->assignRole('admin');

        }

        if(count($username) === 0){

            $user = User::create([
                'username'                  => 'username',
                'email'                     => 'user@ces.com',
                'password'                  => Hash::make('12345'),
                'last_name'                 => 'De Guzman',
                'first_name'                => 'Alfred',
                'middle_name'               => 'Garcia',
                'contact_no'                => '12345678901',
                'employee_id'               => '12345',
                'role'                      => 'User',
                'role_name_no'              => 0,
                'is_active'		            => 'Active',
                'last_updated_by'           => 'system encode',
                'encoder'                   => 'system encode',
                'default_password_change'   => 'true',
            ]);
            $user->assignRole('user');

        }
        else{

            $user = User::where('email','=','user@ces.com')->update([
                'username'                  => 'username',
                'email'                     => 'user@ces.com',
                'password'                  => Hash::make('12345'),
                'last_name'                 => 'De Guzman',
                'first_name'                => 'Alfred',
                'middle_name'               => 'Garcia',
                'contact_no'                => '12345678901',
                'employee_id'               => '12345',
                'role'                      => 'User',
                'role_name_no'              => 0,
                'is_active'		            => 'Active',
                'last_updated_by'           => 'system encode',
                'encoder'                   => 'system encode',
                'default_password_change'   => 'true',
            ]);
            $user->assignRole('user');
        }
    }
}
