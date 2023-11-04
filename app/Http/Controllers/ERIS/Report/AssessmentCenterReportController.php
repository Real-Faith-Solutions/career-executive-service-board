<?php

namespace App\Http\Controllers\Eris\Report;

use App\Http\Controllers\Controller;
use App\Models\Eris\AssessmentCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssessmentCenterReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $passed = $request->input('passed');
        $failed = $request->input('failed');
        $retake = $request->input('retake');

        $assessmentCenter = AssessmentCenter::query();

        $assessmentCenter->where(function ($query) use ($passed, $failed, $retake) {
            if ($passed && $failed && $retake) {
                $query->whereIn('remarks', [$passed, $failed])
                    ->where('numtakes', '>', 1);
            }
            elseif($passed && $failed)
            {
                $query->whereIn('remarks', [$passed, $failed]);
            }
            else 
            {
                if ($passed) {
                    $query->where('remarks', $passed);
                }

                if ($failed) {
                    $query->where('remarks', $failed);
                }

                if ($retake) {
                    $query->where('numtakes', '>', 1);
                }
            }
        });

        if ($startDate && $endDate) {
            $assessmentCenter->whereBetween(DB::raw('CAST(acdate AS DATE)'), [$startDate, $endDate]);
        }

        $assessmentCenter = $assessmentCenter->orderBy('acdate')->paginate(25);

        return view('admin.eris.reports.assessment_center.report', [
            'assessmentCenter' => $assessmentCenter,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'passed' => $passed,
            'failed' => $failed,
            'retake' => $retake,
        ]);
    }
}
