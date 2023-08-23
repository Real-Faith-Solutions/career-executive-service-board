<?php

namespace App\Http\Controllers;

use App\Models\ProfileLibTblEducDegree;
use Illuminate\Http\Request;

class ProfileLibTblEducDegreeController extends Controller
{
    public function index()
    {
        $datas = ProfileLibTblEducDegree::query()
        ->orderBy('DEGREE' , 'ASC')
        ->paginate(15);

        return view('admin.201_library.educational_degree.index', compact('datas'));
    }

    public function create()
    {
        return view('admin.201_library.educational_degree.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'DEGREE' => ['required','string', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:profilelib_tblEducDegree'],
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
            'DEGREE' => ['required', 'string', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:profilelib_tblEducDegree'],
        ]);

        $data = ProfileLibTblEducDegree::withTrashed()->findOrFail($CODE);
        $data->update($request->all());

        return redirect()->route('educational-degree.index')->with('message', 'The item has been successfully updated!');
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

    // soft delete
    public function destroy($CODE)
    {
        $data = ProfileLibTblEducDegree::findOrFail($CODE);
        $data->delete();

        return redirect()->route('educational-degree.index')->with('message', 'The item has been successfully deleted!');
    }

    // force delete
    public function forceDelete($CODE)
    {
        $data = ProfileLibTblEducDegree::onlyTrashed()->findOrFail($CODE);
        $data->forceDelete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }
}
