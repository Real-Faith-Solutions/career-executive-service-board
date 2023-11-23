<?php

namespace App\Http\Controllers;

use App\Models\EducationalAttainment;
use App\Models\ProfileLibTblEducSchool;
use Illuminate\Http\Request;

class ProfileLibTblEducSchoolController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkPermission:201_view_library')->only('index');
 
        $this->middleware('checkPermission:201_add_library')->only(['store', 'create']);
 
        $this->middleware('checkPermission:201_edit_library')->only(['edit', 'update']);

        $this->middleware('checkPermission:201_delete_library')->only(['recentlyDeleted', 'restore', 'destroy', 'forceDelete']);
    }

    public function index()
    {
        $datas = ProfileLibTblEducSchool::query()
        ->orderBy('SCHOOL' , 'ASC')
        ->paginate(25);

        return view('admin.201_library.educational_schools.index', compact('datas'));
    }

    public function create()
    {
        return view('admin.201_library.educational_schools.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'SCHOOL' => ['required','string', 'max:100', 'min:2', 'unique:profilelib_tblEducSchools'],
        ]);

        ProfileLibTblEducSchool::create($request->all());

        return redirect()->route('educational-schools.index')->with('message', 'The item has been successfully added!');
    }

    // ui for edit
    public function edit($CODE)
    {
        $data = ProfileLibTblEducSchool::withTrashed()->findOrFail($CODE);

        return view('admin.201_library.educational_schools.edit', compact('data'));
    }

    public function update(Request $request, $CODE)
    {
        $request->validate([
            'SCHOOL' => ['required', 'string', 'max:100', 'min:2', 'unique:profilelib_tblEducSchools'],
        ]);

        $data = ProfileLibTblEducSchool::withTrashed()->findOrFail($CODE);
        $data->update($request->all());

        return redirect()->route('educational-schools.index')->with('message', 'The item has been successfully updated!');
    }

    // soft delete
    public function destroy($CODE)
    {
        $codeExist = EducationalAttainment::withTrashed()->where('school_code', $CODE)->exists();
        
        if($codeExist)
        {
            return redirect()->back()->with('error', 'The School already has user, so it cannot be deleted !!');
        }
        else
        {
            $data = ProfileLibTblEducSchool::findOrFail($CODE);
            $data->delete();
        }
        
        return redirect()->route('educational-schools.index')->with('message', 'The item has been successfully deleted!');
    }

    // recently deleted
    public function recentlyDeleted()
    {
        $datas = ProfileLibTblEducSchool::onlyTrashed()
        ->orderByDesc('deleted_at')
        ->paginate(15);

        return view('admin.201_library.educational_schools.recently_deleted', compact('datas'));
    }

    // restore
    public function restore($CODE)
    {
        $data = ProfileLibTblEducSchool::onlyTrashed()->findOrFail($CODE);
        $data->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    // force delete
    public function forceDelete($CODE)
    {
        $data = ProfileLibTblEducSchool::onlyTrashed()->findOrFail($CODE);
        $data->forceDelete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }
}
