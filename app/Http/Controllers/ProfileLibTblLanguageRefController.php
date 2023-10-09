<?php

namespace App\Http\Controllers;

use App\Models\ProfileLibTblLanguageRef;
use Illuminate\Http\Request;

class ProfileLibTblLanguageRefController extends Controller
{
    public function index()
    {
        $profileLibTblLanguageRef =  ProfileLibTblLanguageRef::select('title', 'code')
        ->paginate(25);

        return view('admin.201_library.langauge.index', compact('profileLibTblLanguageRef'));
    }

    public function create()
    {
        return view('admin.201_library.langauge.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'regex:/^[a-zA-Z ]*$/', 'unique:profilelib_tblLanguageRef,title'],
        ]);

        ProfileLibTblLanguageRef::create($request->all());

        return back()->with('message', 'Save Sucessfully');
    }

    public function edit($code)
    {
        $profileLibTblLanguageRef =  ProfileLibTblLanguageRef::find($code);

        return view('admin.201_library.langauge.edit', compact('profileLibTblLanguageRef'));
    }
}
