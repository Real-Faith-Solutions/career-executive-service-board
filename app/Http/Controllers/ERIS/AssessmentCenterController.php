<?php

namespace App\Http\Controllers\ERIS;

use App\Http\Controllers\Controller;
use App\Models\AssessmentCenter;
use App\Models\Eris\ErisTblMain;
use Illuminate\Http\Request;

class AssessmentCenterController extends Controller
{
    public function index($acno)
    {
        $erisTblMain = ErisTblMain::find($acno);
        $assessmentCenter = $erisTblMain->assessmentCenter()->paginate(20);

        return view('admin.eris.partials.assessment_center.table', compact('acno', 'assessmentCenter'));
    }
}
