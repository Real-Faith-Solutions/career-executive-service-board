<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\ProfileLibCities;
use Illuminate\Http\Request;

class TrainingProviderManagerController extends Controller
{
    public function index($cesno)
    {
        return view('admin.competency.partials.trainings_sub_module.training_provider_manager.table', compact('cesno'));
    }

    public function create($cesno)
    {
        $profileLibTblCities = ProfileLibCities::all();
        return view('admin.competency.partials.trainings_sub_module.training_provider_manager.form', compact('cesno', 'profileLibTblCities'));
    }
}
