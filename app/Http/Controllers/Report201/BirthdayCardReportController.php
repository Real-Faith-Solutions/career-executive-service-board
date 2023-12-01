<?php

namespace App\Http\Controllers\Report201;

use App\Http\Controllers\Controller;
use App\Models\PersonalData;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BirthdayCardReportController extends Controller
{
    // fetching all users has birthday today
    public function index()
    {
        $fullDateName = Carbon::now()->format('l, F, d, Y'); // getting full name attribute of the month example: Friday, December 01
        $currentMonthInNumber = Carbon::now()->format('m'); // getting month in number example: 12 = December
        $specificDay = Carbon::now()->format('d'); // getting current day example: 01 of December
    
        $personalData = PersonalData::query()
                        ->where('status', '=', 'Active')
                        ->whereMonth('birthdate', '=', $currentMonthInNumber)
                        ->whereDay('birthdate', '=', $specificDay)
                        ->whereHas('cesStatus', function ($query) {
                            $query->where('description', 'LIKE', '%Eli%')
                                ->orWhere('description', 'LIKE', '%CES%');
                        })
                        ->orderBy('lastname')
                        ->get();

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

    // generating pdf for all user has birthday today
    public function birthdayCelebrantGeneratePdfReport()
    {
        $fullDateName = Carbon::now()->format('l-F-d-Y-'); // getting full name attribute of the month example: Friday, December 01, 2023
        $currentMonthInNumber = Carbon::now()->format('m'); // getting month in number example: 12 = December
        $specificDay = Carbon::now()->format('d'); // getting current day example: 01 of December

        $personalData = PersonalData::query()
            ->where('status', '=', 'Active')
            ->whereMonth('birthdate', '=', $currentMonthInNumber)
            ->whereDay('birthdate', '=', $specificDay)
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%')
                    ->orWhere('description', 'LIKE', '%CES%');
            })
            ->orderBy('lastname')
            ->get();

        $pdf = Pdf::loadView('admin.201_profiling.reports.birthday_card.report_pdf', [
            'personalData' => $personalData,
            'fullDateName' => $fullDateName,
        ])
        ->setPaper('a4', 'portrait');

        return $pdf->stream($fullDateName.'birthday-celebrant-report.pdf');
    }

    // fetching all users has birthday this month
    public function monthlyCelebrant(Request $request)
    {
        $sortBy = $request->input('sortBy', 'birthdate'); // Default sorting birthdate.
        $sortOrder = $request->input('sortOrder', 'asc'); // Default sorting order

        $currentMonthInNumber = Carbon::now()->format('m'); // getting month in number example: 12 = December
        $currentMonthFullName = Carbon::now()->format('F'); // getting month in name example: December = 12
    
        $personalData = PersonalData::query()
            ->with('cesStatus')
            ->where('status', '=', 'Active')
            ->whereMonth('birthdate', '=', $currentMonthInNumber)
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%')
                    ->orWhere('description', 'LIKE', '%CES%');
            })
            ->when($sortBy == 'birthdate', function ($query) use ($sortBy, $sortOrder) {
                return $query->orderByRaw('DAY(CONVERT(DATE, '. $sortBy .'))' . $sortOrder);
            }, function ($query) use ($sortBy, $sortOrder) {
                return $query->orderBy($sortBy, $sortOrder);
            })
            ->paginate(25);

        return view('admin.201_profiling.reports.birthday_card.monthly_birthday.index', [
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
            'personalData' => $personalData,
            'currentMonthFullName' => $currentMonthFullName,
        ]);
    }   

    // generating pdf for all users has birthday this month
    public function monthlyCelebrantGeneratePdfReport($sortBy, $sortOrder)
    {
        $currentMonthInNumber = Carbon::now()->format('m'); // getting month in number example: 12 = December
        $currentMonthFullName = Carbon::now()->format('F'); // getting month in name example: December = 12
        $monthYear = Carbon::now()->format('F-Y-'); // getting full name month and year attribute example: December, 2023

        $personalData = PersonalData::query()
            ->with('cesStatus')
            ->where('status', '=', 'Active')
            ->whereMonth('birthdate', '=', $currentMonthInNumber)
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%')
                    ->orWhere('description', 'LIKE', '%CES%');
            })
            ->when($sortBy == 'birthdate', function ($query) use ($sortBy, $sortOrder) {
                return $query->orderByRaw('DAY(CONVERT(DATE, '. $sortBy .'))' . $sortOrder);
            }, function ($query) use ($sortBy, $sortOrder) {
                return $query->orderBy($sortBy, $sortOrder);
            })
            ->get();

        $pdf = Pdf::loadView('admin.201_profiling.reports.birthday_card.monthly_birthday.report_pdf', [
            'personalData' => $personalData,
            'currentMonthFullName' => $currentMonthFullName,
        ])
        ->setPaper('a4', 'portrait');

        return $pdf->stream($monthYear.'birthday-celebrant-report.pdf');
    }
}
