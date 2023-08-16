<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\CompetencyTrainingProvider;
use App\Models\PersonalData;
use App\Models\ProfileLibTblExpertiseSpec;
use Illuminate\Http\Request;

class OtherTrainingManagementController extends Controller
{
    public function index($cesno)
    {
        $personalData = PersonalData::find($cesno);
        $otherTraining = $personalData->otherTraining;

        return view('admin.competency.partials.training_sessions.other_management_trainings.table', compact('otherTraining' ,'cesno'));
    }

    public function create($cesno)
    {
       $profileLibTblExpertiseSpec =  ProfileLibTblExpertiseSpec::all();
       $competencyTrainingProvider = CompetencyTrainingProvider::all();

       return view('admin.competency.partials.training_sessions.other_management_trainings.form', compact('cesno', 'profileLibTblExpertiseSpec', 'competencyTrainingProvider'));
    }
}
