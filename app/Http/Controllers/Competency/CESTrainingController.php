<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\PersonalData;
use App\Models\ProfileLibTblCesStatus;
use Illuminate\Http\Request;

class CESTrainingController extends Controller
{
    public function index($cesno)
    {
        return view('admin.competency.partials.ces_training_201.table', compact('cesno'));
    }

    public function create($cesno)
    {
        $personalData = PersonalData::first()->find($cesno);

        if ($personalData) 
        {
            $latestCesStatusCode = $personalData->profileTblCesStatus()->latest()->first()->cesstat_code;

            $latestCesStatus = ProfileLibTblCesStatus::where('code',  $latestCesStatusCode)->value('description');
        }
        else
        {
            return redirect()->back()->with('error', 'Personal Data Not Found!!');
        }

        return view('admin.competency.partials.ces_training_201.form', compact('personalData', 'cesno', 'latestCesStatus'));
    }
}
