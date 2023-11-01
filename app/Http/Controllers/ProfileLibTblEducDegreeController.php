<?php

namespace App\Http\Controllers;

use App\Models\EducationalAttainment;
use App\Models\ProfileLibTblEducDegree;
use Illuminate\Http\Request;

class ProfileLibTblEducDegreeController extends Controller
{
    public function index()
    {
        $datas = ProfileLibTblEducDegree::query()
        ->orderBy('DEGREE' , 'ASC')
        ->paginate(25);

        return view('admin.201_library.educational_degree.index', compact('datas'));
    }

    public function create()
    {
        return view('admin.201_library.educational_degree.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'DEGREE' => ['required','string', 'max:100', 'min:2', 'unique:profilelib_tblEducDegree'],
        ]);

        ProfileLibTblEducDegree::create($request->all());

        return redirect()->route('educational-degree.index')->with('message', 'The item has been successfully added!');
    }

    // ui for edit
    public function edit($CODE)
    {
        $data = ProfileLibTblEducDegree::withTrashed()->findOrFail($CODE);

        return view('admin.201_library.educational_degree.edit', compact('data'));
    }

    public function update(Request $request, $CODE)
    {
        $request->validate([
            'DEGREE' => ['required', 'string', 'max:100', 'min:2', 'unique:profilelib_tblEducDegree'],
        ]);

        $data = ProfileLibTblEducDegree::withTrashed()->findOrFail($CODE);
        $data->update($request->all());

        return redirect()->route('educational-degree.index')->with('message', 'The item has been successfully updated!');
    }

    // soft delete
    public function destroy($CODE)
    {
        $codeExist = EducationalAttainment::withTrashed()->where('degree_code', $CODE)->exists();
        
        if($codeExist)
        {
            return redirect()->back()->with('error', 'The Degree Course already has user, so it cannot be deleted !!');
        }
        else
        {
            $data = ProfileLibTblEducDegree::findOrFail($CODE);
            $data->delete();
        }
        
        return redirect()->route('educational-degree.index')->with('message', 'The item has been successfully deleted!');
    }

    // recently deleted
    public function recentlyDeleted()
    {
        $datas = ProfileLibTblEducDegree::onlyTrashed()
        ->orderByDesc('deleted_at')
        ->paginate(15);

        return view('admin.201_library.educational_degree.recently_deleted', compact('datas'));
    }

    // restore
    public function restore($CODE)
    {
        $data = ProfileLibTblEducDegree::onlyTrashed()->findOrFail($CODE);
        $data->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    // force delete
    public function forceDelete($CODE)
    {
        $data = ProfileLibTblEducDegree::onlyTrashed()->findOrFail($CODE);
        $data->forceDelete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }
}
