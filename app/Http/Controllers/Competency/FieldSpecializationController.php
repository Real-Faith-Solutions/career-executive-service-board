<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\ProfileLibTblExpertiseGen;
use Illuminate\Http\Request;

class FieldSpecializationController extends Controller
{
    public function index()
    {
        $profileLibTblExpertiseGen = ProfileLibTblExpertiseGen::paginate(10);    

        return view('admin.competency.partials.training_type_library.expertise_specialization.table', compact('profileLibTblExpertiseGen'));
    }
}
