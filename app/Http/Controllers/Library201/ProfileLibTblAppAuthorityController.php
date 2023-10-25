<?php

namespace App\Http\Controllers\Library201;

use App\Http\Controllers\Controller;
use App\Models\ProfileLibTblAppAuthority;
use Illuminate\Http\Request;

class ProfileLibTblAppAuthorityController extends Controller
{
    public function index()
    {
        $profileLibTblAppAuthority = ProfileLibTblAppAuthority::paginate(25);

        return view('admin.201_library.appointing_authority.index', [
            'profileLibTblAppAuthority' => $profileLibTblAppAuthority,
        ]);
    }

    public function create()
    {
        return view('admin.201_library.appointing_authority.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => ['required', 'regex:/^[a-zA-Z ]*$/', 'unique:profilelib_tblappAuthority,description'],
        ]);

        ProfileLibTblAppAuthority::create($request->all());

        return to_route('appointing-authority-library.index')->with('message', 'Save Sucessfully');
    }

    public function edit($code)
    {
        $profileLibTblAppAuthority = ProfileLibTblAppAuthority::find($code);

        return view('admin.201_library.appointing_authority.edit', [
            'code' => $code,
            'profileLibTblAppAuthority' => $profileLibTblAppAuthority,
        ]);
    }
}
