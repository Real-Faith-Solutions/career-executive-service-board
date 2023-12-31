<?php

namespace App\Http\Controllers\Library201;

use App\Http\Controllers\Controller;
use App\Models\ProfileLibTblCesStatusAcc;
use App\Models\ProfileTblCesStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function edit($code)
    {
        $profileLibTblCesStatusAcc = ProfileLibTblCesStatusAcc::find($code);

        return view('admin.201_library.ces_status_acquired_thru.edit', [
            'code' => $code,
            'profileLibTblCesStatusAcc' => $profileLibTblCesStatusAcc,
        ]);
    }

    public function update(Request $request, $code)
    {
        $request->validate([
            'description' => ['required', Rule::unique('profilelib_tblcesstatusAcc')->ignore($code, 'code')],
        ]);

        $profileLibTblCesStatusAcc = ProfileLibTblCesStatusAcc::find($code);
        $profileLibTblCesStatusAcc->update($request->all());

        return to_route('ces-status-acquired-thru-library.index')->with('message', 'Data Update Successfully');
    }

    public function destroy($code)
    {
        $codeExist = ProfileTblCesStatus::withTrashed()->where('acc_code', $code)->exists();
        
        if($codeExist)
        {
            return redirect()->back()->with('error', 'The CES Status Acquired Thru already has user, so it cannot be deleted !!');
        }
        else
        {
            $profileLibTblCesStatusAcc = ProfileLibTblCesStatusAcc::find($code);
            $profileLibTblCesStatusAcc->delete();
        }
        
        return back()->with('message', 'Data Deleted Successfully');
    }

    public function recentlyDeleted()
    {
        $profileLibTblCesStatusAccTrashRecord = ProfileLibTblCesStatusAcc::onlyTrashed()->paginate(25);

        return view('admin.201_library.ces_status_acquired_thru.recently_deleted', [
            'profileLibTblCesStatusAccTrashRecord' => $profileLibTblCesStatusAccTrashRecord,
        ]);
    }

    public function restore($code)
    {
        $profileLibTblCesStatusAccTrashRecord = ProfileLibTblCesStatusAcc::onlyTrashed()->find($code);
        $profileLibTblCesStatusAccTrashRecord->restore();

        return back()->with('message', 'Data Restored Successfully');
    }

    public function forceDelete($code)
    {
        $profileLibTblCesStatusAccTrashRecord = ProfileLibTblCesStatusAcc::onlyTrashed()->find($code);
        $profileLibTblCesStatusAccTrashRecord->forceDelete();

        return back()->with('message', 'Data Permanent Deleted');
    }
}
