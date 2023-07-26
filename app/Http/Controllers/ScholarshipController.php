<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScholarshipStoreRequest;
use App\Models\PersonalData;
use App\Models\Scholarships;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScholarshipController extends Controller
{

    public function store(ScholarshipStoreRequest $request, $cesno){

        $userLastName = Auth::user()->last_name;
        $userFirstName = Auth::user()->first_name;
        $userMiddleName = Auth::user()->middle_name; 
        $userNameExtension = Auth::user()->name_extension;

        $scholarship = new Scholarships([

            'type' => $request->type,
            'title' => $request->title,
            'sponsor' => $request->sponsor,
            'inclusive_date_from' => $request->inclusive_date_from,
            'inclusive_date_to' => $request->inclusive_date_to,
            'encoder' => $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension,
         
        ]);

        //finding if title is already exist
        if(Scholarships::where('personal_data_cesno', $cesno)->where('title', $request->title)->exists()){
            
            return back()->with('error', 'Already Have Title Detail');

        }
        //end

        $scholarshipPersonalDataId = PersonalData::find($cesno);

        $scholarshipPersonalDataId->scholarships()->save($scholarship);

        return redirect()->back()->with('message', 'Successfuly Saved');

    }

    public function edit($ctrlno){

        $scholarship = Scholarships::find($ctrlno);
        return view('admin.201_profiling.view_profile.partials.scholarships.edit', ['scholarship'=>$scholarship]);

    }

    public function update(ScholarshipStoreRequest $request, $ctrlno){

        $scholarship= Scholarships::find($ctrlno);
        $scholarship->type = $request->type;
        $scholarship->title = $request->title;
        $scholarship->sponsor = $request->sponsor;
        $scholarship->inclusive_date_from = $request->inclusive_date_from;
        $scholarship->inclusive_date_to = $request->inclusive_date_to;
        $scholarship->save();

        return back()->with('message', 'Updated Sucessfully');

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
 
        return view('admin.201_profiling.view_profile.partials.scholarships.trashbin', compact('scholarshipTrashedRecord'));

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
