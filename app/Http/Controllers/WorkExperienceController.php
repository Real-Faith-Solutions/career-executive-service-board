<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use App\Models\ProfileTblWorkExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkExperienceController extends Controller
{
    
    public function store(Request $request, $cesno){

        $request->validate([

            'inclusive_date_from' => ['required'],
            'inclusive_date_to' => ['required'],
            'position_or_title' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'status_of_appointment' => ['required'],
            'monthly_salary' => ['required'],
            'salary' => ['required'],
            'department_or_agency' => ['required'],
            'government_service' => ['required'],
            'remarks' => ['required', 'regex:/^[a-zA-Z ]*$/'],

        ]);

        $userLastName = Auth::user()->last_name;
        $userFirstName = Auth::user()->first_name;
        $userMiddleName = Auth::user()->middle_name; 
        $userNameExtension = Auth::user()->name_extension;

        $workExperience = new ProfileTblWorkExperience([

            'from_dt' => $request->inclusive_date_from,
            'to_dt' => $request->inclusive_date_to,
            'designation' => $request->position_or_title,
            'status' => $request->status_of_appointment,
            'monthly_salary' => $request->monthly_salary,
            'salary' => $request->salary,
            'department' => $request->department_or_agency,
            'government_service' => $request->government_service,
            'remarks' => $request->remarks,
            'encoder' => $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension,
         
        ]);

        $workExperiencePersonalDataId = PersonalData::find($cesno);

        $workExperiencePersonalDataId->workExperience()->save($workExperience);
            
        return redirect()->back()->with('message', 'Successfuly Saved');

    }

    public function destroy($ctrlno){
        
        $workExperience = ProfileTblWorkExperience::find($ctrlno);
        $workExperience->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

        // $spouse->restore(); -> to restore soft deleted data

    }

}
