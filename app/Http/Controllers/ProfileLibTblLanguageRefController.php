<?php

namespace App\Http\Controllers;

use App\Models\ProfileLibTblLanguageRef;
use App\Models\ProfileTblLanguage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileLibTblLanguageRefController extends Controller
{
    public function index()
    {
        $profileLibTblLanguageRef =  ProfileLibTblLanguageRef::select('title', 'code')
        ->orderBy('code')
        ->paginate(25);

        return view('admin.201_library.langauge.index', compact('profileLibTblLanguageRef'));
    }

    public function create()
    {
        return view('admin.201_library.langauge.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'regex:/^[a-zA-Z ]*$/', 'unique:profilelib_tblLanguageRef,title'],
        ]);

        ProfileLibTblLanguageRef::create($request->all());

        return to_route('language-library.index')->with('message', 'Save Sucessfully');
    }

    public function edit($code)
    {
        $profileLibTblLanguageRef =  ProfileLibTblLanguageRef::find($code);

        return view('admin.201_library.langauge.edit', compact('profileLibTblLanguageRef'));
    }

    public function update(Request $request, $code)
    {
        $request->validate([
            'title' => ['required', 'regex:/^[a-zA-Z ]*$/', Rule::unique('profilelib_tblLanguageRef')->ignore($code, 'code')],
        ]);

        $profileLibTblLanguageRef = ProfileLibTblLanguageRef::find($code);
        $profileLibTblLanguageRef->update($request->all());
    
        return back()->with('info', 'Update Sucessfully');
    }

    public function destroy($code)
    {
        $codeExist = ProfileTblLanguage::withTrashed()->where('lang_code', $code)->exists();
        
        if($codeExist)
        {
            return redirect()->back()->with('error', 'The Langauge already has user, so it cannot be deleted !!');
        }
        else
        {
            $profileLibTblLanguageRef = ProfileLibTblLanguageRef::find($code);
            $profileLibTblLanguageRef->delete();
        }
        
        return back()->with('message', 'Data Deleted Successfully');
    }

    public function recentlyDeleted()
    {
        $profileLibTblLanguageRefTrashRecord =  ProfileLibTblLanguageRef::onlyTrashed()->paginate(25);

        return view('admin.201_library.langauge.recently_deleted', [
            'profileLibTblLanguageRefTrashRecord' => $profileLibTblLanguageRefTrashRecord,
        ]);
    }

    public function restore($code)
    {
        $profileLibTblLanguageRefTrashRecord =  ProfileLibTblLanguageRef::onlyTrashed()->find($code);
        $profileLibTblLanguageRefTrashRecord->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }

    public function forceDelete($code)
    {
        $profileLibTblLanguageRefTrashRecord =  ProfileLibTblLanguageRef::onlyTrashed()->find($code);
        $profileLibTblLanguageRefTrashRecord->forceDelete();

        return back()->with('info', 'Data Permanently Deleted');
    }
}
