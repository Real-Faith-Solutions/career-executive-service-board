<?php

namespace App\Http\Controllers;

use App\Models\CompetencyNonCesAccreditedTraining;
use App\Models\PersonalData;
use App\Models\ProfileLibTblExpertiseSpec;
use App\Models\ProfileTblTrainingMngt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class NonCesTrainingController extends Controller
{
    public function index($cesno)
    {
        $personalData = PersonalData::find($cesno);
        $otherTraining = $personalData->otherTraining;
        $competencyNonCesAccreditedTraining = $personalData->competencyNonCesAccreditedTraining;
    
        return view('admin.201_profiling.view_profile.partials.other_management_trainings.table', 
        compact('otherTraining' , 'cesno', 'competencyNonCesAccreditedTraining'));
    }

    public function create($cesno)
    {
        $profileLibTblExpertiseSpec = ProfileLibTblExpertiseSpec::all();

        return view('admin.201_profiling.view_profile.partials.other_management_trainings.form', compact('profileLibTblExpertiseSpec' ,'cesno'));
    }
    
    public function store(Request $request, $cesno)
    {
        $request->validate([ 

            'training' => ['required', Rule::unique('profile_tblTrainingMngt')->where('cesno', $cesno)],
            'training_category' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'sponsor_training_provider' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'venue' => ['required', 'min:2', 'max:40'],
            'no_of_training_hours' => ['required', 'numeric', 'digits_between:1,4'],
            'inclusive_date_from' => ['required'],
            'inclusive_date_to' => ['required'],
            'expertise_field_of_specialization' => ['required'],
            
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName(); 

        $otherTraining = new ProfileTblTrainingMngt([

            'training' => $request->training,
            'training_category' => $request->training_category,
            'sponsor' => $request->sponsor_training_provider,
            'venue' => $request->venue,
            'no_training_hours' => $request->no_of_training_hours,
            'from_dt' => $request->inclusive_date_from,
            'to_dt' => $request->inclusive_date_to,
            'field_specialization' => $request->expertise_field_of_specialization,
            'encoder' => $encoder,
         
        ]);

        $otherTrainingPersonalDataId = PersonalData::find($cesno);

        $otherTrainingPersonalDataId->otherTraining()->save($otherTraining);
            
        return to_route('other-training.index', ['cesno'=>$cesno])->with('message', 'Successfuly Saved');
    }

    public function edit($ctrlno, $cesno)
    {
        $otherManagementTraining = ProfileTblTrainingMngt::find($ctrlno);
        $profileLibTblExpertiseSpec = ProfileLibTblExpertiseSpec::all();

        return view('admin.201_profiling.view_profile.partials.other_management_trainings.edit', compact('otherManagementTraining' ,'profileLibTblExpertiseSpec' ,'cesno'));
    }

    public function update(Request $request, $ctrlno, $cesno)
    {
        $request->validate([ 

            'training' => ['required', Rule::unique('profile_tblTrainingMngt')->where('cesno', $cesno)->ignore($ctrlno, 'ctrlno')],
            'training_category' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'sponsor_training_provider' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'venue' => ['required', 'min:2', 'max:40'],
            'no_of_training_hours' => ['required', 'numeric', 'digits_between:1,4'],
            'inclusive_date_from' => ['required'],
            'inclusive_date_to' => ['required'],
            'expertise_field_of_specialization' => ['required'],
            
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $trainingManagement = ProfileTblTrainingMngt::find($ctrlno);
        $trainingManagement->training = $request->training;
        $trainingManagement->training_category = $request->training_category;
        $trainingManagement->sponsor = $request->sponsor_training_provider;
        $trainingManagement->venue = $request->venue;
        $trainingManagement->no_training_hours = $request->no_of_training_hours;
        $trainingManagement->from_dt = $request->inclusive_date_from;
        $trainingManagement->to_dt = $request->inclusive_date_to;
        $trainingManagement->field_specialization = $request->expertise_field_of_specialization;
        $trainingManagement->lastupd_enc = $encoder;
        $trainingManagement->save();

        return to_route('other-training.index', ['cesno'=>$cesno])->with('message', 'Updated Sucessfully');
    }

    public function destroy($ctrlno)
    {
        $otherTraining = ProfileTblTrainingMngt::find($ctrlno);
        $otherTraining->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');
    }

    public function recentlyDeleted($cesno)
    {
        //parent model
        $personalData = PersonalData::withTrashed()->find($cesno);

        // Access the soft deleted otherTraining of the parent model
        $otherTrainingTrashedRecord = $personalData->otherTraining()->onlyTrashed()->get();

        // Access the soft deleted competencyNonCesAccreditedTraining of the parent model
        $competencyNonCesAccreditedTrainingTrashedRecord = $personalData->competencyNonCesAccreditedTraining()->onlyTrashed()->get();
 
        return view('admin.201_profiling.view_profile.partials.other_management_trainings.trashbin', compact('otherTrainingTrashedRecord', 'competencyNonCesAccreditedTrainingTrashedRecord','cesno'));
    }

    public function restore($ctrlno)
    {
        $otherTraining = ProfileTblTrainingMngt::onlyTrashed()->find($ctrlno);
        $otherTraining->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }
 
    public function forceDelete($ctrlno)
    {
        $otherTraining = ProfileTblTrainingMngt::onlyTrashed()->find($ctrlno);
        $otherTraining->forceDelete();
  
        return back()->with('info', 'Data Permanently Deleted');
    }

    public function editCompetencyNonCesTraining($ctrlno, $cesno)
    {
        $otherManagementTraining = CompetencyNonCesAccreditedTraining::find($ctrlno);
        $profileLibTblExpertiseSpec = ProfileLibTblExpertiseSpec::all();

        return view('admin.201_profiling.view_profile.partials.other_management_trainings.competency_edit', compact('otherManagementTraining', 'profileLibTblExpertiseSpec', 'cesno'));
    }

    public function updateCompetencyNonCesTraining(Request $request, $ctrlno, $cesno)
    {
        $request->validate([ 

            'training' => ['required', Rule::unique('training_tblOtherAccre')->where('cesno', $cesno)->ignore($ctrlno, 'ctrlno')],
            'training_category' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'sponsor_training_provider' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'venue' => ['required', 'min:2', 'max:40'],
            'no_of_training_hours' => ['required', 'numeric', 'digits_between:1,4'],
            'inclusive_date_from' => ['required'],
            'inclusive_date_to' => ['required'],
            'expertise_field_of_specialization' => ['required'],
            
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName(); 

        $competencyTrainingManagement = CompetencyNonCesAccreditedTraining::find($ctrlno);
        $competencyTrainingManagement->training = $request->training;
        $competencyTrainingManagement->training_category = $request->training_category;
        $competencyTrainingManagement->sponsor = $request->sponsor_training_provider;
        $competencyTrainingManagement->venue = $request->venue;
        $competencyTrainingManagement->no_hours = $request->no_of_training_hours;
        $competencyTrainingManagement->from_dt = $request->inclusive_date_from;
        $competencyTrainingManagement->to_dt = $request->inclusive_date_to;
        $competencyTrainingManagement->specialization = $request->expertise_field_of_specialization;
        $competencyTrainingManagement->lastupd_enc = $encoder;
        $competencyTrainingManagement->save();

        return to_route('other-training.index', ['cesno'=>$cesno])->with('message', 'Updated Sucessfully');
    }

    public function destroyCompetencyNonCesTraining($ctrlno)
    {
        $competencyTrainingManagement = CompetencyNonCesAccreditedTraining::find($ctrlno);
        $competencyTrainingManagement->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');
    }

    public function restoreCompetencyNonCesTraining($ctrlno)
    {
        $competencyTrainingManagement = CompetencyNonCesAccreditedTraining::onlyTrashed()->find($ctrlno);
        $competencyTrainingManagement->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }

    public function forceDeleteCompetencyNonCesTraining($ctrlno)
    {
        $competencyTrainingManagement = CompetencyNonCesAccreditedTraining::onlyTrashed()->find($ctrlno);
        $competencyTrainingManagement->forceDelete();
  
        return back()->with('info', 'Data Permanently Deleted');
    }
}
