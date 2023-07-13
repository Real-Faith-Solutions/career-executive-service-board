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
            'name' => ['required','max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
        ]);
        GenderByChoice::create($request->all());
        return redirect()->route('gender-by-choice.index')->with('message', 'Gender by birth is successfully added');
    }

    public function edit($ctrlno){

        $data = GenderByChoice::findorFail($ctrlno);
        return view('admin.201_library.gender_by_choice.edit', compact('data'));

    }

}
