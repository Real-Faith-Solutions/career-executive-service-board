<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use Illuminate\Http\Request;

class CESTraining201Controller extends Controller
{
    public function index($cesno)
    {
        $personalData = PersonalData::find($cesno);
        $competencyCesTraining = $personalData->competencyCesTraining()->paginate(25);

        return view('admin.201_profiling.view_profile.partials.ces_trainings.table', compact('cesno', 'competencyCesTraining'));
    }
}
