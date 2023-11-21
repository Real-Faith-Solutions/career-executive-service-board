<?php

namespace App\Http\Controllers;

use App\Models\GenderByBirth;
use Illuminate\Http\Request;

class GenderByBirthController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkPermission:plantilla_view_library')->only('index');
 
        $this->middleware('checkPermission:plantilla_add_library')->only(['store', 'create']);
 
        $this->middleware('checkPermission:plantilla_edit_library')->only(['edit', 'update']);

        $this->middleware('checkPermission:plantilla_delete_library')->only(['recentlyDeleted', 'restore', 'destroy', 'forceDelete']);
    }

    public function index(){
        $datas = GenderByBirth::paginate(15);
        return view('admin.201_library.gender_by_birth.index', compact('datas'));
    }

    public function create(){
        return view('admin.201_library.gender_by_birth.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required','string', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:gender_by_births'],
        ]);
        GenderByBirth::create($request->all());
        return redirect()->route('gender-by-birth.index')->with('message', 'The item has been successfully added!');
    }

    // ui for edit
    public function edit($ctrlno){
        $data = GenderByBirth::withTrashed()->findOrFail($ctrlno);
        return view('admin.201_library.gender_by_birth.edit', compact('data'));
    }

    public function update(Request $request, $ctrlno){
        $request->validate([
            'name' => ['required', 'string', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:gender_by_births'],
        ]);

        $data = GenderByBirth::withTrashed()->findOrFail($ctrlno);
        $data->update($request->all());

        return redirect()->route('gender-by-birth.index')->with('message', 'The item has been successfully updated!');
    }

    // recently deleted
    public function recentlyDeleted(){
        $datas = GenderByBirth::onlyTrashed()
        ->orderByDesc('deleted_at')
        ->paginate(15);
        return view('admin.201_library.gender_by_birth.recently_deleted', compact('datas'));
    }

    // restore
    public function restore($ctrlno){
        $data = GenderByBirth::onlyTrashed()->findOrFail($ctrlno);
        $data->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    // soft delete
    public function destroy($ctrlno){
        $data = GenderByBirth::findOrFail($ctrlno);
        $data->delete();

        return redirect()->route('gender-by-birth.index')->with('message', 'The item has been successfully deleted!');
    }

    // force delete
    public function forceDelete($ctrlno){
        $data = GenderByBirth::onlyTrashed()->findOrFail($ctrlno);
        $data->forceDelete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }
}
