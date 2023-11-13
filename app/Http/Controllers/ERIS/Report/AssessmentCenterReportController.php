<?php

namespace App\Http\Controllers\Eris\Report;

use App\Http\Controllers\Controller;
use App\Models\Eris\AssessmentCenter;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssessmentCenterReportController extends Controller
{
    public function index(Request $request)
    {
        $assessmentCenter = $this->dataFiltering($request);

        return view('admin.eris.reports.assessment_center.report', [
            'assessmentCenter' => $assessmentCenter['assessmentCenter'],
            'startDate' => $assessmentCenter['startDate'],
            'endDate' => $assessmentCenter['endDate'],
            'passed' => $assessmentCenter['passed'],
            'failed' => $assessmentCenter['failed'],
            'retake' => $assessmentCenter['retake'],
            'sortBy' => $assessmentCenter['sortBy'],
            'sortOrder' => $assessmentCenter['sortOrder'],
        ]);
    }

    public function generateReportPdf(Request $request)
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

        if ($startDate && $endDate) 
        {
            $assessmentCenter->whereBetween(DB::raw('CAST(acdate AS DATE)'), [$startDate, $endDate]);
        }

        $assessmentCenter->with(['erisTblMainAssessmentCenter']);

        $assessmentCenter = $assessmentCenter->get();

        $pdf = Pdf::loadView('admin.eris.reports.assessment_center.report_pdf', [
            'assessmentCenter' => $assessmentCenter,
        ])
        ->setPaper('a4', 'landscape');

        return $pdf->stream('assessment-center-report.pdf');
    }

    public function dataFiltering($request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $passed = $request->input('passed');
        $failed = $request->input('failed');
        $retake = $request->input('retake');
        $sortBy = $request->input('sortBy', 'acdate'); // Default sorting acdate.
        $sortOrder = $request->input('sortOrder', 'desc'); // Default sorting order

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

        if ($startDate && $endDate) 
        {
            $assessmentCenter->whereBetween(DB::raw('CAST(acdate AS DATE)'), [$startDate, $endDate]);
        }

        $assessmentCenter->with(['erisTblMainAssessmentCenter' => function($query) {
            $query->orderBy('lastname');
        }]);

        $assessmentCenter = $assessmentCenter
                            ->orderBy($sortBy, $sortOrder)
                            ->paginate(25);

        return 
        [
            'assessmentCenter' => $assessmentCenter,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'passed' => $passed,
            'failed' => $failed,
            'retake' => $retake,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
        ];
    }
}
