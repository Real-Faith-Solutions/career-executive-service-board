<?php

namespace App\Http\Controllers;

use App\Models\GenderByBirth;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class LibraryController extends Controller
{
    public function genderByBirthTable(){
        $gender_by_birth = GenderByBirth::all();
        return view('admin.201_library.gender_by_birth.table', compact('gender_by_birth'));
    }
    public function genderByBirthForm(){
        return view('admin.201_library.gender_by_birth.form');
    }

    public function genderByBirthStore(Request $request){

        $request->validate([
            'name' => ['required','max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
        ]);
        GenderByBirth::create($request->all());

        return redirect()->route('library.gender_by_birth.table')->with('message', 'Gender by birth is successfully added');

    }


}
