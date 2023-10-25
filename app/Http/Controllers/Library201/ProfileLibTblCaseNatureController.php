<?php

namespace App\Http\Controllers\Library201;

use App\Http\Controllers\Controller;
use App\Models\ProfileLibTblCaseNature;
use Illuminate\Http\Request;

class ProfileLibTblCaseNatureController extends Controller
{
    public function index()
    {
        $profileLibTblCaseNature = ProfileLibTblCaseNature::paginate(25);

        return view('admin.201_library.case_nature.index', [
            'profileLibTblCaseNature' => $profileLibTblCaseNature,
        ]);
    }

    public function create()
    {
        return view('admin.201_library.case_nature.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'TITLE' => ['required', 'unique:profilelib_tblCaseNature,TITLE'],
        ]);
        
        ProfileLibTblCaseNature::create($request->all());
        
        return to_route('case-nature-library.index')->with('message', 'Save Successfully');
    }

    public function edit($code)
    {
        $profileLibTblCaseNature = ProfileLibTblCaseNature::find($code);

        return view('admin.201_library.case_nature.edit', [
            'code' => $code,
            'profileLibTblCaseNature' => $profileLibTblCaseNature,
        ]);
    }
}
