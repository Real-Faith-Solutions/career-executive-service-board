<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\PersonalData;
use App\Models\ProfileLibTblCesStatus;
use App\Models\TrainingParticipants;
use App\Models\TrainingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingParticipantsController extends Controller
{
    public function participantList($sessionId)
    {
        $trainingSession = TrainingSession::find($sessionId);
        $trainingParticipantList = $trainingSession->trainingParticipantList;

        return view('admin.competency.partials.training_session.participant_list', compact('trainingParticipantList', 'trainingSession', 'sessionId'));
    }

    public function addParticipant(Request $request, $sessionId)
    {
        $search = $request->input('search');

        // search query for personal data
        $searchPersonalData = PersonalData::query()
            ->where('cesno', "LIKE" ,"%$search%")
            ->orWhere('lastname',  "LIKE","%$search%")
            ->orWhere('firstname',  "LIKE","%$search%")
            ->orWhere('middlename',  "LIKE","%$search%")
            ->orWhere('name_extension',  "LIKE","%$search%")
            ->get();

        // validating if $search is not equal to null and the value is numeric
        if ($search !== null && trim($search) !== '' && is_numeric($search)) 
        {
            // Query the database to find the corresponding personal data
            $personalDataSearchResult = PersonalData::where('cesno', $search)->first();

            if (!$personalDataSearchResult || !is_numeric($search)) 
            {
                // Handle the case where the data does not exist
                return redirect()->route('training-session.createParticipant')->with('error', 'Data not found in the database.');
            }
        }
        else
        {
            $personalDataSearchResult = null;
        }

        // retrieving personal data latest ces status
            $personalData = PersonalData::first()->find($search);

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
                // Handle the case where $personalData is null
                $description = null; // or provide a default value if needed
            }
        // end of retrieving personal data latest ces status    
        
        return view('admin.competency.partials.training_session.participant_form', ['personalData' => $searchPersonalData, 'personalDataSearchResult' => 
        $personalDataSearchResult, 'search' => $search, 'description' => $description, 'sessionId' => $sessionId]);
    }

    public function storeParticipant(Request $request, $sessionId)
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

        $trainingParticipant = new TrainingParticipants([

            'cesno' => $request->cesno,
            'sessionid' => $sessionId,
            'status' => $request->status,
            'remarks' => $request->remarks,
            'no_hours' => $request->no_of_hours,
            'payment' => $request->payment,
            'encoder' =>  $encoder,

        ]);

        $personalData = PersonalData::find($request->cesno);
        
        $personalData->competencyCesTraining()->save($trainingParticipant);

        return to_route('training-session.addParticipant', ['sessionId'=>$sessionId])->with('message', 'Save Sucessfully');
    }

    public function destroyParticipant($pid)
    {
        $trainingParticipant = TrainingParticipants::find($pid);
        $trainingParticipant->delete();

        return back()->with('message', 'Participant Record Deleted Sucessfully');
    }

    public function recentlyDeletedParticipant()
    {
        $trainingParticipantTrashedRecord =  TrainingParticipants::onlyTrashed()->get();
    
        return view('admin.competency.partials.training_session.participant_trashbin', compact('trainingParticipantTrashedRecord'));
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
