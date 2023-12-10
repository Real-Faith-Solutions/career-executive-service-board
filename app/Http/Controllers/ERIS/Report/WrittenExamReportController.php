<?php

namespace App\Http\Controllers\ERIS\report;

use App\Http\Controllers\Controller;
use App\Models\Eris\WrittenExam;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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
        $sortBy = $request->input('sortBy', 'lastname'); // Default sorting we_date.
        $sortOrder = $request->input('sortOrder', 'asc'); // Default sorting order

        $writtenExam = WrittenExam::query();

        $writtenExam->join('erad_tblMain', 'erad_tblMain.acno', '=', 'erad_tblWExam.acno')
        ->select('erad_tblWExam.*')
        ->with('erisTblMainWrittenExam');

        $writtenExam->where(function ($query) use ($passed, $failed, $location, $retake) {
            if ($passed && $failed && $location) {
                $query->where(function ($q) use ($passed, $failed) {
                    $q->where('erad_tblWExam.we_remarks', 'LIKE', "%$passed%")
                          ->orWhere('erad_tblWExam.we_remarks', 'LIKE', "%$failed%");
                })->where('erad_tblWExam.numtakes', '>', 1);
            }
            elseif($passed && $failed && $retake)
            {
                $query->where(function ($q) use ($passed, $failed) {
                    $q->where('erad_tblWExam.we_remarks', 'LIKE', "%$passed%")
                        ->orWhere('erad_tblWExam.we_remarks', 'LIKE', "%$failed%");
                })
                ->where('erad_tblWExam.numtakes', '>', '1');
            }
            elseif($passed && $failed)
            {
                $query->where(function ($q) use ($passed, $failed) {
                    $q->where('erad_tblWExam.we_remarks', 'LIKE', "%$passed%")
                        ->orWhere('erad_tblWExam.we_remarks', 'LIKE', "%$failed%");
                });
            }
            else 
            {
                if ($passed) {
                    $query->where('erad_tblWExam.we_remarks', 'LIKE', "%$passed%");
                }

                if ($failed) {
                    $query->where('erad_tblWExam.we_remarks', 'LIKE', "%$failed%");
                }

                if ($location) {
                    $query->where('erad_tblWExam.we_location', $location);
                }

                if ($retake) {
                    $query->where('erad_tblWExam.numtakes', '>', '1');
                }
            }
        });

        if ($startDate && $endDate) 
        {
            $writtenExam->whereBetween(DB::raw('CAST(erad_tblWExam.we_date AS DATE)'), [$startDate, $endDate]);
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

    // generate download links
    public function generateDownloadLinks(Request $request, $sortBy, $sortOrder,)
    {
        $sortBy = $sortBy ?? 'lastname';
        $sortOrder = $sortOrder ?? 'asc';

        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $passed = $request->input('passed');
        $failed = $request->input('failed');
        $retake = $request->input('retake');
        $location = $request->input('location');

        $writtenExam = WrittenExam::query();

        $writtenExam->join('erad_tblMain', 'erad_tblMain.acno', '=', 'erad_tblWExam.acno')
        ->select('erad_tblWExam.*')
        ->with('erisTblMainWrittenExam');

        $writtenExam->where(function ($query) use ($passed, $failed, $location, $retake) {
            if ($passed && $failed && $location) {
                $query->where(function ($q) use ($passed, $failed) {
                    $q->where('erad_tblWExam.we_remarks', 'LIKE', "%$passed%")
                          ->orWhere('erad_tblWExam.we_remarks', 'LIKE', "%$failed%");
                })->where('erad_tblWExam.numtakes', '>', 1);
            }
            elseif($passed && $failed && $retake)
            {
                $query->where(function ($q) use ($passed, $failed) {
                    $q->where('erad_tblWExam.we_remarks', 'LIKE', "%$passed%")
                        ->orWhere('erad_tblWExam.we_remarks', 'LIKE', "%$failed%");
                })
                ->where('erad_tblWExam.numtakes', '>', '1');
            }
            elseif($passed && $failed)
            {
                $query->where(function ($q) use ($passed, $failed) {
                    $q->where('erad_tblWExam.we_remarks', 'LIKE', "%$passed%")
                        ->orWhere('erad_tblWExam.we_remarks', 'LIKE', "%$failed%");
                });
            }
            else 
            {
                if ($passed) {
                    $query->where('erad_tblWExam.we_remarks', 'LIKE', "%$passed%");
                }

                if ($failed) {
                    $query->where('erad_tblWExam.we_remarks', 'LIKE', "%$failed%");
                }

                if ($location) {
                    $query->where('erad_tblWExam.we_location', $location);
                }

                if ($retake) {
                    $query->where('erad_tblWExam.numtakes', '>', '1');
                }
            }
        });

        if ($startDate && $endDate) 
        {
            $writtenExam->whereBetween(DB::raw('CAST(erad_tblWExam.we_date AS DATE)'), [$startDate, $endDate]);
        }

        $writtenExam->orderBy($sortBy, $sortOrder);

        // Set the maximum number of records per partition
        $recordsPerPartition = 500;

        // number of partitions
        $partitionNumber = 0;

        $totalData = $writtenExam->count();
        $totalParts = ceil($totalData/$recordsPerPartition);

        // number of data that will be skipped
        $skippedData = 0;

        // Initialize an array to store download links
        $downloadLinks = [];

        // Chunk the results based on the defined limit (don't remove the &$downloadLinks, $recordsPerPartition, $partitionNumber, $skippedData; 
        // the other parameter here is based on your applied filters change it according to your needs)
        $writtenExam->chunk($recordsPerPartition, function ($partition) use (&$downloadLinks, $recordsPerPartition, &$partitionNumber, &$skippedData, $sortBy, $sortOrder, $startDate, $endDate, $passed, $failed, $retake, $location, $totalParts) {

            // calculating how many data should be skipped for this partition
            $skippedData = $recordsPerPartition * $partitionNumber;

            // incrementing the partition number
            $partitionNumber++;

            // filename for this partition (concatinate the partition number as part number)
            $filename = 'eris-written-exam-reports-part'.$partitionNumber.'.pdf';

            // Create a route to handle the download action for each partition
            // don't remove the $recordsPerPartition, $partitionNumber, $skippedData, $filename
            $downloadRoute = route('written-exam-report.generateReportPdf', 
                                ['recordsPerPartition' => $recordsPerPartition, 'partitionNumber' => $partitionNumber, 'skippedData' => $skippedData, 'filename' => $filename, 'sortBy' => $sortBy, 'sortOrder' => $sortOrder, 'startDate' => $startDate, 'endDate' => $endDate, 'passed' => $passed, 'failed' => $failed, 'retake' => $retake, 'location' => $location, 'totalParts' => $totalParts]);

            // Store the download link in the array
            $downloadLinks[] = [
                'url' => $downloadRoute,
                'label' => 'ERIS - Written Exam Reports Part '.$partitionNumber,
            ];
        });

        // Pass the download links to the next download page
        return view('admin.eris.reports.written_exam.download_reports', compact('downloadLinks'));
    }

    // generate pdf report
    public function generateReportPdf(Request $request, $totalParts, $recordsPerPartition, $partitionNumber, $skippedData, $filename, $sortBy, $sortOrder)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $passed = $request->input('passed');
        $failed = $request->input('failed');
        $retake = $request->input('retake');
        $location = $request->input('location');

        $writtenExam = WrittenExam::query();

        $writtenExam->join('erad_tblMain', 'erad_tblMain.acno', '=', 'erad_tblWExam.acno')
        ->select('erad_tblWExam.*')
        ->with('erisTblMainWrittenExam');

        $writtenExam->where(function ($query) use ($passed, $failed, $location, $retake) {
            if ($passed && $failed && $location) {
                $query->where(function ($q) use ($passed, $failed) {
                    $q->where('erad_tblWExam.we_remarks', 'LIKE', "%$passed%")
                          ->orWhere('erad_tblWExam.we_remarks', 'LIKE', "%$failed%");
                })->where('erad_tblWExam.numtakes', '>', 1);
            }
            elseif($passed && $failed && $retake)
            {
                $query->where(function ($q) use ($passed, $failed) {
                    $q->where('erad_tblWExam.we_remarks', 'LIKE', "%$passed%")
                        ->orWhere('erad_tblWExam.we_remarks', 'LIKE', "%$failed%");
                })
                ->where('erad_tblWExam.numtakes', '>', '1');
            }
            elseif($passed && $failed)
            {
                $query->where(function ($q) use ($passed, $failed) {
                    $q->where('erad_tblWExam.we_remarks', 'LIKE', "%$passed%")
                        ->orWhere('erad_tblWExam.we_remarks', 'LIKE', "%$failed%");
                });
            }
            else 
            {
                if ($passed) {
                    $query->where('erad_tblWExam.we_remarks', 'LIKE', "%$passed%");
                }

                if ($failed) {
                    $query->where('erad_tblWExam.we_remarks', 'LIKE', "%$failed%");
                }

                if ($location) {
                    $query->where('erad_tblWExam.we_location', $location);
                }

                if ($retake) {
                    $query->where('erad_tblWExam.numtakes', '>', '1');
                }
            }
        });

        if ($startDate && $endDate) 
        {
            $writtenExam->whereBetween(DB::raw('CAST(erad_tblWExam.we_date AS DATE)'), [$startDate, $endDate]);
        }

        $writtenExam->orderBy($sortBy, $sortOrder);

        // getting the data and applying the skipped data and records per partition to get the correct part of the report
        $writtenExam = $writtenExam->skip($skippedData)->take($recordsPerPartition)->get();

        $fullDateName = Carbon::now()->format('d  F  Y'); // getting full name attribute of the month example: 01 December 2023

        $pdf = App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('admin.eris.reports.written_exam.report_pdf', [
            'writtenExam' => $writtenExam,
            'totalParts' => $totalParts,
            'partitionNumber' => $partitionNumber,
            'fullDateName' => $fullDateName,
            'skippedData' => $skippedData,
        ])

        ->setPaper('a4', 'landscape');

        return $pdf->stream($filename);
    }
}
