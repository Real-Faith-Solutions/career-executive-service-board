<?php

namespace App\Http\Controllers;

use App\Models\GenderByChoice;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class GenderByChoiceController extends Controller
{

    public function index(){
        $datas = GenderByChoice::paginate(10);
        return view('admin.201_library.gender_by_choice.index', compact('datas'));
    }

    public function create(){
        return view('admin.201_library.gender_by_choice.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required','max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:gender_by_choices'],
        ]);
        GenderByChoice::create($request->all());
        return redirect()->route('gender-by-choice.index')->with('message', 'Gender by birth is successfully added');
    }
    // gender-by-choice.edit
    public function edit($ctrlno){
        $data = GenderByChoice::withTrashed()->findOrFail($ctrlno);
        return view('admin.201_library.gender_by_choice.edit', compact('data'));
    }

    public function update(Request $request, $ctrlno){
        $request->validate([
            'name' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
        ]);

        $data = GenderByChoice::withTrashed()->findOrFail($ctrlno);
        $data->update($request->all());

        return redirect()->route('gender-by-choice.index')->with('message', 'Gender by birth is successfully updated');
    }

    // soft delete
    public function destroy($ctrlno){
        $data = GenderByChoice::findOrFail($ctrlno);
        $data->delete();

        return redirect()->route('gender-by-choice.index')->with('message', 'Gender by birth is soft deleted');
    }

    // recently deleted
    public function recentlyDeleted(){
        $datas = GenderByChoice::withTrashed()
        ->orderByDesc('deleted_at')
        ->paginate(10);
        return view('admin.201_library.gender_by_choice.recently_deleted', compact('datas'));
    }

    // hard delete


}
