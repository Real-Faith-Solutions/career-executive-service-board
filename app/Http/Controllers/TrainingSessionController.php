<?php

namespace App\Http\Controllers;

use App\Models\CompetencyTrainingVenueManager;
use App\Models\ProfileLibTblExpertiseGen;
use App\Models\ResourceSpeaker;
use App\Models\TrainingLibCategory;
use App\Models\TrainingSecretariat;
use App\Models\TrainingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TrainingSessionController extends Controller
{
    public function index()
    {
        $trainingSession = TrainingSession::paginate(25);

        return view('admin.competency.partials.training_session.table', compact('trainingSession'));
    }

    public function create()
    {
        $trainingLibCategory = TrainingLibCategory::all();
        $competencyTrainingVenueManager = CompetencyTrainingVenueManager::all();
        $trainingSecretariat = TrainingSecretariat::all();
        $profileLibTblExpertiseGen = ProfileLibTblExpertiseGen::all();
        $resourceSpeaker = ResourceSpeaker::all();

        return view('admin.competency.partials.training_session.form', compact('trainingLibCategory', 'competencyTrainingVenueManager', 'trainingSecretariat', 'profileLibTblExpertiseGen', 'resourceSpeaker'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:60', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:training_tblSessions,title'],
            'category' => ['required'],
            'specialization' => ['required'],
            'from_dt' => ['required'],
            'to_dt' => ['required'],
            'venue' => ['required'],
            'no_hours' => ['required', 'numeric', 'digits_between:1,4'],
            'barrio' => ['nullable', 'max:60', 'min:2'],
            'resource_speaker' => ['required'],
            'session_director' => ['required'],
            'status' => ['required'],
            'remarks' => ['required', 'regex:/^[a-zA-Z ]*$/'],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        TrainingSession::create([
            'title' => $request->title,
            'category' => $request->category,  
            'specialization' => $request->specialization,  
            'from_dt' => $request->from_dt,  
            'to_dt' => $request->to_dt,  
            'venueId' => $request->venue,  
            'status' => $request->status,  
            'remarks' => $request->remarks,  
            'barrio' => $request->barrio,  
            'no_hours' => $request->no_hours,  
            'session_director' => $request->session_director,   
            'speakerid' => $request->resource_speaker,  
            'encoder' => $encoder,    
        ]);

        return to_route('training-session.index')->with('message', 'Save Sucessfully');
    }

    public function edit($ctrlno)
    {
        $trainingSession = TrainingSession::find($ctrlno);

        if(!$trainingSession)
        {
            return redirect()->back()->with('error', 'Something Went Wrong');
        }

        $trainingLibCategory = TrainingLibCategory::all();
        $competencyTrainingVenueManager = CompetencyTrainingVenueManager::all();
        $trainingSecretariat = TrainingSecretariat::all();
        $profileLibTblExpertiseGen = ProfileLibTblExpertiseGen::all();
        $resourceSpeaker = ResourceSpeaker::all();

        return view('admin.competency.partials.training_session.edit', compact('trainingSession', 'trainingLibCategory', 'competencyTrainingVenueManager', 'trainingSecretariat', 'profileLibTblExpertiseGen', 'resourceSpeaker'));
    }

    public function update(Request $request, $ctrlno)
    {
        $request->validate([
            'title' => ['required', 'max:60', 'min:2', 'regex:/^[a-zA-Z ]*$/', Rule::unique('training_tblSessions')->ignore($ctrlno, 'sessionid')],
            'category' => ['required'],
            'specialization' => ['required'],
            'from_dt' => ['required'],
            'to_dt' => ['required'],
            'venue' => ['required'],
            'no_hours' => ['required','numeric', 'digits_between:1,4'],
            'barrio' => ['nullable', 'max:60', 'min:2'],
            'resource_speaker' => ['required'],
            'session_director' => ['required'],
            'status' => ['required'],
            'remarks' => ['required', 'regex:/^[a-zA-Z ]*$/'],
        ]);
        
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $trainingSession = TrainingSession::find($ctrlno);
        $trainingSession->title = $request->title;
        $trainingSession->category = $request->category;
        $trainingSession->specialization = $request->specialization;
        $trainingSession->from_dt = $request->from_dt;
        $trainingSession->to_dt = $request->to_dt;
        $trainingSession->venueid = $request->venue;
        $trainingSession->status = $request->status;
        $trainingSession->remarks = $request->remarks;
        $trainingSession->barrio = $request->barrio;
        $trainingSession->no_hours = $request->no_hours;
        $trainingSession->session_director = $request->session_director;
        $trainingSession->speakerid = $request->resource_speaker;
        $trainingSession->lastupd_enc = $encoder;
        $trainingSession->update();

        return to_route('training-session.index')->with('message', 'Update Sucessfully');
    }

    public function destroy($ctrlno)
    {
        $trainingSession = TrainingSession::find($ctrlno);

        // count the participant that already register to training session
        $trainingParticipantList = $trainingSession->trainingParticipantList()->withTrashed()->count();

        $participantCount = 1;

        if($trainingParticipantList >= $participantCount)
        {
     return redirect()->back()->with('error', 'The training session already has participants, so it cannot be deleted !!');
        }

        $trainingSession->delete();

        return back()->with('message', 'Deleted Sucessfully');
    }

    public function recentlyDeleted()
    {
        $trainingSessionTrashedRecord = TrainingSession::onlyTrashed()->paginate(25);

        return view('admin.competency.partials.training_session.trashbin', compact('trainingSessionTrashedRecord'));
    }


    public function restore($ctrlno)
    {
        $trainingSessionTrashedRecord = TrainingSession::onlyTrashed()->find($ctrlno);
        $trainingSessionTrashedRecord->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }
    
    public function forceDelete($ctrlno)
    {
        $trainingSessionTrashedRecord = TrainingSession::onlyTrashed()->find($ctrlno);
        $trainingSessionTrashedRecord->forceDelete();
    
        return back()->with('info', 'Data Permanently Deleted');
    }
}
