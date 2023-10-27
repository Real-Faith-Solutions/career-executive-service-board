<?php

namespace App\Http\Controllers\Library201;

use App\Http\Controllers\Controller;
use App\Models\ProfileLibTblExpertiseGen;
use App\Models\ProfileLibTblExpertiseMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileLibTblExpertiseGenController extends Controller
{
    public function getFullNameAttribute()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        return $encoder;
    }
    
    public function index()
    {
        $profileLibTblExpertiseGen = ProfileLibTblExpertiseGen::paginate(25);

        return view('admin.201_library.expertise_general.index', [
            'profileLibTblExpertiseGen' => $profileLibTblExpertiseGen,
        ]);
    }

    public function create()
    {
        return view('admin.201_library.expertise_general.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Title' => ['required', 'regex:/^[a-zA-Z ]*$/', 'unique:profilelib_tblExpertiseGen,Title'],
        ]);

        ProfileLibTblExpertiseGen::create(array_merge(
            $request->all(), 
            [
                'encoder' => $this->getFullNameAttribute(),
            ]
        ));

        return to_route('expertise-general.index')->with('message', 'Save Successfully');
    }

    public function edit($code)
    {
        $profileLibTblExpertiseGen = ProfileLibTblExpertiseGen::find($code);

        return view('admin.201_library.expertise_general.edit', [
            'code' => $code,
            'profileLibTblExpertiseGen' => $profileLibTblExpertiseGen,
        ]);
    }

    public function update(Request $request, $code)
    {
        $request->validate([
            'Title' => ['required', 'regex:/^[a-zA-Z ]*$/', Rule::unique('profilelib_tblExpertiseGen')->ignore($code, 'GenExp_Code')],
        ]);

        $profileLibTblExpertiseGen = ProfileLibTblExpertiseGen::find($code);
        $profileLibTblExpertiseGen->update(array_merge(
            $request->all(),
            [
                'updated_by' => $this->getFullNameAttribute(),
            ]
        ));

        return to_route('expertise-general.index')->with('message', 'Data Update Successfully');
    }

    public function destroy($code)
    {
        $codeExist = ProfileLibTblExpertiseMaster::where('GenExp_CODE', $code)->exists();
        
        if($codeExist)
        {
            return redirect()->back()->with('error', 'The Expertise General already has specialization, so it cannot be deleted !!');
        }
        else
        {
            $profileLibTblExpertiseGen = ProfileLibTblExpertiseGen::find($code);
            $profileLibTblExpertiseGen->delete();
        }

        return back()->with('message', 'Data Deleted Successfully');
    }

    public function recentlyDeleted()
    {
        $profileLibTblExpertiseGenTrashRecord = ProfileLibTblExpertiseGen::onlyTrashed()->paginate(25);

        return view('admin.201_library.expertise_general.recently_deleted', [
            'profileLibTblExpertiseGenTrashRecord' => $profileLibTblExpertiseGenTrashRecord,
        ]);
    }

    public function restore($code)
    {
        $profileLibTblExpertiseGenTrashRecord = ProfileLibTblExpertiseGen::onlyTrashed()->find($code);
        $profileLibTblExpertiseGenTrashRecord->restore();

        return back()->with('info', 'Data Restored Successfully');
    }

    public function forceDelete($code)
    {
        $profileLibTblExpertiseGenTrashRecord = ProfileLibTblExpertiseGen::onlyTrashed()->find($code);
        $profileLibTblExpertiseGenTrashRecord->forceDelete();

        return back()->with('info', 'Data Permanent Deleted');
    }
}
