<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\PersonalData;
use Illuminate\Http\Request;

class CompetencyController extends Controller
{
    public function index(){

      $competencyData = PersonalData::paginate(25);

      return view('admin.competency.table', compact('competencyData'));

    }
}
