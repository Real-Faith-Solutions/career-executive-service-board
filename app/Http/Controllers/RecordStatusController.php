<?php

namespace App\Http\Controllers;

use App\Models\RecordStatus;
use Illuminate\Http\Request;

class RecordStatusController extends Controller
{
    public function index(){
        $datas = RecordStatus::paginate(15);
        return view('admin.201_library.record_status.index', compact('datas'));
    }

    public function create(){
        return view('admin.201_library.record_status.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required','string', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:gender_by_choices'],
        ]);
        RecordStatus::create($request->all());
        return redirect()->route('record-status.index')->with('message', 'The item has been successfully added!');
    }
    // ui for edit
    public function edit($ctrlno){
        $data = RecordStatus::withTrashed()->findOrFail($ctrlno);
        return view('admin.201_library.record_status.edit', compact('data'));
    }

    public function update(Request $request, $ctrlno){
        $request->validate([
            'name' => ['required', 'string', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:gender_by_choices'],
        ]);

        $data = RecordStatus::withTrashed()->findOrFail($ctrlno);
        $data->update($request->all());

        return redirect()->route('record-status.index')->with('message', 'The item has been successfully updated!');
    }

    // recently deleted
    public function recentlyDeleted(){
        $datas = RecordStatus::onlyTrashed()
        ->orderByDesc('deleted_at')
        ->paginate(15);
        return view('admin.201_library.record_status.recently_deleted', compact('datas'));
    }

    // restore
    public function restore($ctrlno){
        $data = RecordStatus::onlyTrashed()->findOrFail($ctrlno);
        $data->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    // soft delete
    public function destroy($ctrlno){
        $data = RecordStatus::findOrFail($ctrlno);
        $data->delete();

        return redirect()->route('record-status.index')->with('message', 'The item has been successfully deleted!');
    }

    // force delete
    public function forceDelete($ctrlno){
        $data = RecordStatus::onlyTrashed()->findOrFail($ctrlno);
        $data->forceDelete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }
}
