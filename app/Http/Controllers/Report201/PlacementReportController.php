<?php

namespace App\Http\Controllers\Report201;

use App\Http\Controllers\Controller;
use App\Models\PersonalData;
use App\Models\ProfileLibTblEducDegree;
use App\Models\ProfileLibTblExpertiseSpec;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PlacementReportController extends Controller
{
    // App\Models
    private ProfileLibTblExpertiseSpec $profileLibTblExpertiseSpec;
    private ProfileLibTblEducDegree $profileLibTblEducDegree;

    public function __construct()
    {
        $this->profileLibTblExpertiseSpec = new ProfileLibTblExpertiseSpec();
        $this->profileLibTblEducDegree = new ProfileLibTblEducDegree();
    }

    public function index(Request $request)
    {
        $sortBy = $request->input('sortBy', 'lastname'); // Default sorting we_date.
        $sortOrder = $request->input('sortOrder', 'asc'); // Default sorting order

        $expertise = $request->input('expertise');
        $degree = $request->input('degree');
    
        $personalData = PersonalData::query()
        ->whereIn('status', ['Active', 'Retired'])
        ->whereHas('cesStatus', function ($query) {
            $query->where('description', 'LIKE', '%Eli%')
            ->orWhere('description', 'LIKE', '%CES%');
        })
        ->when($expertise, function ($query) use ($expertise) {
            return $query->whereHas('expertise', function ($q) use($expertise) {
                $q->where('SpeExp_Code', $expertise);
            });
        })
        ->when($degree, function ($query) use ($degree) {
            return $query->whereHas('educations', function ($q) use($degree) {
                $q->where('degree_code', $degree);
            });
        })
        ->when($expertise == null || $degree == null, function ($query) {
            return $query->with('expertise','educations');
        })
        ->orderBy($sortBy, $sortOrder)
        ->paginate(25);

        return view('admin.201_profiling.reports.report_for_placement.index', [
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
            'expertised' => $expertise,
            'degree' => $degree,
            'personalData' => $personalData,
            'profileTblExpertise' => $this->profileLibTblExpertiseSpec->expertiseLibrary(),
            'profileLibTblEducDegree' => $this->profileLibTblEducDegree->educationDegreeLibrary(),
        ]);
    }

    public function generateDownloadLinks(Request $request)
    {
        $sortBy = $request->input('sortBy', 'lastname'); // Default sorting we_date.
        $sortOrder = $request->input('sortOrder', 'asc'); // Default sorting order

        $expertise = $request->input('expertise');
        $degree = $request->input('degree');

        // Set default values of null if expertise and degree are not present in the request
        $expertise = $expertise ?? 0;
        $degree = $degree ?? 0;

        $personalData = PersonalData::query()
        ->whereIn('status', ['Active', 'Retired'])
        ->whereHas('cesStatus', function ($query) {
            $query->where('description', 'LIKE', '%Eli%')
            ->orWhere('description', 'LIKE', '%CES%');
        })
        ->when($expertise, function ($query) use ($expertise) {
            return $query->whereHas('expertise', function ($q) use($expertise) {
                $q->where('SpeExp_Code', $expertise);
            });
        })
        ->when($degree, function ($query) use ($degree) {
            return $query->whereHas('educations', function ($q) use($degree) {
                $q->where('degree_code', $degree);
            });
        })
        ->when($expertise == 0 || $degree == 0, function ($query) {
            return $query->with('expertise','educations');
        })
        ->orderBy($sortBy, $sortOrder);

        // Set the maximum number of records per partition
        $recordsPerPartition = 500;

        $totalData = $personalData->count();
        $totalParts = ceil($totalData/$recordsPerPartition);

        // number of partitions
        $partitionNumber = 0;

        // number of data that will be skipped
        $skippedData = 0;

        // Initialize an array to store download links
        $downloadLinks = [];

        // Chunk the results based on the defined limit (don't remove the &$downloadLinks, $recordsPerPartition, $partitionNumber, $skippedData; 
        // the other parameter here is based on your applied filters change it according to your needs)
        $personalData->chunk($recordsPerPartition, function ($partition) use (&$downloadLinks, $recordsPerPartition, &$partitionNumber, &$skippedData, $sortBy, $sortOrder, $expertise, $degree, $totalParts) {

            // calculating how many data should be skipped for this partition
            $skippedData = $recordsPerPartition * $partitionNumber;

            // incrementing the partition number
            $partitionNumber++;

            // filename for this partition (concatinate the partition number as part number)
            $filename = '201-profiling-reports-for-placement'.$partitionNumber.'.pdf';

            // Create a route to handle the download action for each partition
            // don't remove the $recordsPerPartition, $partitionNumber, $skippedData, $filename
            $downloadRoute = route('reports-for-placement.generatePdfReport', 
                                ['recordsPerPartition' => $recordsPerPartition, 'partitionNumber' => $partitionNumber, 'skippedData' => $skippedData, 'filename' => $filename, 'sortBy' => $sortBy, 'sortOrder' => $sortOrder, 'expertise' => $expertise, 'degree' => $degree, 'totalParts' => $totalParts]);

            // Store the download link in the array
            $downloadLinks[] = [
                'url' => $downloadRoute,
                'label' => '201 Profiling Reports for Placement Part '.$partitionNumber,
            ];

        });

        // Pass the download links to the next download page
        return view('admin/201_profiling/reports/report_for_placement/download_report', compact('downloadLinks'));
    }

    public function generatePdfReport(Request $request,  $totalParts, $recordsPerPartition, $partitionNumber, $skippedData, $filename, $sortBy, $sortOrder, $expertise, $degree)
    {
        $personalData = PersonalData::query()
        ->whereIn('status', ['Active', 'Retired'])
        ->whereHas('cesStatus', function ($query) {
            $query->where('description', 'LIKE', '%Eli%')
            ->orWhere('description', 'LIKE', '%CES%');
        })
        ->when($expertise, function ($query) use ($expertise) {
            return $query->whereHas('expertise', function ($q) use($expertise) {
                $q->where('SpeExp_Code', $expertise);
            });
        })
        ->when($degree, function ($query) use ($degree) {
            return $query->whereHas('educations', function ($q) use($degree) {
                $q->where('degree_code', $degree);
            });
        })
        ->when(!$expertise || !$degree, function ($query) {
            return $query->with('expertise','educations');
        })
        ->orderBy($sortBy, $sortOrder);

        // getting the data and applying the skipped data and records per partition to get the correct part of the report
        $personalData = $personalData->skip($skippedData)->take($recordsPerPartition)->get();
        
        $pdf = App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('admin.201_profiling.reports.report_for_placement.report', 
        compact(
            'personalData',
            'sortBy',
            'sortOrder',
            'expertise',
            'degree',
            'skippedData',
            'totalParts',
            'partitionNumber',
        ))
        ->setPaper('a4', 'portrait');

        return $pdf->stream($filename);
    }
}
