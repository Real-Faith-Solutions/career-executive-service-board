<?php

namespace App\Http\Controllers\Library201;

use App\Http\Controllers\Controller;
use App\Models\ProfileLibTblCesStatusType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function update(Request $request, $code)
    {
        $request->validate([
            'description' => ['required', 'regex:/^[a-zA-Z ]*$/', Rule::unique('profilelib_tblcesstatustype')->ignore($code, 'code')],
        ]);

        $profileLibTblCesStatusType = ProfileLibTblCesStatusType::find($code);
        $profileLibTblCesStatusType->update($request->all());

        return to_route('ces-status-type-library.index')->with('message', 'Data Update Successfully');
    }

    public function destroy($code)
    {
        $profileLibTblCesStatusType = ProfileLibTblCesStatusType::find($code);
        $profileLibTblCesStatusType->delete();

        return back()->with('message', 'Data Deleted Successfully');
    }

    public function recentlyDeleted()
    {
        $profileLibTblCesStatusTypeTrashRecord = ProfileLibTblCesStatusType::onlyTrashed()->paginate(25);

        return view('admin.201_library.ces_status_type.recently_deleted', [
            'profileLibTblCesStatusTypeTrashRecord' => $profileLibTblCesStatusTypeTrashRecord,
        ]);
    }

    public function restore($code)
    {
        $profileLibTblCesStatusTypeTrashRecord = ProfileLibTblCesStatusType::onlyTrashed()->find($code);
        $profileLibTblCesStatusTypeTrashRecord->restore();

        return back()->with('info', 'Data Restored Successfully');
    }

    public function forceDelete($code)
    {
        $profileLibTblCesStatusTypeTrashRecord = ProfileLibTblCesStatusType::onlyTrashed()->find($code);
        $profileLibTblCesStatusTypeTrashRecord->forceDelete();

        return back()->with('info', 'Data Permanently Deleted');
    }
}
