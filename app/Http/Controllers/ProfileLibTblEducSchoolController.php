<?php

namespace App\Http\Controllers;

use App\Models\ProfileLibTblEducSchool;
use Illuminate\Http\Request;

class ProfileLibTblEducSchoolController extends Controller
{
    public function index(){
        $datas = ProfileLibTblEducSchool::query()
        ->orderBy('SCHOOL' , 'ASC')
        ->paginate(15);
        return view('admin.201_library.educational_schools.index', compact('datas'));
    }

    public function create(){
        return view('admin.201_library.educational_schools.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required','string', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:gender_by_choices'],
        ]);
        ProfileLibTblEducSchool::create($request->all());
        return redirect()->route('educational-shools.index')->with('message', 'The item has been successfully added!');
    }
    // ui for edit
    public function edit($CODE){
        $data = ProfileLibTblEducSchool::withTrashed()->findOrFail($CODE);
        return view('admin.201_library.educational_schools.edit', compact('data'));
    }

    public function update(Request $request, $CODE){
        $request->validate([
            'name' => ['required', 'string', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:gender_by_choices'],
        ]);

        $data = ProfileLibTblEducSchool::withTrashed()->findOrFail($CODE);
        $data->update($request->all());

        return redirect()->route('educational-schools.index')->with('message', 'The item has been successfully updated!');
    }

    // recently deleted
    public function recentlyDeleted(){
        $datas = ProfileLibTblEducSchool::onlyTrashed()
        ->orderByDesc('deleted_at')
        ->paginate(15);
        return view('admin.201_library.educational_schools.recently_deleted', compact('datas'));
    }

    // restore
    public function restore($CODE){
        $data = ProfileLibTblEducSchool::onlyTrashed()->findOrFail($CODE);
        $data->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    // soft delete
    public function destroy($CODE){
        $data = ProfileLibTblEducSchool::findOrFail($CODE);
        $data->delete();

        return redirect()->route('educational-schools.index')->with('message', 'The item has been successfully deleted!');
    }

    // force delete
    public function forceDelete($CODE){
        $data = ProfileLibTblEducSchool::onlyTrashed()->findOrFail($CODE);
        $data->forceDelete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }
}
