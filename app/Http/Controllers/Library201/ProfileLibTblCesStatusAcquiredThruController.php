<?php

namespace App\Http\Controllers\Library201;

use App\Http\Controllers\Controller;
use App\Models\ProfileLibTblCesStatusAcc;
use Illuminate\Http\Request;

class ProfileLibTblCesStatusAcquiredThruController extends Controller
{
    public function index()
    {
        $profileLibTblCesStatusAcc = ProfileLibTblCesStatusAcc::paginate(25);

        return view('admin.201_library.ces_status_acquired_thru.index', [
            'profileLibTblCesStatusAcc' => $profileLibTblCesStatusAcc,
        ]);
    }

    public function create()
    {
        return view('admin.201_library.ces_status_acquired_thru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => ['required', 'regex:/^[a-zA-Z ]*$/', 'unique:profilelib_tblcesstatusAcc,description'],
        ]);

        ProfileLibTblCesStatusAcc::create($request->all());

        return to_route('ces-status-acquired-thru-library.index')->with('message', 'Save Successfully');
    }
}
