<?php

namespace App\Http\Controllers\Report201;

use App\Http\Controllers\Controller;
use App\Models\PersonalData;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class BirthdayCardReportController extends Controller
{
    // fetching all users has birthday today
    public function index()
    {
        $fullDateName = Carbon::now()->format('l, F, d, Y'); // getting full name attribute of the month example: Friday, December 01, 2023
        $currentMonthInNumber = Carbon::now()->format('m'); // getting month in number example: 12 = December
        $specificDay = Carbon::now()->format('d'); // getting current day example: 01 of December
    
        $personalData = PersonalData::query()
                        ->with('cesStatus')
                        ->where('status', '=', 'Active')
                        ->whereMonth('birthdate', '=', $currentMonthInNumber)
                        ->whereDay('birthdate', '=', $specificDay)
                        ->whereHas('cesStatus', function ($query) {
                            $query->where('description', 'LIKE', '%Eli%')
                                ->orWhere('description', 'LIKE', '%CES%');
                        })
                        ->orderBy('lastname')
                        ->paginate(25);

        $numberOfCelebrant = PersonalData::query()
                        ->where('status', '=', 'Active')
                        ->whereMonth('birthdate', '=', $currentMonthInNumber)
                        ->whereDay('birthdate', '=', $specificDay)
                        ->whereHas('cesStatus', function ($query) {
                            $query->where('description', 'LIKE', '%Eli%')
                                ->orWhere('description', 'LIKE', '%CES%');
                        })
                        ->count();

        return view('admin.201_profiling.reports.birthday_card.index', [
            'currentMonth' => $currentMonthInNumber,
            'fullDateName' => $fullDateName,  
            'personalData' => $personalData,
            'numberOfCelebrant' => $numberOfCelebrant,
        ]);
    }

    // generate download link for all users has birthday today
    public function generateDownloadLinks()
    {
        $fullDateName = Carbon::now()->format('l, F, d, Y'); // getting full name attribute of the month example: Friday, December 01
        $currentMonthInNumber = Carbon::now()->format('m'); // getting month in number example: 12 = December
        $specificDay = Carbon::now()->format('d'); // getting current day example: 01 of December
    
        $personalData = PersonalData::query()
                        ->with('cesStatus', 'mailingAddress')
                        ->where('status', '=', 'Active')
                        ->whereMonth('birthdate', '=', $currentMonthInNumber)
                        ->whereDay('birthdate', '=', $specificDay)
                        ->whereHas('cesStatus', function ($query) {
                            $query->where('description', 'LIKE', '%Eli%')
                                ->orWhere('description', 'LIKE', '%CES%');
                        })
                        ->orderBy('lastname');

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
        $personalData->chunk($recordsPerPartition, function ($partition) use (&$downloadLinks, $recordsPerPartition, &$partitionNumber, &$skippedData, $fullDateName, $totalParts) {

            // calculating how many data should be skipped for this partition
            $skippedData = $recordsPerPartition * $partitionNumber;

            // incrementing the partition number
            $partitionNumber++;

            // filename for this partition (concatinate the partition number as part number)
            $filename = '201-profiling-birthday-'.$fullDateName.'-reports-part'.$partitionNumber.'.pdf';

            // Create a route to handle the download action for each partition
            // don't remove the $recordsPerPartition, $partitionNumber, $skippedData, $filename
            $downloadRoute = route('birthday.birthdayCelebrantGeneratePdfReport', 
                                ['recordsPerPartition' => $recordsPerPartition, 'partitionNumber' => $partitionNumber, 'skippedData' => $skippedData, 'filename' => $filename, 'totalParts' => $totalParts]);

            // Store the download link in the array
            $downloadLinks[] = [
                'url' => $downloadRoute,
                'label' => '201 Profiling Birthdays for '.$fullDateName.' Reports Part '.$partitionNumber,
            ];

        });

        // Pass the download links to the next download page
        return view('admin.201_profiling.reports.birthday_card.download_reports', compact('downloadLinks', 'fullDateName'));
    }


    // generating pdf for all user has birthday today
    public function birthdayCelebrantGeneratePdfReport($totalParts, $recordsPerPartition, $partitionNumber, $skippedData, $filename,)
    {
        $fullDateName = Carbon::now()->format('l-F-d-Y-'); // getting full name attribute of the month example: Friday, December 01, 2023
        $currentMonthInNumber = Carbon::now()->format('m'); // getting month in number example: 12 = December
        $specificDay = Carbon::now()->format('d'); // getting current day example: 01 of December

        $personalData = PersonalData::query()
            ->with('cesStatus', 'mailingAddress')
            ->where('status', '=', 'Active')
            ->whereMonth('birthdate', '=', $currentMonthInNumber)
            ->whereDay('birthdate', '=', $specificDay)
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%')
                    ->orWhere('description', 'LIKE', '%CES%');
            })
            ->orderBy('lastname');

        // getting the data and applying the skipped data and records per partition to get the correct part of the report
        $personalData = $personalData->skip($skippedData)->take($recordsPerPartition)->get();

        $data = array();
        $pdf = App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf = Pdf::loadView('admin.201_profiling.reports.birthday_card.report_pdf', [
            'personalData' => $personalData,
            'fullDateName' => $fullDateName,
            'totalParts' => $totalParts,
            'partitionNumber' => $partitionNumber,
            '$data' => $data,
        ])
        ->setPaper('a4', 'landscape');

        return $pdf->stream($filename);
    }

    // fetching all users has birthday this month
    public function monthlyCelebrant(Request $request)
    {
        $sortBy = $request->input('sortBy', 'lastname'); // Default sorting birthdate.
        $sortOrder = $request->input('sortOrder', 'asc'); // Default sorting order

        $currentMonthInNumber = Carbon::now()->format('m'); // getting month in number example: 12 = December
        $currentMonthFullName = Carbon::now()->format('F, Y'); // getting month in name example: December = 12
    
        $personalData = PersonalData::query()
            ->with('cesStatus', 'mailingAddress')
            ->where('status', '=', 'Active')
            ->whereMonth('birthdate', '=', $currentMonthInNumber)
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%')
                    ->orWhere('description', 'LIKE', '%CES%');
            })
            ->when($sortBy === 'birthdate', function ($query) use ($sortBy, $sortOrder) {
                return $query->orderByRaw('DAY(CONVERT(DATE, '. $sortBy .'))' . $sortOrder);
            }, function ($query) use ($sortBy, $sortOrder) {
                return $query->orderBy($sortBy, $sortOrder);
            })
            ->paginate(25);

        $numberOfCelebrant = PersonalData::query()
            ->where('status', '=', 'Active')
            ->whereMonth('birthdate', '=', $currentMonthInNumber)
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%')
                    ->orWhere('description', 'LIKE', '%CES%');
            })
            ->count();

        return view('admin.201_profiling.reports.birthday_card.monthly_birthday.index', [
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
            'personalData' => $personalData,
            'currentMonthFullName' => $currentMonthFullName,
            'numberOfCelebrant' => $numberOfCelebrant,
        ]);
    }   

    // generating pdf for all users has birthday this month
    public function monthlyCelebrantGeneratePdfReport($recordsPerPartition, $partitionNumber, $skippedData, $filename, $sortBy, $sortOrder)
    {
        $currentMonthInNumber = Carbon::now()->format('m'); // getting month in number example: 12 = December
        $monthYear = Carbon::now()->format('F-Y-'); // getting full name month and year attribute example: December, 2023

        $personalData = PersonalData::query()
            ->with('cesStatus', 'mailingAddress')
            ->where('status', '=', 'Active')
            ->whereMonth('birthdate', '=', $currentMonthInNumber)
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%')
                    ->orWhere('description', 'LIKE', '%CES%');
            })
            ->when($sortBy === 'birthdate', function ($query) use ($sortBy, $sortOrder) {
                return $query->orderByRaw('DAY(CONVERT(DATE, '. $sortBy .'))' . $sortOrder);
            }, function ($query) use ($sortBy, $sortOrder) {
                return $query->orderBy($sortBy, $sortOrder);
            });
        
        // getting the data and applying the skipped data and records per partition to get the correct part of the report
        $personalData = $personalData->skip($skippedData)->take($recordsPerPartition)->get();

        $pdf = Pdf::loadView('admin.201_profiling.reports.birthday_card.monthly_birthday.report_pdf', [
            'personalData' => $personalData,
            'monthYear' => $monthYear,
        ])
        ->setPaper('a4', 'landscape');

        return $pdf->stream($filename);
    }

    public function monthlyCelebrantGenerateDownloadLinks($sortBy, $sortOrder)
    {
        $sortBy = $sortBy ?? 'lastname';
        $sortOrder = $sortOrder ?? 'asc';

        $currentMonthInNumber = Carbon::now()->format('m'); // getting month in number example: 12 = December
        $currentMonthFullName = Carbon::now()->format('F'); // getting month in name example: December = 12
        $monthYear = Carbon::now()->format('F-Y'); // getting full name month and year attribute example: December, 2023

        $personalData = PersonalData::query()
            ->with('cesStatus', 'mailingAddress')
            ->where('status', '=', 'Active')
            ->whereMonth('birthdate', '=', $currentMonthInNumber)
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%')
                    ->orWhere('description', 'LIKE', '%CES%');
            })
            ->when($sortBy === 'birthdate', function ($query) use ($sortBy, $sortOrder) {
                return $query->orderByRaw('DAY(CONVERT(DATE, '. $sortBy .'))' . $sortOrder);
            }, function ($query) use ($sortBy, $sortOrder) {
                return $query->orderBy($sortBy, $sortOrder);
            });

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
        $personalData->chunk($recordsPerPartition, function ($partition) use (&$downloadLinks, $recordsPerPartition, &$partitionNumber, &$skippedData, $sortBy, $sortOrder, $monthYear) {

            // calculating how many data should be skipped for this partition
            $skippedData = $recordsPerPartition * $partitionNumber;

            // incrementing the partition number
            $partitionNumber++;

            // filename for this partition (concatinate the partition number as part number)
            $filename = '201-profiling-birthday-'.$monthYear.'-reports-part'.$partitionNumber.'.pdf';

            // Create a route to handle the download action for each partition
            // don't remove the $recordsPerPartition, $partitionNumber, $skippedData, $filename
            $downloadRoute = route('birthday.monthlyCelebrantGeneratePdfReport', 
                                ['recordsPerPartition' => $recordsPerPartition, 'partitionNumber' => $partitionNumber, 'skippedData' => $skippedData, 'filename' => $filename, 'sortBy' => $sortBy, 'sortOrder' => $sortOrder]);

            // Store the download link in the array
            $downloadLinks[] = [
                'url' => $downloadRoute,
                'label' => 'Birthday Reports '.$monthYear.' Part '.$partitionNumber,
            ];

        });

        // Pass the download links to the next download page
        return view('admin.201_profiling.reports.birthday_card.monthly_birthday.download_reports', compact('downloadLinks', 'monthYear'));
    }
}
