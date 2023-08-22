<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
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
}
