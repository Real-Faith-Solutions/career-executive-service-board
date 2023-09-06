<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\PersonalData;
use App\Models\ProfileLibTblCesStatus;
use App\Models\TrainingParticipants;
use App\Models\TrainingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TrainingParticipantsController extends Controller
{
    public function index($cesno)
    {
        $trainingParticipant = PersonalData::find($cesno);
        $trainings = $trainingParticipant->competencyCesTraining;

        return view('admin.competency.partials.ces_training_201.table', compact('cesno', 'trainings'));
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

        $trainingSession = TrainingSession::all();

        return view('admin.competency.partials.ces_training_201.form', compact('personalData', 'cesno', 'latestCesStatus', 'trainingSession'));
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

        return to_route('ces-training.index', ['cesno'=>$cesno])->with('message', 'Save Sucessfully');
    }

    public function destroy($ctrlno)
    {
        $trainingParticipant = TrainingParticipants::find($ctrlno);
        $trainingParticipant->delete();

        return back()->with('message', 'Deleted Sucessfully');
    }
}
