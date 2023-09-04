<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CESTrainingController extends Controller
{
    public function index()
    {
        return view('admin.competency.partials.ces_training_201.table');
    }
}
