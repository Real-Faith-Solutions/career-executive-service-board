<?php

namespace App\Http\Controllers\ERIS\report;

use App\Http\Controllers\Controller;
use App\Models\Eris\PanelBoardInterview;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PanelBoardInterviewReportController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->input('sort_by', 'lastname'); // Default sorting by lastname.
        $sortOrder = $request->input('sort_order', 'asc'); // Default sorting order

        $panelBoardInterview = PanelBoardInterview::join('erad_tblMain', 'erad_tblMain.acno', '=', 'erad_tblPBOARD.acno')
        ->select('erad_tblPBOARD.*')
        ->with('erisTblMainPanelBoardInterview')
        ->orderBy($sortBy, $sortOrder)
        ->paginate(25);

        return view('admin.eris.reports.board_panel_interview_report.panel_board_interview_report.index', 
        compact(
            'panelBoardInterview', 
            'sortBy',
            'sortOrder',
        ));
    }

    public function generateReportPdf(Request $request, $recordsPerPartition, $partitionNumber, $skippedData, $filename,
    $sortBy, $sortOrder)
    {
        $sortBy = $sortBy ?? 'lastname';
        $sortOrder = $sortOrder ?? 'asc';

        // $sortBy = $request->input('sort_by', 'lastname'); // Default sorting by lastname.
        // $sortOrder = $request->input('sort_order', 'asc'); // Default sorting order

        $panelBoardInterview = PanelBoardInterview::query()
        ->join('erad_tblMain', 'erad_tblMain.acno', '=', 'erad_tblPBOARD.acno')
        ->select('erad_tblPBOARD.*')
        ->with('erisTblMainPanelBoardInterview')
        ->orderBy($sortBy, $sortOrder);

        // getting the data and applying the skipped data and records per partition to get the correct part of the report
        $panelBoardInterview = $panelBoardInterview->skip($skippedData)->take($recordsPerPartition)->get();

        $pdf = Pdf::loadView('admin.eris.reports.board_panel_interview_report.panel_board_interview_report.report_pdf', [
            'panelBoardInterview' => $panelBoardInterview, 
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
        ])
        ->setPaper('a4', 'portrait');

        return $pdf->stream($filename);
    }

    public function generateDownloadLinks(Request $request, $sortBy, $sortOrder)
    {
        $sortBy = $sortBy ?? 'lastname';
        $sortOrder = $sortOrder ?? 'asc';

        $panelBoardInterview = PanelBoardInterview::query()
        ->join('erad_tblMain', 'erad_tblMain.acno', '=', 'erad_tblPBOARD.acno')
        ->select('erad_tblPBOARD.*')
        ->with('erisTblMainPanelBoardInterview')
        ->orderBy($sortBy, $sortOrder);

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
        $panelBoardInterview->chunk($recordsPerPartition, function ($partition) use (&$downloadLinks, $recordsPerPartition, &$partitionNumber, &$skippedData, $sortBy, $sortOrder) {

            // calculating how many data should be skipped for this partition
            $skippedData = $recordsPerPartition * $partitionNumber;

            // incrementing the partition number
            $partitionNumber++;

            // filename for this partition (concatinate the partition number as part number)
            $filename = 'eris-panel-board-interview-reports-part'.$partitionNumber.'.pdf';

            // Create a route to handle the download action for each partition
            // don't remove the $recordsPerPartition, $partitionNumber, $skippedData, $filename
            $downloadRoute = route('panel-board-interview-report.generateReportPdf', 
                                ['recordsPerPartition' => $recordsPerPartition, 'partitionNumber' => $partitionNumber, 'skippedData' => $skippedData, 'filename' => $filename, 'sortBy' => $sortBy, 'sortOrder' => $sortOrder]);

            // Store the download link in the array
            $downloadLinks[] = [
                'url' => $downloadRoute,
                'label' => 'ERIS Panel Board Interview Reports Part '.$partitionNumber,
            ];
        });

        // Pass the download links to the next download page
        return view('admin.eris.reports.board_panel_interview_report.panel_board_interview_report.download_reports', compact('downloadLinks'));
    }
}
