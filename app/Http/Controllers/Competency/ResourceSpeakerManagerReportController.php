<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\ResourceSpeaker;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


class ResourceSpeakerManagerReportController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('expertise');

        $expertise = ResourceSpeaker::distinct()->get(['expertise']);

        if($search == null || $search == 'all')
        {
            $resourceSpeaker = ResourceSpeaker::paginate(25);
        }
        else
        {
            $resourceSpeaker = ResourceSpeaker::query()->where('expertise', $search)->paginate(25);
        }
    
        return view('admin.competency.reports.resource_speaker_manager.report', compact('resourceSpeaker', 'expertise', 'search'));
    }

    public function generateReport(Request $request, $recordsPerPartition, $partitionNumber, $skippedData, $filename, $expertise)
    {
        $expertise = $expertise ?? 'all';

        if($expertise == null || $expertise == 'all')
        {
            $resourceSpeaker = ResourceSpeaker::query();
        }
        else
        {
            $resourceSpeaker = ResourceSpeaker::query()->where('expertise', $expertise);
        }

        // getting the data and applying the skipped data and records per partition to get the correct part of the report
        $resourceSpeaker = $resourceSpeaker->skip($skippedData)->take($recordsPerPartition)->get();
   
        $pdf = Pdf::loadView('admin.competency.reports.resource_speaker_manager.report_pdf', 
        compact(
            'resourceSpeaker'
        ))
        ->setPaper('a4', 'landscape');

        return $pdf->stream($filename);
    }

    public function generateDownloadLinks(Request $request)
    {
        $expertise = $request->input('expertise');

        $expertise = $expertise ?? 'all';

        if($expertise == 'all')
        {
            $resourceSpeaker = ResourceSpeaker::query();
        }
        else
        {
            $resourceSpeaker = ResourceSpeaker::query()->where('expertise', $expertise);
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
        $resourceSpeaker->chunk($recordsPerPartition, function ($partition) use (&$downloadLinks, $recordsPerPartition, &$partitionNumber, &$skippedData, $expertise) {

            // calculating how many data should be skipped for this partition
            $skippedData = $recordsPerPartition * $partitionNumber;

            // incrementing the partition number
            $partitionNumber++;

            // filename for this partition (concatinate the partition number as part number)
            $filename = 'competency-resource-speaker-reports-part'.$partitionNumber.'.pdf';

            // Create a route to handle the download action for each partition
            // don't remove the $recordsPerPartition, $partitionNumber, $skippedData, $filename
            $downloadRoute = route('competency-management-sub-modules-report.resourceSpeakerGenerateReport', 
                                ['recordsPerPartition' => $recordsPerPartition, 'partitionNumber' => $partitionNumber, 'skippedData' => $skippedData, 'filename' => $filename, 'expertise' => $expertise]);

            // Store the download link in the array
            $downloadLinks[] = [
                'url' => $downloadRoute,
                'label' => 'Competency Resource Speaker Reports Part '.$partitionNumber,
            ];
        });

        // Pass the download links to the next download page
        return view('admin.competency.reports.resource_speaker_manager.download_reports', compact('downloadLinks'));
    }
}
