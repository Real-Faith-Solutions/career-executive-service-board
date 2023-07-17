<?php

namespace App\Http\Controllers;

use App\Models\Title;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    public function index(){
        $datas = Title::paginate(10);
        return view('admin.201_library.title.index', compact('datas'));
    }

    public function create(){
        return view('admin.201_library.title.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required','string', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:gender_by_choices'],
        ]);
        Title::create($request->all());
        return redirect()->route('title.index')->with('message', 'The item has been successfully added!');
    }
    // ui for edit
    public function edit($ctrlno){
        $data = Title::withTrashed()->findOrFail($ctrlno);
        return view('admin.201_library.title.edit', compact('data'));
    }

    public function update(Request $request, $ctrlno){
        $request->validate([
            'name' => ['required', 'string', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:gender_by_choices'],
        ]);

        $data = Title::withTrashed()->findOrFail($ctrlno);
        $data->update($request->all());

        return redirect()->route('title.index')->with('message', 'The item has been successfully updated!');
    }

    // recently deleted
    public function recentlyDeleted(){
        $datas = Title::onlyTrashed()
        ->orderByDesc('deleted_at')
        ->paginate(10);
        return view('admin.201_library.title.recently_deleted', compact('datas'));
    }

    // restore
    public function restore($ctrlno){
        $data = Title::onlyTrashed()->findOrFail($ctrlno);
        $data->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    // soft delete
    public function destroy($ctrlno){
        $data = Title::findOrFail($ctrlno);
        $data->delete();

        return redirect()->route('title.index')->with('message', 'The item has been successfully deleted!');
    }

    // force delete
    public function forceDelete($ctrlno){
        $data = Title::onlyTrashed()->findOrFail($ctrlno);
        $data->forceDelete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }
}
