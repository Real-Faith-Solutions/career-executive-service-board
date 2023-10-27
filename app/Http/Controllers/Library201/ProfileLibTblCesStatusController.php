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

        return to_route('ces-status-library.index')->with('message', 'Save Sucessfully');
    }

    public function edit($code)
    {
        $profileLibTblCesStatus =  ProfileLibTblCesStatus::find($code);        

        return view('admin.201_library.ces_status.edit', [
            'profileLibTblCesStatus' => $profileLibTblCesStatus,
            'code' => $code
        ]);
    }

    public function update(Request $request, $code)
    {
        $request->validate([
            'description' => ['required', 'regex:/^[a-zA-Z ]*$/', Rule::unique('profilelib_tblcesstatus')->ignore($code, 'code')],
        ]);

        $profileLibTblCesStatus = ProfileLibTblCesStatus::find($code);        
        $profileLibTblCesStatus->update($request->all());

        return to_route('ces-status-library.index')->with('info', 'Data Update Sucessfully');
    }

    public function destroy($code)
    {
        $profileLibTblCesStatus = ProfileLibTblCesStatus::find($code);        
        $profileLibTblCesStatus->delete();

        return back()->with('message', 'Data Deleted Sucessfuly');
    }

    public function recentlyDeleted()
    {
        $profileLibTblCesStatusTrashRecord = ProfileLibTblCesStatus::onlyTrashed()->paginate(25);

        return view('admin.201_library.ces_status.recently_deleted', [
            'profileLibTblCesStatusTrashRecord' => $profileLibTblCesStatusTrashRecord,
        ]);
    }

    public function restore($code)
    {
        $profileLibTblCesStatusTrashRecord = ProfileLibTblCesStatus::onlyTrashed()->find($code);        
        $profileLibTblCesStatusTrashRecord->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }

    public function forceDelete($code)
    {
        $profileLibTblCesStatusTrashRecord = ProfileLibTblCesStatus::onlyTrashed()->find($code);        
        $profileLibTblCesStatusTrashRecord->forceDelete();

        return back()->with('info', 'Data Permanently Deleted');
    }
}
