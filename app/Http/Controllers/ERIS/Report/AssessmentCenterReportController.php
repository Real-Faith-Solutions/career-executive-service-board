<?php

namespace App\Http\Controllers\Eris\Report;

use App\Http\Controllers\Controller;
use App\Models\Eris\AssessmentCenter;
use Illuminate\Http\Request;

class AssessmentCenterReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $assessmentCenter = AssessmentCenter::paginate(25);

        return view('admin.eris.reports.assessment_center.report', [
            'assessmentCenter' => $assessmentCenter,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }
}
