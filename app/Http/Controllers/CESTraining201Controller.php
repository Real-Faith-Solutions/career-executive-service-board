<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use App\Models\TrainingParticipants;
use App\Models\TrainingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Http\Controllers\LatestCesStatusController;

class CESTraining201Controller extends Controller
{
    public function index($cesno)
    {
        // $personalData = PersonalData::find($cesno);
        // $cesTraining = $personalData->competencyCesTraining()
        // ->where('status', 'Completed')
        // ->orWhere('status', 'Incomplete')
        // ->paginate(25);

        $personalData = PersonalData::find($cesno);
        $cesTraining = $personalData->competencyCesTraining()
            ->where(function ($query) {
                $query->where('status', 'Completed')
                ->orWhere('status', 'Incomplete');
        })
        ->paginate(25);

        return view('admin.201_profiling.view_profile.partials.ces_trainings.table', compact('cesno', 'cesTraining'));
    }

    public function create($cesno)
    {
        $personalData = PersonalData::first()->find($cesno);

        $trainingSession = TrainingSession::all();

        // retrieve latest ces status from LatestCesStatusController
        $cesStatusController = new LatestCesStatusController();
        $description = $cesStatusController->latestCesStatus($personalData);
        // end of retrieve latest ces status from LatestCesStatusController
        
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

    public function edit($cesno, $ctrlno)
    {
        $personalData = PersonalData::first()->find($cesno);

        $trainingSession = TrainingSession::all();
        
        $trainingParticipants = TrainingParticipants::find($ctrlno);

        // retrieve latest ces status from LatestCesStatusController
        $cesStatusController = new LatestCesStatusController();
        $description = $cesStatusController->latestCesStatus($personalData);
        // end of retrieve latest ces status from LatestCesStatusController

        return view('admin.201_profiling.view_profile.partials.ces_trainings.edit', compact('personalData', 'trainingSession', 'cesno', 'trainingParticipants', 'description'));
    }

    public function update(Request $request, $cesno, $ctrlno)
    {
        $request->validate([

            'status' => ['required'],
            'remarks' => ['nullable'],
            'no_of_hours' => ['required'],
            'payment' => ['required'],
            
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();
                    
        $trainingParticipant = TrainingParticipants::find($ctrlno);
        $trainingParticipant->status = $request->status;
        $trainingParticipant->remarks = $request->remarks;
        $trainingParticipant->no_hours = $request->no_of_hours;
        $trainingParticipant->payment = $request->payment;
        $trainingParticipant->lastupd_enc = $encoder;
        $trainingParticipant->save();

        return to_route('ces-training-201.index', ['cesno'=>$cesno])->with('message', 'Update Sucessfully');        
    }

    public function destroy($ctrlno)
    {
        $trainingParticipant = TrainingParticipants::find($ctrlno);
        $trainingParticipant->delete();

        return back()->with('message', 'Deleted Sucessfully');
    }

    public function recentlyDeleted($cesno)
    {
        $personalData = PersonalData::withTrashed()->find($cesno);

        $competencyCesTraining = $personalData->competencyCesTraining()->onlyTrashed()->paginate(25);

        return view('admin.201_profiling.view_profile.partials.ces_trainings.trashbin', compact('cesno', 'competencyCesTraining'));
    }

    public function restore($ctrlno)
    {
        $trainingParticipant = TrainingParticipants::onlyTrashed()->find($ctrlno);
        $trainingParticipant->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }

    public function forceDelete($ctrlno)
    {
        $trainingParticipant = TrainingParticipants::onlyTrashed()->find($ctrlno);
        $trainingParticipant->forceDelete();

        return back()->with('info', 'Data Permanently Deleted');
    }
}
