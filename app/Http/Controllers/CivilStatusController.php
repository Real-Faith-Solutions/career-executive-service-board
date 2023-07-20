<?php

namespace App\Http\Controllers;

use App\Models\CivilStatus;
use Illuminate\Http\Request;

class CivilStatusController extends Controller
{
    public function index(){
        $datas = CivilStatus::paginate(15);
        return view('admin.201_library.civil_status.index', compact('datas'));
    }

    public function create(){
        return view('admin.201_library.civil_status.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required','string', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:civil_statuses'],
        ]);
        CivilStatus::create($request->all());
        return redirect()->route('civil-status.index')->with('message', 'The item has been successfully added!');
    }

    // ui for edit
    public function edit($ctrlno){
        $data = CivilStatus::withTrashed()->findOrFail($ctrlno);
        return view('admin.201_library.civil_status.edit', compact('data'));
    }

    public function update(Request $request, $ctrlno){
        $request->validate([
            'name' => ['required', 'string', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:civil_statuses'],
        ]);

        $data = CivilStatus::withTrashed()->findOrFail($ctrlno);
        $data->update($request->all());

        return redirect()->route('civil-status.index')->with('message', 'The item has been successfully updated!');
    }

    // recently deleted
    public function recentlyDeleted(){
        $datas = CivilStatus::onlyTrashed()
        ->orderByDesc('deleted_at')
        ->paginate(15);
        return view('admin.201_library.civil_status.recently_deleted', compact('datas'));
    }

    // restore
    public function restore($ctrlno){
        $data = CivilStatus::onlyTrashed()->findOrFail($ctrlno);
        $data->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    // soft delete
    public function destroy($ctrlno){
        $data = CivilStatus::findOrFail($ctrlno);
        $data->delete();

        return redirect()->route('civil-status.index')->with('message', 'The item has been successfully deleted!');
    }

    // force delete
    public function forceDelete($ctrlno){
        $data = CivilStatus::onlyTrashed()->findOrFail($ctrlno);
        $data->forceDelete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }
}
