<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LatestCesStatusController;
use App\Models\PersonalData;
use App\Models\TrainingParticipants;
use App\Models\TrainingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingParticipantsController extends Controller
{
    public function participantList(Request $request, $sessionId)
    {
        $sortBy = $request->input('sortBy', 'pid'); // Default sorting GenExp_Code.
        $sortOrder = $request->input('sortOrder', 'desc'); // Default sorting order

        $trainingSession = TrainingSession::find($sessionId);
        $trainingParticipantList = $trainingSession->trainingParticipantList()
        ->orderBy($sortBy, $sortOrder)
        ->paginate(25);

        return view('admin.competency.partials.training_participant.participant_list', 
        compact(
            'trainingParticipantList', 
            'trainingSession', 
            'sessionId', 
            'sortBy',
            'sortOrder'
        ));
    }

    public function addParticipant(Request $request, $sessionId)
    {
        $trainingSessionDescription = TrainingSession::where('sessionid', $sessionId)->value('title');

        $search = $request->input('search');

        // search query for personal data
        $searchPersonalData = PersonalData::query()
            ->where('cesno', "LIKE" ,"%$search%")
            ->orWhere('lastname',  "LIKE","%$search%")
            ->orWhere('firstname',  "LIKE","%$search%")
            ->orWhere('middlename',  "LIKE","%$search%")
            ->orWhere('name_extension',  "LIKE","%$search%")
            ->paginate(200);

        if ($search !== null && !is_numeric($search)) 
        {
            return redirect()->route('training-session.addParticipant', ['sessionId'=>$sessionId])->with('error', 'Invalid Search Criteria.');
        }

        if ($search !== null && is_numeric($search)) 
        {
            // Query the database to find the corresponding personal data
            $personalDataSearchResult = PersonalData::where('cesno', $search)->first();

            if (!$personalDataSearchResult) 
            {
                // Handle the case where the data does not exist
                return redirect()->route('training-session.addParticipant', ['sessionId'=>$sessionId])->with('error', 'Data not found in the database.');
            }

            // retrieving personal data latest ces status
                $personalData = PersonalData::first()->find($search);

                // retrieve latest ces status from LatestCesStatusController
                    $cesStatusController = new LatestCesStatusController();
                    $description = $cesStatusController->latestCesStatus($personalData);
                // end of retrieve latest ces status from LatestCesStatusController
                
            // end of retrieving personal data latest ces status     
        }
        else
        {
            $personalDataSearchResult = null;
            $description = null;
        }
        
        return view('admin.competency.partials.training_participant.participant_form', 
        [
            'personalData' => $searchPersonalData, 
            'personalDataSearchResult' => $personalDataSearchResult, 
            'search' => $search, 
            'description' => $description, 
            'sessionId' => $sessionId, 
            'trainingSessionDescription' => $trainingSessionDescription
        ]);
    }

    public function storeParticipant(Request $request, $sessionId)
    {
        $request->validate([

            'status' => ['required'],
            'remarks' => ['nullable'],
            'no_of_hours' => ['required'],
            'payment' => ['required'],
            
        ]);

        if($request->status == 'Completed' && $request->no_of_hours == 0)
        {
            return to_route('training-session.addParticipant', ['sessionId'=>$sessionId])->with('error', 'Completed Status requires training hours');
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $trainingParticipantsExisted = TrainingParticipants::where('sessionid', $sessionId)->where('cesno', $request->cesno)->exists();

        if($trainingParticipantsExisted)
        {
            return to_route('training-session.addParticipant', ['sessionId'=>$sessionId])->with('error', 'The Participant is already registered');
        }
        else
        {
            $trainingParticipant = new TrainingParticipants([

                'cesno' => $request->cesno,
                'status' => $request->status,
                'remarks' => $request->remarks,
                'no_hours' => $request->no_of_hours,
                'payment' => $request->payment,
                'encoder' =>  $encoder,

            ]);

            $trainingSession = TrainingSession::find($sessionId);

            $trainingSession->trainingParticipantList()->save($trainingParticipant);
        }

        return to_route('training-session.addParticipant', ['sessionId'=>$sessionId])->with('message', 'Save Sucessfully');
    }

    public function editParticipant($pid, $sessionId)
    {
        $trainingParticipant = TrainingParticipants::find($pid);

        $personalData = PersonalData::first()->find($trainingParticipant->cesno);

        // retrieve latest ces status from LatestCesStatusController
            $cesStatusController = new LatestCesStatusController();
            $description = $cesStatusController->latestCesStatus($personalData);
        // end of retrieve latest ces status from LatestCesStatusController

        return view('admin.competency.partials.training_participant.participant_edit', compact('trainingParticipant', 'sessionId', 'personalData', 'description', 'pid'));
    }

    public function updateParticipant(Request $request, $pid, $sessionId)
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
                    
        $trainingParticipant = TrainingParticipants::find($pid);
        $trainingParticipant->status = $request->status;
        $trainingParticipant->remarks = $request->remarks;
        $trainingParticipant->no_hours = $request->no_of_hours;
        $trainingParticipant->payment = $request->payment;
        $trainingParticipant->lastupd_enc = $encoder;
        $trainingParticipant->save();

        return to_route('training-session.participantList', ['sessionId'=>$sessionId])->with('info', 'Update Sucessfully');     
    }

    public function destroyParticipant($pid)
    {
        $trainingParticipant = TrainingParticipants::find($pid);
        $trainingParticipant->delete();

        return back()->with('message', 'Participant Record Deleted Sucessfully');
    }

    public function recentlyDeletedParticipant()
    {
        $trainingParticipantTrashedRecord =  TrainingParticipants::onlyTrashed()->paginate(25);
    
        return view('admin.competency.partials.training_participant.participant_trashbin', compact('trainingParticipantTrashedRecord'));
    }

    public function restoreParticipantList($pid)
    {
        $trainingParticipantTrashedRecord = TrainingParticipants::onlyTrashed()->find($pid);
        $trainingParticipantTrashedRecord->restore();

        return back()->with('info', 'Participant\'s Record Sucessfully');
    }

    public function forceDeleteParticipantList($pid)
    {
        $trainingParticipantTrashedRecord = TrainingParticipants::onlyTrashed()->find($pid);
        $trainingParticipantTrashedRecord->forceDelete();

        return back()->with('info', 'Participant\'s Record Permanently Deleted');
    }
}
