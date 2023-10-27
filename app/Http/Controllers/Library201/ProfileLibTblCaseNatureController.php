<?php

namespace App\Http\Controllers\Library201;

use App\Http\Controllers\Controller;
use App\Models\ProfileLibTblCaseNature;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function update(Request $request, $code)
    {
        $request->validate([
            'TITLE' => ['required', Rule::unique('profilelib_tblCaseNature')->ignore($code, 'STATUS_CODE')],
        ]);

        $profileLibTblCaseNature = ProfileLibTblCaseNature::find($code);
        $profileLibTblCaseNature->update($request->all());

        return to_route('case-nature-library.index')->with('message', 'Data Update Successfully');
    }

    public function destroy($code)
    {
        $profileLibTblCaseNature = ProfileLibTblCaseNature::find($code);
        $profileLibTblCaseNature->delete();

        return back()->with('message', 'Data Deleted Successfully');
    }

    public function recentlyDeleted()
    {
        $profileLibTblCaseNatureTrashRecord = ProfileLibTblCaseNature::onlyTrashed()->paginate(25);

        return view('admin.201_library.case_nature.recently_deleted', [
            'profileLibTblCaseNatureTrashRecord' => $profileLibTblCaseNatureTrashRecord,
        ]);
    }

    public function restore($code)
    {
        $profileLibTblCaseNatureTrashRecord = ProfileLibTblCaseNature::onlyTrashed()->find($code);
        $profileLibTblCaseNatureTrashRecord->restore();

        return back()->with('info', 'Data Restored Successfully');
    }

    public function forceDelete($code)
    {
        $profileLibTblCaseNatureTrashRecord = ProfileLibTblCaseNature::onlyTrashed()->find($code);
        $profileLibTblCaseNatureTrashRecord->forceDelete();

        return back()->with('info', 'Data Permanent Deleted');
    }
}
