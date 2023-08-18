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

    public function index($cesno){

        $personalData = PersonalData::find($cesno);
        $otherTraining = $personalData->otherTraining;
        $competencyNonCesAccreditedTraining = $personalData->competencyNonCesAccreditedTraining;

        return view('admin.201_profiling.view_profile.partials.other_management_trainings.table', compact('otherTraining' , 'cesno', 'competencyNonCesAccreditedTraining'));

    }

    public function create($cesno){

        $profileLibTblExpertiseSpec = ProfileLibTblExpertiseSpec::all();

        return view('admin.201_profiling.view_profile.partials.other_management_trainings.form', compact('profileLibTblExpertiseSpec' ,'cesno'));
        
    }
    
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
            
        return to_route('other-training.index', ['cesno'=>$cesno])->with('message', 'Successfuly Saved');

    }

    public function edit($ctrlno, $cesno){

        $otherManagementTraining = ProfileTblTrainingMngt::find($ctrlno);
        $profileLibTblExpertiseSpec = ProfileLibTblExpertiseSpec::all();

        return view('admin.201_profiling.view_profile.partials.other_management_trainings.edit', compact('otherManagementTraining' ,'profileLibTblExpertiseSpec' ,'cesno'));

    }

    public function update(Request $request, $ctrlno, $cesno){

        $request->validate([ 

            'training' => ['required', Rule::unique('profile_tblTrainingMngt')->where('personal_data_cesno', $cesno)->ignore($ctrlno, 'ctrlno')],
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

        return to_route('other-training.index', ['cesno'=>$cesno])->with('message', 'Updated Sucessfully');

    }

    public function destroy($ctrlno){
        
        $otherTraining = ProfileTblTrainingMngt::find($ctrlno);
        $otherTraining->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

    }

    public function recentlyDeleted($cesno){

        //parent model
        $personalData = PersonalData::withTrashed()->find($cesno);

        // Access the soft deleted scholarships of the parent model
        $otherTrainingTrashedRecord = $personalData->otherTraining()->onlyTrashed()->get();
 
        return view('admin.201_profiling.view_profile.partials.other_management_trainings.trashbin', compact('otherTrainingTrashedRecord', 'cesno'));

    }

    public function restore($ctrlno){

        $otherTraining = ProfileTblTrainingMngt::withTrashed()->find($ctrlno);
        $otherTraining->restore();

        return back()->with('message', 'Data Restored Sucessfully');

    }
 
    public function forceDelete($ctrlno){

        $otherTraining = ProfileTblTrainingMngt::withTrashed()->find($ctrlno);
        $otherTraining->forceDelete();
  
        return back()->with('message', 'Data Permanently Deleted');

    }

}
