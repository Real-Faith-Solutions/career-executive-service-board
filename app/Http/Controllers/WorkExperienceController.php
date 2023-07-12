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

            'from_dt' => ['required'],
            'to_dt' => ['required'],
            'designation' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'status' => ['required'],
            'monthly_salary' => ['required'],
            'salary' => ['required'],
            'department' => ['required'],
            'government_service' => ['required'],
            'remarks' => ['required', 'regex:/^[a-zA-Z ]*$/'],

        ]);

        $userLastName = Auth::user()->last_name;

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
            'encoder' => $userLastName,
         
        ]);

        $workExperiencePersonalDataId = PersonalData::find($cesno);

        $workExperiencePersonalDataId->workExperience()->save($workExperience);
            
        return redirect()->back();

    }

    public function destroy($ctrlno){
        
        $workExperience = ProfileTblWorkExperience::find($ctrlno);
        $workExperience->delete();

        return redirect()->back();

        // $spouse->restore(); -> to restore soft deleted data

    }

}
