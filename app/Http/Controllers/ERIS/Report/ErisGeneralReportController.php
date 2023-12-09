<?php

namespace App\Http\Controllers\ERIS\report;

use App\Http\Controllers\Controller;
use App\Models\Eris\EradTblMain;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ErisGeneralReportController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->input('sortBy', 'lastname'); // Default sorting acdate.
        $sortOrder = $request->input('sortOrder', 'asc'); // Default sorting order

        $conferred = "conferred";

        $eradTblMain = EradTblMain::where('c_status', '!=', $conferred)
            ->orderBy($sortBy, $sortOrder)
            ->paginate(25);

        return view('admin.eris.reports.general_report.report', [
            'eradTblMain' => $eradTblMain,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
        ]);
    }

    public function generateDownloadLinks($sortBy, $sortOrder)
    {
        $sortBy = $sortBy ?? 'lastname';
        $sortOrder = $sortOrder ?? 'asc';

        $conferred = "conferred";

        $eradTblMain = EradTblMain::where('c_status', '!=', $conferred)
            ->orderBy($sortBy,$sortOrder);

        // Set the maximum number of records per partition
        $recordsPerPartition = 500;

        $totalData = $eradTblMain->count();
        $totalParts = ceil($totalData/$recordsPerPartition);

        // number of partitions
        $partitionNumber = 0;

        // number of data that will be skipped
        $skippedData = 0;

        // Initialize an array to store download links
        $downloadLinks = [];

        // Chunk the results based on the defined limit (don't remove the &$downloadLinks, $recordsPerPartition, $partitionNumber, $skippedData; 
        // the other parameter here is based on your applied filters change it according to your needs)
        $eradTblMain->chunk($recordsPerPartition, function ($partition) use (&$downloadLinks, $recordsPerPartition, &$partitionNumber, &$skippedData, $sortBy, $sortOrder, $totalParts) {

            // calculating how many data should be skipped for this partition
            $skippedData = $recordsPerPartition * $partitionNumber;

            // incrementing the partition number
            $partitionNumber++;

            // filename for this partition (concatinate the partition number as part number)
            $filename = 'eris-general-reports-part'.$partitionNumber.'.pdf';

            // Create a route to handle the download action for each partition
            // don't remove the $recordsPerPartition, $partitionNumber, $skippedData, $filename
            $downloadRoute = route('general-report.generatePdfReport', 
                                ['recordsPerPartition' => $recordsPerPartition, 'partitionNumber' => $partitionNumber, 'skippedData' => $skippedData, 'filename' => $filename, 'sortBy' => $sortBy, 'sortOrder' => $sortOrder, 'totalParts' => $totalParts]);

            // Store the download link in the array
            $downloadLinks[] = [
                'url' => $downloadRoute,
                'label' => 'ERIS General Reports Part '.$partitionNumber,
            ];
        });

        // Pass the download links to the next download page
        return view('admin.eris.reports.general_report.download_reports', compact('downloadLinks'));
    }

    public function generatePdfReport($totalParts, $recordsPerPartition, $partitionNumber, $skippedData, $filename,$sortBy, $sortOrder)
    {
        $conferred = "conferred";

        $eradTblMain = EradTblMain::where('c_status', '!=', $conferred)
            ->orderBy($sortBy,$sortOrder);

        // getting the data and applying the skipped data and records per partition to get the correct part of the report
        $eradTblMain = $eradTblMain->skip($skippedData)->take($recordsPerPartition)->get();

        $pdf = App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('admin.eris.reports.general_report.report_pdf', [
            'eradTblMain' => $eradTblMain,
            'totalParts' => $totalParts,
            'partitionNumber' => $partitionNumber,
        ])
        ->setPaper('a4', 'landscape');

        return $pdf->stream($filename);
    }
}
