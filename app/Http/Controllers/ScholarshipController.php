<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use App\Models\Scholarships;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class ScholarshipController extends Controller
{

    public function index($cesno){

        $personalData = PersonalData::find($cesno);
        $scholarship = $personalData->scholarships;

        return view('admin.201_profiling.view_profile.partials.scholarships.table', compact('scholarship' ,'cesno'));

    }

    public function create($cesno){

        return view('admin.201_profiling.view_profile.partials.scholarships.form', compact('cesno'));

    }

    public function store(Request $request, $cesno){

        $request->validate([

            'type' => ['required'],
            'title' => ['required', Rule::unique('profile_tblScholarship')->where('personal_data_cesno', $cesno), 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'sponsor' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'inclusive_date_from' => ['required'],
            'inclusive_date_to' => ['required'],
            
        ]);

        $userFullName = Auth::user();
        $userLastName = $userFullName ->last_name;
        $userFirstName = $userFullName ->first_name;
        $userMiddleName = $userFullName ->middle_name;
        $userNameExtension = $userFullName ->name_extension;

        $scholarship = new Scholarships([

            'type' => $request->type,
            'title' => $request->title,
            'sponsor' => $request->sponsor,
            'inclusive_date_from' => $request->inclusive_date_from,
            'inclusive_date_to' => $request->inclusive_date_to,
            'encoder' => $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension,
         
        ]);

        $scholarshipPersonalDataId = PersonalData::find($cesno);

        $scholarshipPersonalDataId->scholarships()->save($scholarship);

        return to_route('scholarship.index', ['cesno'=>$cesno])->with('message', 'Successfuly Saved');

    }

    public function edit($ctrlno, $cesno){

        $scholarship = Scholarships::find($ctrlno);
        return view('admin.201_profiling.view_profile.partials.scholarships.edit', compact('scholarship' ,'cesno'));

    }

    public function update(Request $request, $ctrlno, $cesno){

        $request->validate([

            'type' => ['required'],
            'title' => ['required', Rule::unique('profile_tblScholarship')->where('personal_data_cesno', $cesno)->ignore($ctrlno, 'ctrlno'), 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'sponsor' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'inclusive_date_from' => ['required'],
            'inclusive_date_to' => ['required'],
            
        ]);

        $scholarship= Scholarships::find($ctrlno);
        $scholarship->type = $request->type;
        $scholarship->title = $request->title;
        $scholarship->sponsor = $request->sponsor;
        $scholarship->inclusive_date_from = $request->inclusive_date_from;
        $scholarship->inclusive_date_to = $request->inclusive_date_to;
        $scholarship->save();

        return to_route('scholarship.index', ['cesno'=>$cesno])->with('message', 'Updated Sucessfully');

    }

    public function destroy($ctrlno){
        
        $scholarship = Scholarships::find($ctrlno);
        $scholarship->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

    }

    public function recycleBin($cesno){

        //parent model
        $personalData = PersonalData::withTrashed()->find($cesno);

        // Access the soft deleted scholarships of the parent model
        $scholarshipTrashedRecord = $personalData->scholarships()->onlyTrashed()->get();
 
        return view('admin.201_profiling.view_profile.partials.scholarships.trashbin', compact('scholarshipTrashedRecord', 'cesno'));

    }

    public function restore($ctrlno){

        $scholarship = Scholarships::withTrashed()->find($ctrlno);
        $scholarship->restore();

        return back()->with('message', 'Data Restored Sucessfully');

    }

    public function forceDelete($ctrlno){

        $Scholarships = Scholarships::withTrashed()->find($ctrlno);
        $Scholarships->forceDelete();

        return back()->with('message', 'Data Permanently Deleted');

    }
    
}
