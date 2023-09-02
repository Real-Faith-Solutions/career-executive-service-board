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

        return view('admin\rights_management\roles', compact('roles'));
    }

}
