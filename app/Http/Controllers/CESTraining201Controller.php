<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use App\Models\ProfileLibTblCesStatus;
use App\Models\TrainingParticipants;
use App\Models\TrainingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CESTraining201Controller extends Controller
{
    public function index($cesno)
    {
        $personalData = PersonalData::find($cesno);
        $competencyCesTraining = $personalData->competencyCesTraining()->paginate(25);

        return view('admin.201_profiling.view_profile.partials.ces_trainings.table', compact('cesno', 'competencyCesTraining'));
    }

    public function create($cesno)
    {
        $personalData = PersonalData::first()->find($cesno);

        $trainingSession = TrainingSession::all();

        if ($personalData) 
        {
            $latestCesStatus = $personalData->profileTblCesStatus()->latest()->first();

            if ($latestCesStatus !== null) 
            {
                $latestCesStatusCode = $latestCesStatus->cesstat_code;
                
                $description = ProfileLibTblCesStatus::where('code', $latestCesStatusCode)->value('description');
            } 
            else 
            {
                // Handle the case where $latestCesStatus is null
                $description = null; // or provide a default value if needed
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Personal Data Not Found!!');
        }

        return view('admin\201_profiling\view_profile\partials\ces_trainings\form', compact('personalData', 'cesno', 'trainingSession', 'description'));
    }

    public function store(Request $request, $cesno)
    {
        
        $request->validate([

            'sessionid' => ['required',Rule::unique('training_tblparticipants')->where('cesno', $cesno)],
            'status' => ['required'],
            'remarks' => ['nullable'],
            'no_of_hours' => ['required'],
            'payment' => ['required'],
            
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $trainingParticipant = new TrainingParticipants([

            'cesno' => $request->cesno,
            'sessionid' => $request->sessionid,
            'status' => $request->status,
            'remarks' => $request->remarks,
            'no_hours' => $request->no_of_hours,
            'payment' => $request->payment,
            'encoder' =>  $encoder,

        ]);

        $personalData = PersonalData::find($cesno);
        
        $personalData->competencyCesTraining()->save($trainingParticipant);

        return to_route('ces-training-201.index', ['cesno'=>$cesno])->with('message', 'Save Sucessfully');
    }
}
