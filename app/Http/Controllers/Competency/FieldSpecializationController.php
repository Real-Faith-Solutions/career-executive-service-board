<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\ProfileLibTblExpertiseGen;
use Illuminate\Http\Request;

class FieldSpecializationController extends Controller
{
    public function index()
    {
        $profileLibTblExpertiseGen = ProfileLibTblExpertiseGen::paginate(10);    

        return view('admin.competency.partials.training_type_library.expertise_specialization.table', compact('profileLibTblExpertiseGen'));
    }

    public function create()
    {
        return view('admin.competency.partials.training_type_library.expertise_specialization.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Title' => ['required','unique:profilelib_tblExpertiseGen,Title'],
        ]);

        ProfileLibTblExpertiseGen::create([
            'Title' => $request->Title,
        ]);

        return to_route('field-specialization.index')->with('message', 'Save Sucessfully');
    }
}
