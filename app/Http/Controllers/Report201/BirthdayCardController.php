<?php

namespace App\Http\Controllers\Report201;

use App\Http\Controllers\Controller;
use App\Models\PersonalData;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BirthdayCardController extends Controller
{
    public function index()
    {
        $fullDateName = Carbon::now()->format('l F d');
        $currentMonthInNumber = Carbon::now()->format('m');
        $currentMonthFullName = Carbon::now()->format('F');
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
            'currentMonthFullName' => $currentMonthFullName,
            'fullDateName' => $fullDateName,  
            'personalData' => $personalData,
            'numberOfCelebrant' => $numberOfCelebrant,
        ]);
    }

    public function monthlyCelebrant()
    {
        $currentMonthInNumber = Carbon::now()->format('m');
        $currentMonthFullName = Carbon::now()->format('F');
    
        $personalData = PersonalData::query()
        ->where('status', '=', 'Active')
        ->whereMonth('birthdate', '=', $currentMonthInNumber)
        ->orderByRaw('DAY(CONVERT(DATE, birthdate))')
        ->paginate(25);
    ;

        return view('admin.201_profiling.reports.birthday_card.monthly_birthday.index', [
            'personalData' => $personalData,
            'currentMonthFullName' => $currentMonthFullName,
        ]);
    }   
}
