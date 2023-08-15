<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\PersonalData;
use Illuminate\Http\Request;

class OtherTrainingManagementController extends Controller
{
    public function index($cesno){

        $personalData = PersonalData::find($cesno);
        $otherTraining = $personalData->otherTraining;

        return view('admin.competency.partials.training_sessions.other_management_trainings.table', compact('otherTraining' ,'cesno'));

    }
}
