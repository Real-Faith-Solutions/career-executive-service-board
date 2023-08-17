<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\CompetencyTrainingVenueManager;
use Illuminate\Http\Request;

class TrainingVenueManagerController extends Controller
{
    public function index($cesno)
    {    
        $trainingVenueManager = CompetencyTrainingVenueManager::all();

        return view('admin.competency.partials.trainings_sub_module.training_venue_manager.table', compact('trainingVenueManager', 'cesno'));
    }
}
