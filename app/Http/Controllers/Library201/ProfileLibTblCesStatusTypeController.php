<?php

namespace App\Http\Controllers\Library201;

use App\Http\Controllers\Controller;
use App\Models\ProfileLibTblCesStatusType;
use Illuminate\Http\Request;

class ProfileLibTblCesStatusTypeController extends Controller
{
    public function index()
    {
        $profileLibTblCesStatusType = ProfileLibTblCesStatusType::paginate(25);

        return view('admin.201_library.ces_status_type.index', [
            'profileLibTblCesStatusType' => $profileLibTblCesStatusType,
        ]);
    }

    public function create()
    {
        return view('admin.201_library.ces_status_type.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => ['required', 'regex:/^[a-zA-Z ]*$/', 'unique:profilelib_tblcesstatustype,description'],
        ]);

        ProfileLibTblCesStatusType::create($request->all());

        return to_route('ces-status-type-library.index')->with('message', 'Save Successfully');
    }

    public function edit($code)
    {
        $profileLibTblCesStatusType = ProfileLibTblCesStatusType::find($code);

        return view('admin.201_library.ces_status_type.edit', [
            'code' => $code,
            'profileLibTblCesStatusType' => $profileLibTblCesStatusType
        ]);
    }
}
