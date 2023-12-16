<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LatestCesStatusController;
use App\Models\PersonalData;
use App\Models\TrainingParticipants;
use App\Models\TrainingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CompetencyCesTrainingController extends Controller
{
    public function index($cesno)
    {
        $personalData = PersonalData::find($cesno);
        $trainings = $personalData->competencyCesTraining;

        // retrieve latest ces status from LatestCesStatusController
        $cesStatusController = new LatestCesStatusController();
        $description = $cesStatusController->latestCesStatus($personalData);
        // end of retrieve latest ces status from LatestCesStatusController

        return view('admin.competency.partials.ces_training_201.table', compact('cesno', 'trainings', 'description'));
    }

    public function create($cesno)
    {
        $personalData = PersonalData::first()->find($cesno);

        $trainingSession = TrainingSession::all();

        // retrieve latest ces status from LatestCesStatusController
            $cesStatusController = new LatestCesStatusController();
            $description = $cesStatusController->latestCesStatus($personalData);
        // end of retrieve latest ces status from LatestCesStatusController

        return view('admin.competency.partials.ces_training_201.form', compact('personalData', 'cesno', 'description', 'trainingSession'));
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

        if($request->status == 'Completed' && $request->no_of_hours == 0)
        {
            return to_route('ces-training.create', ['cesno'=>$cesno])->with('error', 'Completed Status requires training hours');
        }

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

    public function edit($ctrlno, $cesno)
    {
        $trainingParticipants = TrainingParticipants::find($ctrlno);

        $trainingSession = TrainingSession::all();
        
        $personalData = PersonalData::first()->find($cesno);

        // retrieve latest ces status from LatestCesStatusController
            $cesStatusController = new LatestCesStatusController();
            $description = $cesStatusController->latestCesStatus($personalData);
        // end of retrieve latest ces status from LatestCesStatusController

        return view('admin.competency.partials.ces_training_201.edit', compact('cesno', 'personalData', 'trainingParticipants', 'trainingSession', 'description'));
    }

    public function update(Request $request, $ctrlno, $cesno)
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

        if ($trainingParticipant) {

            // Object exists, update its properties
            $trainingParticipant->status = $request->status;
            $trainingParticipant->remarks = $request->remarks;
            $trainingParticipant->no_hours = $request->no_of_hours;
            $trainingParticipant->payment = $request->payment;
            $trainingParticipant->lastupd_enc = $encoder;
            $trainingParticipant->save();

            return redirect()->route('ces-training.index', ['cesno' => $cesno])->with('message', 'Update Successfully');
        } else {
            // Handle the case where $trainingParticipant is null
            return redirect()->back()->with('error', 'Training participant not found');
        }
    }

    public function destroy($ctrlno)
    {
        $trainingParticipant = TrainingParticipants::find($ctrlno);
        $trainingParticipant->delete();

        return back()->with('message', 'Deleted Sucessfully');
    }

    public function recentlyDeleted($cesno)
    {
        //parent model
        $personalData = PersonalData::withTrashed()->find($cesno);

        // Access the soft deleted competencyCesTraining of the parent model
        $competencyCesTrainingTrashedRecord = $personalData->competencyCesTraining()->onlyTrashed()->get();

        // retrieve latest ces status from LatestCesStatusController
        $cesStatusController = new LatestCesStatusController();
        $description = $cesStatusController->latestCesStatus($personalData);
        // end of retrieve latest ces status from LatestCesStatusController

        return view('admin.competency.partials.ces_training_201.trashbin', compact('competencyCesTrainingTrashedRecord', 'cesno', 'description'));
    }

    public function restore($ctrlno)
    {
        $competencyCesTrainingTrashedRecord = TrainingParticipants::onlyTrashed()->find($ctrlno);
        $competencyCesTrainingTrashedRecord->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }

    public function forceDelete($ctrlno)
    {
        $competencyCesTrainingTrashedRecord = TrainingParticipants::onlyTrashed()->find($ctrlno);
        $competencyCesTrainingTrashedRecord->forceDelete();

        return back()->with('info', 'Data Permanently Deleted');
    }
}
