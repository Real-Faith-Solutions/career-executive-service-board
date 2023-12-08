<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\CompetencyTrainingVenueManager;
use App\Models\ProfileLibCities;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TrainingVenueManagerReportController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // search query for personal data
        $searchProfileLibCities = ProfileLibCities::query()
            ->where('name', "LIKE" ,"%$search%")
            ->get();

        if ($search !== null) 
        {
            // Query the database to find the corresponding city
            $profileLibCitiesSearchResult = ProfileLibCities::where('name', $search)->first();

            if (!$profileLibCitiesSearchResult) 
            {
                // Handle the case where the data does not exist
                return redirect()->route('competency-management-sub-modules-report.trainingVenueManagerReportIndex')
                ->with('error', 'Data not found in the database.');
            }

            $trainingVenueManager = CompetencyTrainingVenueManager::select('name', 'no_street', 'brgy', 'city_code', 'contactno', 'emailadd', 'contactperson')
            ->where('city_code', $profileLibCitiesSearchResult->city_code)
            ->paginate(25);  
        }
        else
        {
            $trainingVenueManager = CompetencyTrainingVenueManager::select('name', 'no_street', 'brgy', 'city_code', 'contactno', 'emailadd', 'contactperson')
            ->paginate(25);
        }

        return view('admin.competency.reports.training_venue_manager.report', compact('trainingVenueManager','searchProfileLibCities', 'search'));
    }

    public function generatePdf(Request $request, $recordsPerPartition, $partitionNumber, $skippedData, $filename, $search)
    {
        $search = $search ?? 'all';

        // dd($search);

        $profileLibCitiesSearchResult = ProfileLibCities::where('name', $search)->first();

        if($profileLibCitiesSearchResult != null)
        {
            $trainingVenueManagerByCity = CompetencyTrainingVenueManager::query()->where('city_code', $profileLibCitiesSearchResult->city_code);
        }
        else
        {
            // get all venues
            $trainingVenueManagerByCity = CompetencyTrainingVenueManager::query();
        }

        // getting the data and applying the skipped data and records per partition to get the correct part of the report
        $trainingVenueManagerByCity = $trainingVenueManagerByCity->skip($skippedData)->take($recordsPerPartition)->get();
               
        $pdf = Pdf::loadView('admin.competency.reports.training_venue_manager.report_pdf_city', 
        compact(
            'trainingVenueManagerByCity', 
            'search'
        ))
        ->setPaper('a4', 'landscape');

        return $pdf->stream($filename);
    }

    public function generateDownloadLinks(Request $request)
    {
        $search = $request->input('search');

        $search = $search ?? 'all';

        $profileLibCitiesSearchResult = ProfileLibCities::where('name', $search)->first();

        if($profileLibCitiesSearchResult != null)
        {
            $trainingVenueManagerByCity = CompetencyTrainingVenueManager::query()->where('city_code', $profileLibCitiesSearchResult->city_code);
        }
        else
        {
            // get all venues
            $trainingVenueManagerByCity = CompetencyTrainingVenueManager::query();
        }

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
        $trainingVenueManagerByCity->chunk($recordsPerPartition, function ($partition) use (&$downloadLinks, $recordsPerPartition, &$partitionNumber, &$skippedData, $search) {

            // calculating how many data should be skipped for this partition
            $skippedData = $recordsPerPartition * $partitionNumber;

            // incrementing the partition number
            $partitionNumber++;

            // filename for this partition (concatinate the partition number as part number)
            $filename = 'competency-training-venue-manager-reports-part'.$partitionNumber.'.pdf';

            // Create a route to handle the download action for each partition
            // don't remove the $recordsPerPartition, $partitionNumber, $skippedData, $filename
            $downloadRoute = route('competency-management-sub-modules-report.trainingVenueManagerReportGeneratePdf', 
                                ['recordsPerPartition' => $recordsPerPartition, 'partitionNumber' => $partitionNumber, 'skippedData' => $skippedData, 'filename' => $filename, 'search' => $search]);

            // Store the download link in the array
            $downloadLinks[] = [
                'url' => $downloadRoute,
                'label' => 'Competency Training Venue Manager Reports Part '.$partitionNumber,
            ];
        });

        // Pass the download links to the next download page
        return view('admin.competency.reports.training_venue_manager.download_reports', compact('downloadLinks'));
    }
}
