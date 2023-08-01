<?php

namespace App\Http\Controllers;

use App\Models\OtherManagementTrainings;
use App\Models\PersonalData;
use App\Models\ProfileLibTblExpertiseSpec;
use App\Models\ProfileTblTrainingMngt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class OtherTrainingController extends Controller
{
    
    public function store(Request $request, $cesno){

        $request->validate([ 

            'training' => ['required', Rule::unique('profile_tblTrainingMngt')->where('personal_data_cesno', $cesno)],
            'training_category' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'sponsor_training_provider' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'venue' => ['required', 'min:2', 'max:40'],
            'no_of_training_hours' => ['required', 'numeric'],
            'inclusive_date_from' => ['required'],
            'inclusive_date_to' => ['required'],
            'expertise_field_of_specialization' => ['required'],
            
        ]);

        $userFullName = Auth::user();
        $userLastName = $userFullName ->last_name;
        $userFirstName = $userFullName ->first_name;
        $userMiddleName = $userFullName ->middle_name;
        $userNameExtension = $userFullName ->name_extension;

        $otherTraining = new ProfileTblTrainingMngt([

            'training' => $request->training,
            'training_category' => $request->training_category,
            'sponsor' => $request->sponsor_training_provider,
            'venue' => $request->venue,
            'no_training_hours' => $request->no_of_training_hours,
            'from_date' => $request->inclusive_date_from,
            'to_date' => $request->inclusive_date_to,
            'field_specialization' => $request->expertise_field_of_specialization,
            'encoder' => $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension,
         
        ]);

        $otherTrainingPersonalDataId = PersonalData::find($cesno);

        $otherTrainingPersonalDataId->otherTraining()->save($otherTraining);
            
        return redirect()->back()->with('message', 'Successfuly Saved');

    }

    public function edit($ctrlno){

        $otherManagementTraining = ProfileTblTrainingMngt::find($ctrlno);
        $profileLibTblExpertiseSpec = ProfileLibTblExpertiseSpec::all();

        return view('admin.201_profiling.view_profile.partials.other_management_trainings.edit',
        ['otherManagementTraining'=>$otherManagementTraining, 'profileLibTblExpertiseSpec'=>$profileLibTblExpertiseSpec]);

    }

    public function update(Request $request, $ctrlno){

        $request->validate([ 

            'training' => ['required'],
            'training_category' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'sponsor_training_provider' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'venue' => ['required', 'min:2', 'max:40'],
            'no_of_training_hours' => ['required', 'numeric'],
            'inclusive_date_from' => ['required'],
            'inclusive_date_to' => ['required'],
            'expertise_field_of_specialization' => ['required'],
            
        ]);

        $trainingManagement = ProfileTblTrainingMngt::find($ctrlno);
        $trainingManagement->training = $request->training;
        $trainingManagement->training_category = $request->training_category;
        $trainingManagement->sponsor = $request->sponsor_training_provider;
        $trainingManagement->venue = $request->venue;
        $trainingManagement->no_training_hours = $request->no_of_training_hours;
        $trainingManagement->from_date = $request->inclusive_date_from;
        $trainingManagement->to_date = $request->inclusive_date_to;
        $trainingManagement->field_specialization = $request->expertise_field_of_specialization;
        $trainingManagement->save();

        return back()->with('message', 'Updated Sucessfully');

    }

    public function destroy($ctrlno){
        
        $otherTraining = ProfileTblTrainingMngt::find($ctrlno);
        $otherTraining->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

        // $spouse->restore(); -> to restore soft deleted data

    }

}
