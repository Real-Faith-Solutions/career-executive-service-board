<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\ResourceSpeaker;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ResourceSpeakerManagerReportController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('expertise');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        // dd($startDate, $endDate);

        $expertise = ResourceSpeaker::distinct()->get(['expertise']);
        
        $resourceSpeaker = ResourceSpeaker::query()
        ->with('trainingEngagement')
        ->when($search, function ($query) use ($search) {
            return $query->where('expertise', $search);
        })
        ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
            return $query->whereHas('trainingEngagement', function ($q) use($startDate, $endDate) {
                $q->whereBetween(DB::raw('CAST(from_dt AS DATE)'), [$startDate, $endDate])
                ->whereBetween(DB::raw('CAST(to_dt AS DATE)'), [$startDate, $endDate]);
            });
        })
        ->orderBy('lastname')
        ->paginate(25);
        
        return view('admin.competency.reports.resource_speaker_manager.report', 
        compact(
            'resourceSpeaker', 
            'expertise', 
            'search',
            'startDate',
            'endDate',
        ));
    }

    public function generateReport(Request $request, $totalParts, $recordsPerPartition, $partitionNumber, $skippedData, $filename, $expertise, $startDate, $endDate)
    {
        $expertise = $expertise ?? 'all';
        $startDate = $startDate ?? '0';
        $endDate = $endDate ?? '0';
        
        $fullDateName = Carbon::now()->format('d F Y'); // getting full name attribute of the month example: 01 December 2023

        $resourceSpeaker = ResourceSpeaker::query()
        ->with('trainingEngagement')
        ->when($expertise != 'all', function ($query) use ($expertise) {
            return $query->where('expertise', $expertise);
        })
        ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
            return $query->whereHas('trainingEngagement', function ($q) use($startDate, $endDate) {
                $q->whereBetween(DB::raw('CAST(from_dt AS DATE)'), [$startDate, $endDate])
                ->whereBetween(DB::raw('CAST(to_dt AS DATE)'), [$startDate, $endDate]);
            });
        })
        ->orderBy('lastname');

        // getting the data and applying the skipped data and records per partition to get the correct part of the report
        $resourceSpeaker = $resourceSpeaker->skip($skippedData)->take($recordsPerPartition)->get();
   
        $pdf = App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('admin.competency.reports.resource_speaker_manager.report_pdf', 
        compact(
            'resourceSpeaker',
            'fullDateName',
            'totalParts',
            'partitionNumber',
            'skippedData',
            'startDate',
            'endDate',
        ))
        ->setPaper('a4', 'landscape');

        return $pdf->stream($filename);
    }

    public function generateDownloadLinks(Request $request)
    {
        $expertise = $request->input('expertise');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        // dd($startDate, $endDate);

        $expertise = $expertise ?? 'all';
        $startDate = $startDate ?? '0';
        $endDate = $endDate ?? '0';

        $resourceSpeaker = ResourceSpeaker::query()
        ->with('trainingEngagement')
        ->when($expertise != 'all', function ($query) use ($expertise) {
            return $query->where('expertise', $expertise);
        })
        ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
            return $query->whereHas('trainingEngagement', function ($q) use($startDate, $endDate) {
                $q->whereBetween(DB::raw('CAST(from_dt AS DATE)'), [$startDate, $endDate])
                ->whereBetween(DB::raw('CAST(to_dt AS DATE)'), [$startDate, $endDate]);
            });
        })
        ->orderBy('lastname');

        // Set the maximum number of records per partition
        $recordsPerPartition = 500;

        $totalData = $resourceSpeaker->count();
        $totalParts = ceil($totalData/$recordsPerPartition);

        // number of partitions
        $partitionNumber = 0;

        // number of data that will be skipped
        $skippedData = 0;

        // Initialize an array to store download links
        $downloadLinks = [];

        // Chunk the results based on the defined limit (don't remove the &$downloadLinks, $recordsPerPartition, $partitionNumber, $skippedData; 
        // the other parameter here is based on your applied filters change it according to your needs)
        $resourceSpeaker->chunk($recordsPerPartition, function ($partition) use (&$downloadLinks, $recordsPerPartition, &$partitionNumber, &$skippedData, $expertise, $totalParts, $startDate, $endDate) {

            // calculating how many data should be skipped for this partition
            $skippedData = $recordsPerPartition * $partitionNumber;

            // incrementing the partition number
            $partitionNumber++;

            // filename for this partition (concatinate the partition number as part number)
            $filename = 'competency-resource-speaker-reports-part'.$partitionNumber.'.pdf';

            // Create a route to handle the download action for each partition
            // don't remove the $recordsPerPartition, $partitionNumber, $skippedData, $filename
            $downloadRoute = route('competency-management-sub-modules-report.resourceSpeakerGenerateReport', 
                                ['recordsPerPartition' => $recordsPerPartition, 'partitionNumber' => $partitionNumber, 'skippedData' => $skippedData, 'filename' => $filename, 'expertise' => $expertise, 'totalParts' => $totalParts, 'startDate' => $startDate, 'endDate' => $endDate]);

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
