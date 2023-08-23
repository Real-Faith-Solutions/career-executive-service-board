<?php

namespace App\Http\Controllers;

use App\Models\Religion;
use Illuminate\Http\Request;

class ReligionController extends Controller
{
    public function index()
    {
        $datas = Religion::paginate(15);

        return view('admin.201_library.religion.index', compact('datas'));
    }

    public function create()
    {
        return view('admin.201_library.religion.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:religions'],
        ]);

        Religion::create($request->all());

        return redirect()->route('religion.index')->with('message', 'The item has been successfully added!');
    }

    // ui for edit
    public function edit($ctrlno)
    {
        $data = Religion::withTrashed()->findOrFail($ctrlno);
        
        return view('admin.201_library.religion.edit', compact('data'));
    }

    public function update(Request $request, $ctrlno)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:religions'],
        ]);

        $data = Religion::withTrashed()->findOrFail($ctrlno);
        $data->update($request->all());

        return redirect()->route('religion.index')->with('message', 'The item has been successfully updated!');
    }

    // recently deleted
    public function recentlyDeleted()
    {
        $datas = Religion::onlyTrashed()
        ->orderByDesc('deleted_at')
        ->paginate(15);

        return view('admin.201_library.religion.recently_deleted', compact('datas'));
    }

    // restore
    public function restore($ctrlno)
    {
        $data = Religion::onlyTrashed()->findOrFail($ctrlno);
        $data->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    // soft delete
    public function destroy($ctrlno)
    {
        $data = Religion::findOrFail($ctrlno);
        $data->delete();

        return redirect()->route('religion.index')->with('message', 'The item has been successfully deleted!');
    }

    // force delete
    public function forceDelete($ctrlno)
    {
        $data = Religion::onlyTrashed()->findOrFail($ctrlno);
        $data->forceDelete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }
}
