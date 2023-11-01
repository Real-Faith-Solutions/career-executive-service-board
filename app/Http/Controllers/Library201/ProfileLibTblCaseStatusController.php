<?php

namespace App\Http\Controllers\Library201;

use App\Http\Controllers\Controller;
use App\Models\CaseRecords;
use App\Models\ProfileLibTblCaseStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileLibTblCaseStatusController extends Controller
{
    public function index()
    {
        $profileLibTblCaseStatus = ProfileLibTblCaseStatus::paginate(25);

        return view('admin.201_library.case_status/index', [
            'profileLibTblCaseStatus' => $profileLibTblCaseStatus
        ]);
    }

    public function create()
    {
        return view('admin.201_library.case_status.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'TITLE' => ['required', 'unique:profilelib_tblCaseStatus,TITLE'],
        ]);

        ProfileLibTblCaseStatus::create($request->all());

        return to_route('case-status-library.index')->with('message', 'Save Successfully');
    }

    public function edit($code)
    {
        $profileLibTblCaseStatus = ProfileLibTblCaseStatus::find($code);

        return view('admin.201_library.case_status.edit', [
            'code' => $code,
            'profileLibTblCaseStatus' => $profileLibTblCaseStatus,
        ]);
    }

    public function update(Request $request,$code)
    {
        $request->validate([
            'TITLE' => ['required', Rule::unique('profilelib_tblCaseStatus')->ignore($code, 'STATUS_CODE')],
        ]);

        $profileLibTblCaseStatus = ProfileLibTblCaseStatus::find($code);
        $profileLibTblCaseStatus->update($request->all());

        return to_route('case-status-library.index')->with('message', 'Data Update Successfully');
    }

    public function destroy($code)
    {
        $codeExist = CaseRecords::where('status_code', $code)->exists();

        if($codeExist)
        {
            return redirect()->back()->with('error', 'The Case Status already has case record, so it cannot be deleted !!');
        }
        else
        {    
            $profileLibTblCaseStatus = ProfileLibTblCaseStatus::find($code);
            $profileLibTblCaseStatus->delete();
        }

        return back()->with('message', 'Data Deleted Successfully');
    }

    public function recentlyDeleted()
    {
        $profileLibTblCaseStatusTrashRecord = ProfileLibTblCaseStatus::onlyTrashed()->paginate(25);

        return view('admin.201_library.case_status.recently_deleted', [
            'profileLibTblCaseStatusTrashRecord' => $profileLibTblCaseStatusTrashRecord,
        ]) ;      
    }

    public function restore($code)
    {
        $profileLibTblCaseStatusTrashRecord = ProfileLibTblCaseStatus::onlyTrashed()->find($code);
        $profileLibTblCaseStatusTrashRecord->restore();

        return back()->with('info', 'Data Restored Successfully');
    }

    public function forceDelete($code)
    {
        $profileLibTblCaseStatusTrashRecord = ProfileLibTblCaseStatus::onlyTrashed()->find($code);
        $profileLibTblCaseStatusTrashRecord->forceDelete();

        return back()->with('info', 'Data Permanent Deleted');
    }
}
