<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\ProfileLibTblExpertiseGen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class FieldSpecializationController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->input('sortBy', 'GenExp_Code'); // Default sorting GenExp_Code.
        $sortOrder = $request->input('sortOrder', 'desc'); // Default sorting order

        $profileLibTblExpertiseGen = ProfileLibTblExpertiseGen::orderBy($sortBy, $sortOrder)->paginate(25);    

        return view('admin.competency.partials.training_type_library.expertise_specialization.table', compact('profileLibTblExpertiseGen', 'sortBy', 'sortOrder'));
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

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        ProfileLibTblExpertiseGen::create([
            'Title' => $request->Title,
            'encoder' => $encoder,
        ]);

        return to_route('field-specialization.index')->with('message', 'Save Sucessfully');
    }

    public function edit($ctrlno)
    {
        $profileLibTblExpertiseGen = ProfileLibTblExpertiseGen::find($ctrlno);    

        return view('admin.competency.partials.training_type_library.expertise_specialization.edit', compact('profileLibTblExpertiseGen'));
    }

    public function update(Request $request, $ctrlno)
    {
        $request->validate([
            'Title' => ['required', Rule::unique('profilelib_tblExpertiseGen')->ignore($ctrlno, 'GenExp_Code')],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();
        
        $profileLibTblExpertiseGen = ProfileLibTblExpertiseGen::find($ctrlno);
        $profileLibTblExpertiseGen->Title = $request->Title;
        $profileLibTblExpertiseGen->updated_by = $encoder;
        $profileLibTblExpertiseGen->save();

        return to_route('field-specialization.index')->with('info', 'Data Update Sucessfully');
    }

    public function destroy($ctrlno)
    {
        $profileLibTblExpertiseGen = ProfileLibTblExpertiseGen::find($ctrlno);
        $profileLibTblExpertiseGen->delete();

        return back()->with('message', 'Deleted Sucessfully');
    }

    public function recentlyDeleted()
    {
        $profileLibTblExpertiseGenTrashedRecord = ProfileLibTblExpertiseGen::onlyTrashed()->paginate(20);

        return view('admin.competency.partials.training_type_library.expertise_specialization.trashbin', compact('profileLibTblExpertiseGenTrashedRecord'));
    }

    public function restore($ctrlno)
    {
        $profileLibTblExpertiseGen = ProfileLibTblExpertiseGen::onlyTrashed()->find($ctrlno);
        $profileLibTblExpertiseGen->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }
 
    public function forceDelete($ctrlno)
    {
        $profileLibTblExpertiseGen = ProfileLibTblExpertiseGen::onlyTrashed()->find($ctrlno);
        $profileLibTblExpertiseGen->forceDelete();
  
        return back()->with('info', 'Data Permanently Deleted');
    }
}
