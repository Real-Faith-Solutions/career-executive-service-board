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
}
