<?php

namespace App\Http\Controllers;

use App\Models\ProfileLibTblEducMajor;
use Illuminate\Http\Request;

class ProfileLibTblEducMajorController extends Controller
{
    public function index()
    {
        $datas = ProfileLibTblEducMajor::orderBy('COURSE', 'ASC')
        ->paginate(15);

        return view('admin.201_library.educational_major.index', compact('datas'));
    }

    public function create()
    {
        return view('admin.201_library.educational_major.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'COURSE' => ['required','string', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:profilelib_tblEducMajor'],
        ]);

        ProfileLibTblEducMajor::create($request->all());

        return redirect()->route('educational-major.index')->with('message', 'The item has been successfully added!');
    }

    // ui for edit
    public function edit($CODE)
    {
        $data = ProfileLibTblEducMajor::withTrashed()->findOrFail($CODE);

        return view('admin.201_library.educational_major.edit', compact('data'));
    }

    public function update(Request $request, $CODE)
    {
        $request->validate([
            'COURSE' => ['required', 'string', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:profilelib_tblEducMajor'],
        ]);

        $data = ProfileLibTblEducMajor::withTrashed()->findOrFail($CODE);
        $data->update($request->all());

        return redirect()->route('educational-major.index')->with('message', 'The item has been successfully updated!');
    }

    // recently deleted
    public function recentlyDeleted()
    {
        $datas = ProfileLibTblEducMajor::onlyTrashed()
        ->orderByDesc('deleted_at')
        ->paginate(15);

        return view('admin.201_library.educational_major.recently_deleted', compact('datas'));
    }

    // restore
    public function restore($CODE)
    {
        $data = ProfileLibTblEducMajor::onlyTrashed()->findOrFail($CODE);
        $data->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    // soft delete
    public function destroy($CODE)
    {
        $data = ProfileLibTblEducMajor::findOrFail($CODE);
        $data->delete();

        return redirect()->route('educational-major.index')->with('message', 'The item has been successfully deleted!');
    }

    // force delete
    public function forceDelete($CODE)
    {
        $data = ProfileLibTblEducMajor::onlyTrashed()->findOrFail($CODE);
        $data->forceDelete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }
}
