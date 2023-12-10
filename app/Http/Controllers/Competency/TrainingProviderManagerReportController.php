<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\CompetencyTrainingProvider;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class TrainingProviderManagerReportController extends Controller
{
    public function index()
    {
        $competencyTrainingProvider = CompetencyTrainingProvider::select(
            'providerID', 
            'provider', 
            'house_bldg', 
            'st_road', 
            'brgy_vill', 
            'city_code', 
            'contactno', 
            'emailadd', 
            'contactperson'
        )
        ->orderBy('provider', 'asc')
        ->paginate(25);

        return view('admin.competency.reports.training_provider_manager.report', compact('competencyTrainingProvider'));
    }

    public function generatePDF($totalParts, $recordsPerPartition, $partitionNumber, $skippedData, $filename,)
    {
        $fullDateName = Carbon::now()->format('d  F  Y'); // getting full name attribute of the month example: 01 December 2023
        
        $competencyTrainingProvider = CompetencyTrainingProvider::query()
        ->select(
            'providerID', 
            'provider', 
            'house_bldg', 
            'st_road', 
            'brgy_vill', 
            'city_code', 
            'contactno', 
            'emailadd', 
            'contactperson'
        )
        ->orderBy('provider', 'asc');

        // getting the data and applying the skipped data and records per partition to get the correct part of the report
        $competencyTrainingProvider = $competencyTrainingProvider->skip($skippedData)->take($recordsPerPartition)->get();

        $pdf = App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('admin.competency.reports.training_provider_manager.report_pdf', 
        compact(
            'competencyTrainingProvider',
            'totalParts',
            'partitionNumber',
            'skippedData',
            'fullDateName'
        ))
        ->setPaper('a4', 'landscape');

        return $pdf->stream($filename);
    }

    public function generateDownloadLinks()
    {
        $competencyTrainingProvider = CompetencyTrainingProvider::query()
        ->select(
            'providerID', 
            'provider', 
            'house_bldg', 
            'st_road', 
            'brgy_vill', 
            'city_code', 
            'contactno', 
            'emailadd', 
            'contactperson'
        )
        ->orderBy('provider', 'asc');

        // Set the maximum number of records per partition
        $recordsPerPartition = 500;

        $totalData = $competencyTrainingProvider->count();
        $totalParts = ceil($totalData/$recordsPerPartition);

        // number of partitions
        $partitionNumber = 0;

        // number of data that will be skipped
        $skippedData = 0;

        // Initialize an array to store download links
        $downloadLinks = [];

        // Chunk the results based on the defined limit (don't remove the &$downloadLinks, $recordsPerPartition, $partitionNumber, $skippedData; 
        // the other parameter here is based on your applied filters change it according to your needs)
        $competencyTrainingProvider->chunk($recordsPerPartition, function ($partition) use (&$downloadLinks, $recordsPerPartition, &$partitionNumber, &$skippedData, $totalParts) 
        {
            // calculating how many data should be skipped for this partition
            $skippedData = $recordsPerPartition * $partitionNumber;

            // incrementing the partition number
            $partitionNumber++;

            // filename for this partition (concatinate the partition number as part number)
            $filename = '201-profiling-general-reports-part'.$partitionNumber.'.pdf';

            // Create a route to handle the download action for each partition
            // don't remove the $recordsPerPartition, $partitionNumber, $skippedData, $filename
            $downloadRoute = route('competency-management-sub-modules-report.trainingProviderGenerateReport', 
                                ['recordsPerPartition' => $recordsPerPartition, 'partitionNumber' => $partitionNumber, 'skippedData' => $skippedData, 'filename' => $filename, 'totalParts' => $totalParts]);

            // Store the download link in the array
            $downloadLinks[] = [
                'url' => $downloadRoute,
                'label' => '201 Profiling General Reports Part '.$partitionNumber,
            ];
        });

        // Pass the download links to the next download page
        return view('admin.competency.reports.training_provider_manager.download_reports', compact('downloadLinks'));
    }
}
