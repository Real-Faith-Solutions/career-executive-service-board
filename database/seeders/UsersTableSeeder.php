<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

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

            User::create([
                'username'                  => 'cesboard',
                'email'                     => 'admin@ces.com',
                'password'                  => Hash::make('12345'),
                'last_name'                 => 'Admin',
                'first_name'                => 'CES',
                'middle_name'               => 'Luna',
                'contact_no'                => '12345678901',
                'employee_id'               => '12345',
                'role'                      => 'Super Administrator',
                'role_name_no'              => 1,
                'is_active'		            => 'Active',
                'last_updated_by'           => 'System Seeder',
                'encoder'                   => 'System Seeder',
                'default_password_change'   => 'true',
            ]);

        }
        else{

            User::where('email','=','admin@ces.com')->update([
                'username'                  => 'cesboard',
                'email'                     => 'admin@ces.com',
                'password'                  => Hash::make('12345'),
                'last_name'                 => 'Admin',
                'first_name'                => 'CES',
                'middle_name'               => 'Luna',
                'contact_no'                => '12345678901',
                'employee_id'               => '12345',
                'role'                      => 'Super Administrator',
                'role_name_no'              => 1,
                'is_active'		            => 'Active',
                'last_updated_by'           => 'System Seeder',
                'encoder'                   => 'System Seeder',
                'default_password_change'   => 'true',
            ]);
        }

        if(count($username) === 0){

            User::create([
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
                'last_updated_by'           => 'System Seeder',
                'encoder'                   => 'System Seeder',
                'default_password_change'   => 'true',
            ]);

        }
        else{

            User::where('email','=','user@ces.com')->update([
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
                'last_updated_by'           => 'System Seeder',
                'encoder'                   => 'System Seeder',
                'default_password_change'   => 'true',
            ]);
        }
    }
}
