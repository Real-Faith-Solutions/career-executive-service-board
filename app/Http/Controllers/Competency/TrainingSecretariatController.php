<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\TrainingSecretariat;
use Illuminate\Http\Request;

class TrainingSecretariatController extends Controller
{
    public function index()
    {
        return view('admin.competency.partials.training_type_library.training_secretariat.table');
    }

    public function create()
    {
        return view('admin.competency.partials.training_type_library.training_secretariat.form');
    }

    public function store(Request $request)
    {
        TrainingSecretariat::create([
            'description' => $request->description,
            'encoder' => 'sample ni manuel',
        ]);

        return to_route('training-secretariat.index')->with('message', 'Save Sucessfully');
    }
}
