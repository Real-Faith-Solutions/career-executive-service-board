<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use App\Models\ProfileTblWorkExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class WorkExperienceController extends Controller
{
    
    public function store(Request $request, $cesno){

        $request->validate([

            'inclusive_date_from' => ['required'],
            'inclusive_date_to' => ['required'],
            'designation' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/', Rule::unique('profile_tblWorkExperience')->where('personal_data_cesno', $cesno)],
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
            'designation' => $request->designation,
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

    public function edit($ctrlno){

        $workExperience = ProfileTblWorkExperience::find($ctrlno);
        return view('admin.201_profiling.view_profile.partials.work_experience.edit', ['workExperience'=>$workExperience]);

    }

    public function update(Request $request, $ctrlno){

        $workExperienceId = ProfileTblWorkExperience::find($ctrlno);

        $request->validate([

            'inclusive_date_from' => ['required'],
            'inclusive_date_to' => ['required'],
            'designation' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/', Rule::unique('profile_tblWorkExperience', 'designation')->ignore($workExperienceId)],
            'status_of_appointment' => ['required'],
            'monthly_salary' => ['required'],
            'salary' => ['required'],
            'department_or_agency' => ['required'],
            'government_service' => ['required'],
            'remarks' => ['required', 'regex:/^[a-zA-Z ]*$/'],

        ]);

        $workExperience = ProfileTblWorkExperience::find($ctrlno);
        $workExperience->from_dt = $request->inclusive_date_from;
        $workExperience->to_dt = $request->inclusive_date_to;
        $workExperience->status = $request->status_of_appointment;
        $workExperience->designation = $request->designation;
        $workExperience->monthly_salary = $request->monthly_salary;
        $workExperience->salary = $request->salary;
        $workExperience->department = $request->department_or_agency;
        $workExperience->government_service = $request->government_service;
        $workExperience->remarks = $request->remarks;
        $workExperience->save();

        return back()->with('message', 'Updated Sucessfully');

    }

    public function destroy($ctrlno){
        
        $workExperience = ProfileTblWorkExperience::find($ctrlno);
        $workExperience->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

        // $spouse->restore(); -> to restore soft deleted data

    }

}
