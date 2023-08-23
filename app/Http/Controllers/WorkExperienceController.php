<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use App\Models\ProfileTblWorkExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class WorkExperienceController extends Controller
{
    public function index($cesno)
    {
        $personalData = PersonalData::find($cesno);
        $workExperience = $personalData->workExperience;

        return view('admin.201_profiling.view_profile.partials.work_experience.table', compact('workExperience' ,'cesno'));
    }

    public function create($cesno)
    {
        return view('admin.201_profiling.view_profile.partials.work_experience.form', compact('cesno'));
    }
    
    public function store(Request $request, $cesno)
    {
        $request->validate([

            'inclusive_date_from' => ['required'],
            'inclusive_date_to' => ['required'],
            'designation' => ['required', 'min:2', 'max:40', Rule::unique('profile_tblWorkExperience')->where('personal_data_cesno', $cesno)],
            'status_of_appointment' => ['required'],
            'annually_salary' => ['required'],
            'salary' => ['required'],
            'department_or_agency' => ['required'],
            'government_service' => ['required'],
            'remarks' => ['regex:/^[a-zA-Z ]*$/'],

        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName(); 

        $workExperience = new ProfileTblWorkExperience([

            'from_dt' => $request->inclusive_date_from,
            'to_dt' => $request->inclusive_date_to,
            'designation' => $request->designation,
            'status' => $request->status_of_appointment,
            'annually_salary' => $request->annually_salary,
            'salary' => $request->salary,
            'department' => $request->department_or_agency,
            'government_service' => $request->government_service,
            'remarks' => $request->remarks,
            'encoder' => $encoder,
         
        ]);

        $workExperiencePersonalDataId = PersonalData::find($cesno);

        $workExperiencePersonalDataId->workExperience()->save($workExperience);
            
        return to_route('work-experience.index', ['cesno'=>$cesno])->with('message', 'Successfuly Saved');
    }

    public function edit($ctrlno, $cesno)
    {
        $workExperience = ProfileTblWorkExperience::find($ctrlno);

        return view('admin.201_profiling.view_profile.partials.work_experience.edit', compact('workExperience' ,'cesno'));
    }

    public function update(Request $request, $ctrlno, $cesno)
    {
        $request->validate([

            'inclusive_date_from' => ['required'],
            'inclusive_date_to' => ['required'],
            'designation' => ['required', 'min:2', 'max:40', Rule::unique('profile_tblWorkExperience')->where('personal_data_cesno', $cesno)->ignore($ctrlno, 'ctrlno')],
            'status_of_appointment' => ['required'],
            'annually_salary' => ['required'],
            'salary' => ['required'],
            'department_or_agency' => ['required'],
            'government_service' => ['required'],
            'remarks' => ['regex:/^[a-zA-Z ]*$/'],

        ]);

        $workExperience = ProfileTblWorkExperience::find($ctrlno);
        $workExperience->from_dt = $request->inclusive_date_from;
        $workExperience->to_dt = $request->inclusive_date_to;
        $workExperience->status = $request->status_of_appointment;
        $workExperience->designation = $request->designation;
        $workExperience->annually_salary = $request->annually_salary;
        $workExperience->salary = $request->salary;
        $workExperience->department = $request->department_or_agency;
        $workExperience->government_service = $request->government_service;
        $workExperience->remarks = $request->remarks;
        $workExperience->save();

        return to_route('work-experience.index', ['cesno'=>$cesno])->with('message', 'Updated Sucessfully');
    }

    public function destroy($ctrlno)
    {
        $workExperience = ProfileTblWorkExperience::find($ctrlno);
        $workExperience->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');
    }

    public function recycleBin($cesno)
    {
        //parent model
        $personalData = PersonalData::withTrashed()->find($cesno);

        // Access the soft deleted scholarships of the parent model
        $workExperienceTrashedRecord = $personalData->workExperience()->onlyTrashed()->get();
 
        return view('admin.201_profiling.view_profile.partials.work_experience.trashbin', compact('workExperienceTrashedRecord', 'cesno'));
    }

    public function restore($ctrlno)
    {
        $workExperience = ProfileTblWorkExperience::withTrashed()->find($ctrlno);
        $workExperience->restore();

        return back()->with('message', 'Data Restored Sucessfully');
    }

    public function forceDelete($ctrlno)
    {
        $workExperience = ProfileTblWorkExperience::withTrashed()->find($ctrlno);
        $workExperience->forceDelete();

        return back()->with('message', 'Data Permanently Deleted');
    }
}
