<?php

namespace App\Http\Controllers\Library201;

use App\Http\Controllers\Controller;
use App\Models\ProfileLibTblCesStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileLibTblCesStatusController extends Controller
{
    public function index()
    {
        $profileLibTblCesStatus = ProfileLibTblCesStatus::paginate(25);

        return view('admin.201_library.ces_status.index', [
            'profileLibTblCesStatus' => $profileLibTblCesStatus
        ]);
    }

    public function create()
    {
        return view('admin.201_library.ces_status.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => ['required', 'regex:/^[a-zA-Z ]*$/', 'unique:profilelib_tblcesstatus,description'],
        ]);

        ProfileLibTblCesStatus::create($request->all());        

        return  to_route('ces-status-library.index')->with('message', 'Save Sucessfully');
    }

    public function edit($code)
    {

    }

    public function update(Request $request, $code)
    {
        $request->validate([
            'TITLE' => ['required', 'regex:/^[a-zA-Z ]*$/', Rule::unique('profilelib_tblExamRef')->ignore($code, 'CODE')],
        ]);
    }
}
