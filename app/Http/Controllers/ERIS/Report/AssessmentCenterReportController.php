<?php

namespace App\Http\Controllers\Eris\Report;

use App\Http\Controllers\Controller;
use App\Models\Eris\AssessmentCenter;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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

    public function dataFiltering($request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $passed = $request->input('passed');
        $failed = $request->input('failed');
        $retake = $request->input('retake');
        $sortBy = $request->input('sortBy', 'lastname'); // Default sorting acdate.
        $sortOrder = $request->input('sortOrder', 'asc'); // Default sorting order

        $assessmentCenter = AssessmentCenter::query();

        $assessmentCenter->join('erad_tblMain', 'erad_tblMain.acno', '=', 'erad_tblAC.acno')
        ->select('erad_tblAC.*')
        ->with('erisTblMainAssessmentCenter');

        $assessmentCenter->where(function ($query) use ($passed, $failed, $retake) {
            if ($passed && $failed && $retake) {
                $query->where(function ($q) use ($passed, $failed) {
                    $q->where('remarks', 'LIKE', "%$passed%")
                          ->orWhere('remarks', 'LIKE', "%$failed%");
                })
                ->where('numtakes', '>', 1);
            }
            elseif($passed && $failed)
            {
                $query->where('remarks', 'LIKE', "%$passed%")
                      ->orWhere('remarks', 'LIKE', "%$failed%");
            }
            else 
            {
                if ($passed) {
                    $query->where('remarks', 'LIKE', "%$passed%");
                }

                if ($failed) {
                    $query->where('remarks', 'LIKE', "%$failed%");
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

        $assessmentCenter->orderBy($sortBy, $sortOrder);

        $assessmentCenter = $assessmentCenter->paginate(25);

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

    // generate download links
    public function generateDownloadLinks(Request $request, $sortBy, $sortOrder)
    {
        $sortBy = $sortBy ?? 'lastname';
        $sortOrder = $sortOrder ?? 'asc';

        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $passed = $request->input('passed');
        $failed = $request->input('failed');
        $retake = $request->input('retake');

        $assessmentCenter = AssessmentCenter::query();

        $assessmentCenter->join('erad_tblMain', 'erad_tblMain.acno', '=', 'erad_tblAC.acno')
        ->select('erad_tblAC.*')
        ->with('erisTblMainAssessmentCenter');

        $assessmentCenter->where(function ($query) use ($passed, $failed, $retake) {
            if ($passed && $failed && $retake) {
                $query->where(function ($q) use ($passed, $failed) {
                    $q->where('remarks', 'LIKE', "%$passed%")
                          ->orWhere('remarks', 'LIKE', "%$failed%");
                })
                ->where('numtakes', '>', 1);
            }
            elseif($passed && $failed)
            {
                $query->where('remarks', 'LIKE', "%$passed%")
                      ->orWhere('remarks', 'LIKE', "%$failed%");
            }
            else 
            {
                if ($passed) {
                    $query->where('remarks', 'LIKE', "%$passed%");
                }

                if ($failed) {
                    $query->where('remarks', 'LIKE', "%$failed%");
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

        $assessmentCenter->orderBy($sortBy, $sortOrder);

        // Set the maximum number of records per partition
        $recordsPerPartition = 500;

        $totalData = $assessmentCenter->count();
        $totalParts = ceil($totalData/$recordsPerPartition);

        // number of partitions
        $partitionNumber = 0;

        // number of data that will be skipped
        $skippedData = 0;

        // Initialize an array to store download links
        $downloadLinks = [];

        // Chunk the results based on the defined limit (don't remove the &$downloadLinks, $recordsPerPartition, $partitionNumber, $skippedData; 
        // the other parameter here is based on your applied filters change it according to your needs)
        $assessmentCenter->chunk($recordsPerPartition, function ($partition) use (&$downloadLinks, $recordsPerPartition, &$partitionNumber, &$skippedData, $sortBy, $sortOrder, $startDate, $endDate, $passed, $failed, $retake, $totalParts) 
        {
            // calculating how many data should be skipped for this partition
            $skippedData = $recordsPerPartition * $partitionNumber;

            // incrementing the partition number
            $partitionNumber++;

            // filename for this partition (concatinate the partition number as part number)
            $filename = 'eris-assessment-center-reports-part'.$partitionNumber.'.pdf';

            // Create a route to handle the download action for each partition
            // don't remove the $recordsPerPartition, $partitionNumber, $skippedData, $filename
            $downloadRoute = route('assessment-center-report.generateReportPdf', 
                                ['recordsPerPartition' => $recordsPerPartition, 'partitionNumber' => $partitionNumber, 'skippedData' => $skippedData, 'filename' => $filename, 'sortBy' => $sortBy, 'sortOrder' => $sortOrder, 'startDate' => $startDate, 'endDate' => $endDate, 'passed' => $passed, 'failed' => $failed, 'retake' => $retake, 'totalParts' => $totalParts]);

            // Store the download link in the array
            $downloadLinks[] = [
                'url' => $downloadRoute,
                'label' => 'ERIS Assessment Center Reports Part '.$partitionNumber,
            ];
        });

        // Pass the download links to the next download page
        return view('admin.eris.reports.assessment_center.download_reports', compact('downloadLinks'));
    }

    // generate pdf report
    public function generateReportPdf(Request $request, $totalParts, $recordsPerPartition, $partitionNumber, $skippedData, $filename, $sortBy, $sortOrder)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $passed = $request->input('passed');
        $failed = $request->input('failed');
        $retake = $request->input('retake');

        $fullDateName = Carbon::now()->format('d  F  Y'); // getting full name attribute of the month example: 01 December 2023

        $assessmentCenter = AssessmentCenter::query();

        $assessmentCenter->join('erad_tblMain', 'erad_tblMain.acno', '=', 'erad_tblAC.acno')
        ->select('erad_tblAC.*')
        ->with('erisTblMainAssessmentCenter');

        $assessmentCenter->where(function ($query) use ($passed, $failed, $retake) {
            if ($passed && $failed && $retake) {
                $query->where(function ($q) use ($passed, $failed) {
                    $q->where('remarks', 'LIKE', "%$passed%")
                          ->orWhere('remarks', 'LIKE', "%$failed%");
                })
                ->where('numtakes', '>', 1);
            }
            elseif($passed && $failed)
            {
                $query->where('remarks', 'LIKE', "%$passed%")
                      ->orWhere('remarks', 'LIKE', "%$failed%");
            }
            else 
            {
                if ($passed) {
                    $query->where('remarks', 'LIKE', "%$passed%");
                }

                if ($failed) {
                    $query->where('remarks', 'LIKE', "%$failed%");
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

        $assessmentCenter->orderBy($sortBy, $sortOrder);

        // getting the data and applying the skipped data and records per partition to get the correct part of the report
        $assessmentCenter = $assessmentCenter->skip($skippedData)->take($recordsPerPartition)->get();

        $pdf = App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('admin.eris.reports.assessment_center.report_pdf', [
            'assessmentCenter' => $assessmentCenter,
            'totalParts' => $totalParts,
            'partitionNumber' => $partitionNumber,
            'skippedData' => $skippedData,
            'fullDateName' => $fullDateName,
        ])
        ->setPaper('a4', 'portrait');

        return $pdf->stream($filename);
    }
}
