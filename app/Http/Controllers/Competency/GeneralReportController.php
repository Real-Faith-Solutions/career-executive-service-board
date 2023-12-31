<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\TrainingParticipants;
use App\Models\TrainingSession;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class GeneralReportController extends Controller
{
    public function index()
    {
        $trainingSession = TrainingSession::orderBy('sessionid', 'desc')->paginate(25);

        return view('admin.competency.reports.general_report.training_participants', compact('trainingSession'));
    }

    // generate download link
    public function generateDownloadLinks($sessionId)
    {
        $trainingParticipantList = TrainingParticipants::query()->where('sessionid', $sessionId);
        
        // Set the maximum number of records per partition
        $recordsPerPartition = 500;

        $totalData = $trainingParticipantList->count();
        $totalParts = ceil($totalData/$recordsPerPartition);

        // number of partitions
        $partitionNumber = 0;

        // number of data that will be skipped
        $skippedData = 0;

        // Initialize an array to store download links
        $downloadLinks = [];

        // Chunk the results based on the defined limit (don't remove the &$downloadLinks, $recordsPerPartition, $partitionNumber, $skippedData; 
        // the other parameter here is based on your applied filters change it according to your needs)
        $trainingParticipantList->chunk($recordsPerPartition, function ($partition) use (&$downloadLinks, $recordsPerPartition, &$partitionNumber, &$skippedData, $sessionId, $totalParts) {

            // calculating how many data should be skipped for this partition
            $skippedData = $recordsPerPartition * $partitionNumber;

            // incrementing the partition number
            $partitionNumber++;

            // filename for this partition (concatinate the partition number as part number)
            $filename = 'competency-general-reports-part'.$partitionNumber.'.pdf';

            // Create a route to handle the download action for each partition
            // don't remove the $recordsPerPartition, $partitionNumber, $skippedData, $filename
            $downloadRoute = route('competency-management-sub-modules-report.generalReportGeneratePdf', 
                                ['recordsPerPartition' => $recordsPerPartition, 'partitionNumber' => $partitionNumber, 'skippedData' => $skippedData, 'filename' => $filename, 'sessionId' => $sessionId, 'totalParts' => $totalParts]);

            // Store the download link in the array
            $downloadLinks[] = [
                'url' => $downloadRoute,
                'label' => 'Competency General Reports Part '.$partitionNumber,
            ];
        });

        // Pass the download links to the next download page
        return view('admin.competency.reports.general_report.download_reports', compact('downloadLinks'));
    }

    // generate pdf report
    public function generatePdf($totalParts, $recordsPerPartition, $partitionNumber, $skippedData, $filename, $sessionId)
    {
        $trainingSession = TrainingSession::find($sessionId);
        $trainingParticipantList = TrainingParticipants::query()->where('sessionid', $sessionId);

        $fullDateName = Carbon::now()->format('d  F  Y'); // getting full name attribute of the month example: 01 December 2023

        // getting the data and applying the skipped data and records per partition to get the correct part of the report
        $trainingParticipantList = $trainingParticipantList->skip($skippedData)->take($recordsPerPartition)->get();

        $pdf = App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('admin.competency.reports.general_report.training_participants_pdf', 
        compact(
            'trainingParticipantList', 
            'trainingSession',
            'totalParts',
            'partitionNumber',
            'skippedData',
            'fullDateName',
        ))
        ->setPaper('a4', 'portrait');

        return $pdf->stream($filename);
    }
}
