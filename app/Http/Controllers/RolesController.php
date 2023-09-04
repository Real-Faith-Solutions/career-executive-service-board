<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    
    public function index(Request $request)
    {
        $roles = Role::all();

        return view('admin.rights_management.roles', compact('roles'));
    }

    public function show($role_name, $role_title)
    {
        $usersOnThisRole = PersonalData::whereHas('users.roles', function ($query) use ($role_name) {
            $query->where('role_name', $role_name);
        })->get();

        return view('admin.rights_management.user_roles', 
        compact('usersOnThisRole', 'role_name', 'role_title'));
    }

}
