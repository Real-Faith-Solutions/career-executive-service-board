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

        $writtenExam->leftJoin('erad_tblMain', 'erad_tblMain.acno', '=', 'erad_tblWExam.acno')
        ->select('erad_tblWExam.*')
        ->with('erisTblMainWrittenExam');

        $writtenExam->where(function ($query) use ($passed, $failed, $location, $retake) {
            if ($passed && $failed && $location) {
                $query->whereIn('erad_tblWExam.we_remarks', [$passed, $failed])
                    ->where('erad_tblWExam.we_location', $location);
            }
            elseif($passed && $failed && $retake)
            {
                $query->whereIn('erad_tblWExam.we_remarks', [$passed, $failed])
                        ->where('erad_tblWExam.numtakes', '>', '1');
            }
            elseif($passed && $failed)
            {
                $query->whereIn('erad_tblWExam.we_remarks', [$passed, $failed]);
            }
            else 
            {
                if ($passed) {
                    $query->where('erad_tblWExam.we_remarks', $passed);
                }

                if ($failed) {
                    $query->where('erad_tblWExam.we_remarks', $failed);
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

    public function generateReportPdf(Request $request, $recordsPerPartition, $partitionNumber, $skippedData, $filename, $sortBy, $sortOrder)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $passed = $request->input('passed');
        $failed = $request->input('failed');
        $retake = $request->input('retake');
        $location = $request->input('location');

        $writtenExam = WrittenExam::query();

        $writtenExam->leftJoin('erad_tblMain', 'erad_tblMain.acno', '=', 'erad_tblWExam.acno')
        ->select('erad_tblWExam.*')
        ->with('erisTblMainWrittenExam');

        $writtenExam->where(function ($query) use ($passed, $failed, $location, $retake) {
            if ($passed && $failed && $location) {
                $query->whereIn('erad_tblWExam.we_remarks', [$passed, $failed])
                    ->where('erad_tblWExam.we_location', $location);
            }
            elseif($passed && $failed && $retake)
            {
                $query->whereIn('erad_tblWExam.we_remarks', [$passed, $failed])
                        ->where('erad_tblWExam.numtakes', '>', '1');
            }
            elseif($passed && $failed)
            {
                $query->whereIn('erad_tblWExam.we_remarks', [$passed, $failed]);
            }
            else 
            {
                if ($passed) {
                    $query->where('erad_tblWExam.we_remarks', $passed);
                }

                if ($failed) {
                    $query->where('erad_tblWExam.we_remarks', $failed);
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

        $pdf = Pdf::loadView('admin.eris.reports.written_exam.report_pdf', [
            'writtenExam' => $writtenExam,
        ])

        ->setPaper('a4', 'landscape');

        return $pdf->stream($filename);
    }

    public function generateDownloadLinks(Request $request, $sortBy, $sortOrder,)
    {
        $sortBy = $sortBy ?? 'we_date';
        $sortOrder = $sortOrder ?? 'desc';

        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $passed = $request->input('passed');
        $failed = $request->input('failed');
        $retake = $request->input('retake');
        $location = $request->input('location');

        $writtenExam = WrittenExam::query();

        $writtenExam->leftJoin('erad_tblMain', 'erad_tblMain.acno', '=', 'erad_tblWExam.acno')
        ->select('erad_tblWExam.*')
        ->with('erisTblMainWrittenExam');

        $writtenExam->where(function ($query) use ($passed, $failed, $location, $retake) {
            if ($passed && $failed && $location) {
                $query->whereIn('erad_tblWExam.we_remarks', [$passed, $failed])
                    ->where('erad_tblWExam.we_location', $location);
            }
            elseif($passed && $failed && $retake)
            {
                $query->whereIn('erad_tblWExam.we_remarks', [$passed, $failed])
                        ->where('erad_tblWExam.numtakes', '>', '1');
            }
            elseif($passed && $failed)
            {
                $query->whereIn('erad_tblWExam.we_remarks', [$passed, $failed]);
            }
            else 
            {
                if ($passed) {
                    $query->where('erad_tblWExam.we_remarks', $passed);
                }

                if ($failed) {
                    $query->where('erad_tblWExam.we_remarks', $failed);
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

        // number of data that will be skipped
        $skippedData = 0;

        // Initialize an array to store download links
        $downloadLinks = [];

        // Chunk the results based on the defined limit (don't remove the &$downloadLinks, $recordsPerPartition, $partitionNumber, $skippedData; 
        // the other parameter here is based on your applied filters change it according to your needs)
        $writtenExam->chunk($recordsPerPartition, function ($partition) use (&$downloadLinks, $recordsPerPartition, &$partitionNumber, &$skippedData, $sortBy, $sortOrder, $startDate, $endDate, $passed, $failed, $retake, $location) {

            // calculating how many data should be skipped for this partition
            $skippedData = $recordsPerPartition * $partitionNumber;

            // incrementing the partition number
            $partitionNumber++;

            // filename for this partition (concatinate the partition number as part number)
            $filename = 'eris-written-exam-reports-part'.$partitionNumber.'.pdf';

            // Create a route to handle the download action for each partition
            // don't remove the $recordsPerPartition, $partitionNumber, $skippedData, $filename
            $downloadRoute = route('written-exam-report.generateReportPdf', 
                                ['recordsPerPartition' => $recordsPerPartition, 'partitionNumber' => $partitionNumber, 'skippedData' => $skippedData, 'filename' => $filename, 'sortBy' => $sortBy, 'sortOrder' => $sortOrder, 'startDate' => $startDate, 'endDate' => $endDate, 'passed' => $passed, 'failed' => $failed, 'retake' => $retake, 'location' => $location]);

            // Store the download link in the array
            $downloadLinks[] = [
                'url' => $downloadRoute,
                'label' => 'ERIS - Written Exam Reports Part '.$partitionNumber,
            ];
        });

        // Pass the download links to the next download page
        return view('admin.eris.reports.written_exam.download_reports', compact('downloadLinks'));
    }
}
