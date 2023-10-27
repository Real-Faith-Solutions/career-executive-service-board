<?php

namespace App\Http\Controllers;

use App\Models\ProfileLibTblLanguageRef;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileLibTblLanguageRefController extends Controller
{
    public function index()
    {
        $profileLibTblLanguageRef =  ProfileLibTblLanguageRef::select('title', 'code')
        ->orderByDesc('code')
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
        $profileLibTblLanguageRef = ProfileLibTblLanguageRef::find($code);
        $profileLibTblLanguageRef->delete();

        return back()->with('message', 'Data Deleted Successfully');
    }

    public function recentlyDeleted()
    {
        $profileLibTblLanguageRefTrashRecord =  ProfileLibTblLanguageRef::onlyTrashed()->paginate(25);

        return view('admin.201_library.langauge.recently_deleted', [
            'profileLibTblLanguageRefTrashRecord' => $profileLibTblLanguageRefTrashRecord,
        ]);
    }
}
