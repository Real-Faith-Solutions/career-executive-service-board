<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\CompetencyNonCesAccreditedTraining;
use App\Models\CompetencyTrainingProvider;
use App\Models\PersonalData;
use App\Models\ProfileLibTblExpertiseSpec;
use Illuminate\Http\Request;

class OtherTrainingManagementController extends Controller
{
    public function index($cesno)
    {
        $personalData = PersonalData::find($cesno);
        $otherTraining = $personalData->competencyNonCesAccreditedTraining;

        return view('admin.competency.partials.training_sessions.other_management_trainings.table', compact('otherTraining' ,'cesno'));
    }

    public function create($cesno)
    {
       $profileLibTblExpertiseSpec =  ProfileLibTblExpertiseSpec::all();
       $competencyTrainingProvider = CompetencyTrainingProvider::all();

       return view('admin.competency.partials.training_sessions.other_management_trainings.form', compact('cesno', 'profileLibTblExpertiseSpec', 'competencyTrainingProvider'));
    }

    public function store(Request $request, $cesno)
    {

        $provider = $request->sponsor_training_provider;
        $providerID = CompetencyTrainingProvider::where('provider', $provider)->value('providerID');

        $competencyNonCesAccreditedTraining = new CompetencyNonCesAccreditedTraining([

            'personal_data_cesno' => $cesno,
            'training' => $request->training,
            'training_category' => $request->training_category,
            'no_hours' => $request->no_of_training_hours,
            'sponsor' => $request->sponsor_training_provider,
            'venue' => $request->venue,
            'from_dt' => $request->inclusive_date_from,    
            'to_dt' => $request->inclusive_date_to,    
            'specialization' => $request->expertise_field_of_specialization,    
            'providerID' => $providerID,    

        ]);
     
        $personalData = PersonalData::find($cesno);
        
        $personalData->competencyNonCesAccreditedTraining()->save($competencyNonCesAccreditedTraining);
    
        return to_route('non-ces-training-management.index', ['cesno'=>$cesno])->with('message', 'Save Sucessfully');
    }

    public function edit($ctrlno, $cesno)
    {
        $nonCesAccreditedTraining = CompetencyNonCesAccreditedTraining::find($ctrlno);
        $profileLibTblExpertiseSpec =  ProfileLibTblExpertiseSpec::all();
        $competencyTrainingProvider = CompetencyTrainingProvider::all();

        return view('admin.competency.partials.training_sessions.other_management_trainings.edit', compact('cesno', 'profileLibTblExpertiseSpec', 'competencyTrainingProvider', 'nonCesAccreditedTraining'));    
    }

    public function update(Request $request, $ctrlno, $cesno)
    {
        $provider = $request->sponsor_training_provider;
        $providerID = CompetencyTrainingProvider::where('provider', $provider)->value('providerID');
        
        $competencyNonCesAccreditedTraining = CompetencyNonCesAccreditedTraining::find($ctrlno);
        $competencyNonCesAccreditedTraining->training = $request->training;
        $competencyNonCesAccreditedTraining->training_category = $request->training_category;
        $competencyNonCesAccreditedTraining->no_hours = $request->no_of_training_hours;
        $competencyNonCesAccreditedTraining->sponsor = $request->sponsor_training_provider;
        $competencyNonCesAccreditedTraining->venue = $request->venue;
        $competencyNonCesAccreditedTraining->from_dt = $request->inclusive_date_from;
        $competencyNonCesAccreditedTraining->to_dt = $request->inclusive_date_to;
        $competencyNonCesAccreditedTraining->specialization = $request->expertise_field_of_specialization;
        $competencyNonCesAccreditedTraining->providerID = $providerID;
        $competencyNonCesAccreditedTraining->save();

        return to_route('non-ces-training-management.index', ['cesno'=>$cesno])->with('info', 'Update Sucessfully');
    }

    public function destroy($ctrlno)
    {
        $competencyNonCesAccreditedTraining = CompetencyNonCesAccreditedTraining::find($ctrlno);
        $competencyNonCesAccreditedTraining->delete();

        return back()->with('info', 'Deleted Sucessfully');
    }

    public function recentlyDeleted($cesno)
    {
        //parent model
        $personalData = PersonalData::withTrashed()->find($cesno);

        // Access the soft deleted competencyNonCesAccreditedTraining of the parent model
        $competencyNonCesAccreditedTrainingTrashedRecord = $personalData->competencyNonCesAccreditedTraining()->onlyTrashed()->get();
 
        return view('admin.competency.partials.training_sessions.other_management_trainings.trashbin', compact('competencyNonCesAccreditedTrainingTrashedRecord', 'cesno'));
    }

    // public function restore($ctrlno)
    // {
    //     $profileTblCesStatus = ProfileTblCesStatus::withTrashed()->find($ctrlno);
    //     $profileTblCesStatus->restore();

    //     return back()->with('message', 'Data Restored Sucessfully');
    // }
 
    // public function forceDelete($ctrlno)
    // {
    //     $profileTblCesStatus = ProfileTblCesStatus::withTrashed()->find($ctrlno);
    //     $profileTblCesStatus->forceDelete();
  
    //     return back()->with('message', 'Data Permanently Deleted');
    // }
}
