<?php

namespace App\Http\Controllers\Report201;

use App\Http\Controllers\Controller;
use App\Models\PersonalData;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BirthdayCardReportController extends Controller
{
    public function index()
    {
        $fullDateName = Carbon::now()->format('l F d');
        $currentMonthInNumber = Carbon::now()->format('m');
        $specificDay = Carbon::now()->format('d');
    
        $personalData = PersonalData::query()
                        ->where('status', '=', 'Active')
                        ->whereMonth('birthdate', '=', $currentMonthInNumber)
                        ->whereDay('birthdate', '=', $specificDay)
                        ->orderBy('lastname')
                        ->get();

        $numberOfCelebrant = PersonalData::query()
                        ->where('status', '=', 'Active')
                        ->whereMonth('birthdate', '=', $currentMonthInNumber)
                        ->whereDay('birthdate', '=', $specificDay)
                        ->count();

        return view('admin.201_profiling.reports.birthday_card.index', [
            'currentMonth' => $currentMonthInNumber,
            'fullDateName' => $fullDateName,  
            'personalData' => $personalData,
            'numberOfCelebrant' => $numberOfCelebrant,
        ]);
    }

    public function monthlyCelebrant(Request $request)
    {
        $sortBy = $request->input('sortBy', 'birthdate'); // Default sorting acdate.
        $sortOrder = $request->input('sortOrder', 'asc'); // Default sorting order

        $currentMonthInNumber = Carbon::now()->format('m');
        $currentMonthFullName = Carbon::now()->format('F');
    
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

    public function monthlyCelebrantGeneratePdfReport($sortBy, $sortOrder)
    {
        $currentMonthInNumber = Carbon::now()->format('m');
        $currentMonthFullName = Carbon::now()->format('F');

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

        return $pdf->stream('birthday-celebrant-report.pdf');
    }
}
