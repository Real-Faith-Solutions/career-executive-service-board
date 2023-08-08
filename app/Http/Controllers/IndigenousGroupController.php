<?php

namespace App\Http\Controllers;

use App\Models\IndigenousGroup;
use Illuminate\Http\Request;

class IndigenousGroupController extends Controller
{
    public function index(){
        $datas = IndigenousGroup::paginate(15);
        return view('admin.201_library.indigeneous_group.index', compact('datas'));
    }
    public function create(){
        return view('admin.201_library.indigeneous_group.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required','string', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:indigenous_groups'],
        ]);
        IndigenousGroup::create($request->all());
        return redirect()->route('indigeneous-group.index')->with('message', 'The item has been successfully added!');
    }
    // ui for edit
    public function edit($ctrlno){
        $data = IndigenousGroup::withTrashed()->findOrFail($ctrlno);
        return view('admin.201_library.indigeneous_group.edit', compact('data'));
    }

    public function update(Request $request, $ctrlno){
        $request->validate([
            'name' => ['required', 'string', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:indigenous_groups'],
        ]);

        $data = IndigenousGroup::withTrashed()->findOrFail($ctrlno);
        $data->update($request->all());

        return redirect()->route('indigeneous-group.index')->with('message', 'The item has been successfully updated!');
    }

    // recently deleted
    public function recentlyDeleted(){
        $datas = IndigenousGroup::onlyTrashed()
        ->orderByDesc('deleted_at')
        ->paginate(15);
        return view('admin.201_library.indigeneous_group.recently_deleted', compact('datas'));
    }

    // restore
    public function restore($ctrlno){
        $data = IndigenousGroup::onlyTrashed()->findOrFail($ctrlno);
        $data->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    // soft delete
    public function destroy($ctrlno){
        $data = IndigenousGroup::findOrFail($ctrlno);
        $data->delete();

        return redirect()->route('indigeneous-group.index')->with('message', 'The item has been successfully deleted!');
    }

    // force delete
    public function forceDelete($ctrlno){
        $data = IndigenousGroup::onlyTrashed()->findOrFail($ctrlno);
        $data->forceDelete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }
}
