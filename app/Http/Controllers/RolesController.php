<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use App\Models\Role;
use App\Models\User;
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
        $roles = Role::all();

        $usersOnThisRole = PersonalData::whereHas('users.roles', function ($query) use ($role_name) {
            $query->where('role_name', $role_name);
        })->get();

        return view('admin.rights_management.user_roles', 
            compact('usersOnThisRole', 'role_name', 'role_title', 'roles'));
    }

    public function change(Request $request)
    {
        $cesno = $request->change_role_cesno;
        $personalData = PersonalData::where('cesno', $cesno)->first();
        $user = User::where('personal_data_cesno', $cesno)->first();
        $userRole = $user->roles->first();
        $role_name = $userRole->role_name;
        $role_title = $userRole->role_title;
        $roles = Role::all();

        $usersOnThisRole = PersonalData::whereHas('users.roles', function ($query) use ($role_name) {
            $query->where('role_name', $role_name);
        })->get();

        $count = $usersOnThisRole->count();
        
        if($count <= 1){
            return redirect()->route('roles.show', compact('usersOnThisRole', 'role_name', 'role_title', 'roles'))->with('error', 'There should be atleast 1 '.$role_title);

        }

        $new_role = $request->new_role;
        $user->changeRole($new_role);
        $userRole = $user->roles->first();
        $userName = $request->change_role_name;
        $newRoleTitle = Role::where('role_name', $new_role)->value('role_title');

        return redirect()->route('roles.show', compact('usersOnThisRole', 'role_name', 'role_title', 'roles'))->with('info', $userName.' assigned as '.$newRoleTitle);
    }

    public function showPermissions($role_name, $role_title)
    {
        return view('admin.rights_management.permissions', compact('role_name', 'role_title'));
    }

    public function showPermissionsProfiling($role_name, $role_title)
    {
        $role = Role::where('role_name', $role_name)->first();
        $permissions = $role->permissions;

        return view('admin.rights_management.role_permissions', compact('role_name', 'role_title', 'permissions'));
    }

}
