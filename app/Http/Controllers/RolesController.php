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

    public function show($role)
    {
        $usersOnThisRole = PersonalData::whereHas('users.roles', function ($query) use ($role) {
            $query->where('role_name', $role);
        })->get();

        return view('admin.rights_management.user_roles', 
        compact('usersOnThisRole'));
    }

}
