<?php

namespace App\Http\Controllers;

use App\Models\CompetencyTrainingProvider;
use App\Models\CompetencyTrainingVenueManager;
use App\Models\ProfileLibTblExpertiseGen;
use App\Models\ResourceSpeaker;
use App\Models\TrainingLibCategory;
use App\Models\TrainingSecretariat;
use App\Models\TrainingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingSessionController extends Controller
{
    public function index()
    {
        $trainingSession = TrainingSession::paginate(25);

        return view('admin.competency.partials.training_sessions.ces_trainings_attended.table', compact('trainingSession'));
    }

    public function create()
    {
        $trainingLibCategory = TrainingLibCategory::all();
        $competencyTrainingVenueManager = CompetencyTrainingVenueManager::all();
        $trainingSecretariat = TrainingSecretariat::all();
        $profileLibTblExpertiseGen = ProfileLibTblExpertiseGen::all();
        $resourceSpeaker = ResourceSpeaker::all();

        return view('admin.competency.partials.training_sessions.ces_trainings_attended.form', compact('trainingLibCategory', 'competencyTrainingVenueManager', 'trainingSecretariat', 'profileLibTblExpertiseGen', 'resourceSpeaker'));
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
            'no_hours' => ['required'],
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
            'venueid' => $request->venue,  
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
}
