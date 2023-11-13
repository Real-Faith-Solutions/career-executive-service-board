<?php

namespace App\Http\Controllers\ERIS\report;

use App\Http\Controllers\Controller;
use App\Models\Eris\WrittenExam;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WrittenExamReportController extends Controller
{
    // App\Models
    private WrittenExam $writtenExam;
 
    public function __construct()
    {
        $this->writtenExam = new WrittenExam();
    }

    public function index(Request $request)
    {
        $writtenExam = $this->writtenExamDataFiltering($request);

        return view('admin.eris.reports.written_exam.report', [
            'startDate' => $writtenExam['startDate'],
            'endDate' => $writtenExam['endDate'],
            'passed' => $writtenExam['passed'],
            'failed' => $writtenExam['failed'],
            'retake' => $writtenExam['retake'],
            'location' => $this->writtenExam->writtenExamLocation(),
            'writtenExam' => $writtenExam['writtenExam'],
            'writtenExamLocation' => $writtenExam['writtenExamLocation'],
            'sortBy' => $writtenExam['sortBy'],
            'sortOrder' => $writtenExam['sortOrder'],
        ]);
    }

    public function writtenExamDataFiltering($request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $passed = $request->input('passed');
        $failed = $request->input('failed');
        $retake = $request->input('retake');
        $location = $request->input('location');
        $sortBy = $request->input('sortBy', 'we_date'); // Default sorting we_date.
        $sortOrder = $request->input('sortOrder', 'desc'); // Default sorting order

        $writtenExam = WrittenExam::query();

        $writtenExam->where(function ($query) use ($passed, $failed, $location, $retake) {
            if ($passed && $failed && $location) {
                $query->whereIn('we_remarks', [$passed, $failed])
                    ->where('we_location', $location);
            }
            elseif($passed && $failed && $retake)
            {
                $query->whereIn('we_remarks', [$passed, $failed])
                        ->where('numtakes', '>', '1');
            }
            elseif($passed && $failed)
            {
                $query->whereIn('we_remarks', [$passed, $failed]);
            }
            else 
            {
                if ($passed) {
                    $query->where('we_remarks', $passed);
                }

                if ($failed) {
                    $query->where('we_remarks', $failed);
                }

                if ($location) {
                    $query->where('we_location', $location);
                }

                if ($retake) {
                    $query->where('numtakes', '>', '1');
                }
            }
        });

        if ($startDate && $endDate) 
        {
            $writtenExam->whereBetween(DB::raw('CAST(we_date AS DATE)'), [$startDate, $endDate]);
        }

        $writtenExam->orderBy($sortBy, $sortOrder);

        $writtenExam = $writtenExam->paginate(25);

        return 
        [
            'writtenExam' => $writtenExam,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'passed' => $passed,
            'failed' => $failed,
            'retake' => $retake,
            'writtenExamLocation' => $location,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
        ];
    }

    public function generateReportPdf(Request $request, $sortBy, $sortOrder)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $passed = $request->input('passed');
        $failed = $request->input('failed');
        $retake = $request->input('retake');
        $location = $request->input('location');

        $writtenExam = WrittenExam::query();

        $writtenExam->where(function ($query) use ($passed, $failed, $location, $retake) {
            if ($passed && $failed && $location) {
                $query->whereIn('we_remarks', [$passed, $failed])
                    ->where('we_location', $location);
            }
            else
            if($passed && $failed && $retake)
            {
                $query->whereIn('we_remarks', [$passed, $failed])
                        ->where('numtakes', '>', '1');
            }
            elseif($passed && $failed)
            {
                $query->whereIn('we_remarks', [$passed, $failed]);
            }
            else 
            {
                if ($passed) {
                    $query->where('we_remarks', $passed);
                }

                if ($failed) {
                    $query->where('we_remarks', $failed);
                }

                if ($location) {
                    $query->where('we_location', $location);
                }

                if ($retake) {
                    $query->where('numtakes', '>', '1');
                }
            }
        });

        if ($startDate && $endDate) 
        {
            $writtenExam->whereBetween(DB::raw('CAST(we_date AS DATE)'), [$startDate, $endDate]);
        }

        $writtenExam->orderBy($sortBy, $sortOrder);

        $writtenExam = $writtenExam->get();

        // $writtenExam = $writtenExam->paginate(25);

        $pdf = Pdf::loadView('admin.eris.reports.written_exam.report_pdf', [
            'writtenExam' => $writtenExam,
        ])

        ->setPaper('a4', 'landscape');

        return $pdf->stream('written-exam-report.pdf');
    }
}
