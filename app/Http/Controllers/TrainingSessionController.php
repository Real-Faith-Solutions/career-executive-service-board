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
}
