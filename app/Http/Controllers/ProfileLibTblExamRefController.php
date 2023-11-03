<?php

namespace App\Http\Controllers;

use App\Models\ExaminationsTaken;
use App\Models\ProfileLibTblExamRef;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileLibTblExamRefController extends Controller
{
    public function index()
    {
        $profileLibTblExamRef = ProfileLibTblExamRef::select('CODE' ,'TITLE')->paginate(25);

        return view('admin.201_library.examination.index', compact('profileLibTblExamRef'));
    }

    public function create()
    {
        return view('admin.201_library.examination.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'TITLE' => ['required', 'regex:/^[a-zA-Z ]*$/', 'unique:profilelib_tblExamRef,TITLE'],
        ]);

       ProfileLibTblExamRef::create($request->all());

       return back()->with('message', 'Save Sucessfully');
    }

    public function edit($code)
    {
        $profileLibTblExamRef = ProfileLibTblExamRef::find($code);

        return view('admin.201_library.examination.edit',compact('profileLibTblExamRef', 'code'));
    }

    public function update(Request $request, $code)
    {
        $request->validate([
            'TITLE' => ['required', 'regex:/^[a-zA-Z ]*$/', Rule::unique('profilelib_tblExamRef')->ignore($code, 'CODE')],
        ]);

        $profileLibTblExamRef = ProfileLibTblExamRef::find($code);
        $profileLibTblExamRef->update($request->all());
    
        return to_route('examination.index')->with('info', 'Update Sucessfully');
    }

    public function destroy($code)
    {
        $codeExist = ExaminationsTaken::withTrashed()->where('exam_code', $code)->exists();
        
        if($codeExist)
        {
            return redirect()->back()->with('error', 'The Examination already has user, so it cannot be deleted !!');
        }
        else
        {
            $profileLibTblExamRef = ProfileLibTblExamRef::find($code);
            $profileLibTblExamRef->delete();
        }
        
        return back()->with('message', 'Deleted Sucessfully');
    }

    public function recentlyDeleted()
    {
        $profileLibTblExamRef =  ProfileLibTblExamRef::onlyTrashed()
        ->select('CODE', 'TITLE', 'deleted_at')
        ->orderByDesc('deleted_at')
        ->paginate(25);

        return view('admin.201_library.examination.recently_deleted', compact('profileLibTblExamRef'));
    }

    public function restore($code)
    {
        $profileLibTblExamRef =  ProfileLibTblExamRef::onlyTrashed()->find($code);
        $profileLibTblExamRef->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }

    public function forceDelete($code)
    {
        $profileLibTblExamRef =  ProfileLibTblExamRef::onlyTrashed()->find($code);
        $profileLibTblExamRef->forceDelete();

        return back()->with('info', 'Data Permanently Deleted');
    }
}
