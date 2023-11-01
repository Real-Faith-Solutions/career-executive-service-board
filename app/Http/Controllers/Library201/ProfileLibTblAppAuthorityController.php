<?php

namespace App\Http\Controllers\Library201;

use App\Http\Controllers\Controller;
use App\Models\ProfileLibTblAppAuthority;
use App\Models\ProfileTblCesStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileLibTblAppAuthorityController extends Controller
{
    public function index()
    {
        $profileLibTblAppAuthority = ProfileLibTblAppAuthority::paginate(25);

        return view('admin.201_library.appointing_authority.index', [
            'profileLibTblAppAuthority' => $profileLibTblAppAuthority,
        ]);
    }

    public function create()
    {
        return view('admin.201_library.appointing_authority.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => ['required', 'regex:/^[a-zA-Z ]*$/', 'unique:profilelib_tblappAuthority,description'],
        ]);

        ProfileLibTblAppAuthority::create($request->all());

        return to_route('appointing-authority-library.index')->with('message', 'Save Sucessfully');
    }

    public function edit($code)
    {
        $profileLibTblAppAuthority = ProfileLibTblAppAuthority::find($code);

        return view('admin.201_library.appointing_authority.edit', [
            'code' => $code,
            'profileLibTblAppAuthority' => $profileLibTblAppAuthority,
        ]);
    }

    public function update(Request $request, $code)
    {
        $request->validate([
            'description' => ['required', 'regex:/^[a-zA-Z ]*$/', Rule::unique('profilelib_tblappAuthority')->ignore($code, 'code')],
        ]);

        $profileLibTblAppAuthority = ProfileLibTblAppAuthority::find($code);
        $profileLibTblAppAuthority->update($request->all());

        return to_route('appointing-authority-library.index')->with('message', 'Data Update Successfully');
    }

    public function destroy($code)
    {
        $codeExist = ProfileTblCesStatus::where('official_code', $code)->exists();
        
        if($codeExist)
        {
            return redirect()->back()->with('error', 'The Appointing Authority already has user, so it cannot be deleted !!');
        }
        else
        {
            $profileLibTblAppAuthority = ProfileLibTblAppAuthority::find($code);
            $profileLibTblAppAuthority->delete();
        }

        return back()->with('message', 'Data Deleted Successfully');
    }

    public function recentlyDeleted()
    {
        $profileLibTblAppAuthorityTrashRecord = ProfileLibTblAppAuthority::onlyTrashed()->paginate(25);

        return view('admin.201_library.appointing_authority.recently_deleted', [
            'profileLibTblAppAuthorityTrashRecord' => $profileLibTblAppAuthorityTrashRecord,
        ]);
    }

    public function restore($code)
    {
        $profileLibTblAppAuthorityTrashRecord = ProfileLibTblAppAuthority::onlyTrashed()->find($code);
        $profileLibTblAppAuthorityTrashRecord->restore();

        return back()->with('info', 'Data Restored Successfully');
    }

    public function forceDelete($code)
    {
        $profileLibTblAppAuthorityTrashRecord = ProfileLibTblAppAuthority::onlyTrashed()->find($code);
        $profileLibTblAppAuthorityTrashRecord->forceDelete();

        return back()->with('info', 'Data Permanent Deleted');
    }
}
