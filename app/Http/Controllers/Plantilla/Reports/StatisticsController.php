<?php

namespace App\Http\Controllers\Plantilla\Reports;

use App\Http\Controllers\Controller;
use App\Models\PersonalData;
use App\Models\Plantilla\PlanAppointee;
use App\Models\Plantilla\PlanPosition;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
        $plantillaAll = PlanAppointee::all()->count();
        $plantillaCES = PlanAppointee::where('is_appointee', 1)->count();
        $plantillaNonCES = PlanAppointee::where('is_appointee', 0)->count();
        $percentageCES = ($plantillaCES / $plantillaAll) * 100;
        $percentageNonCES = ($plantillaNonCES / $plantillaAll) * 100;

        $totalMaleCESO = PlanAppointee::where('is_appointee', 1)
            ->whereHas('personalData', function ($query) {
                $query->where('gender', 'Male');
            })
            ->count();

        $totalFemaleCESO = PlanAppointee::where('is_appointee', 1)
            ->whereHas('personalData', function ($query) {
                $query->where('gender', 'Female');
            })
            ->count();

        $totalMaleNonCESO = PlanAppointee::whereNot('is_appointee', 1)
            ->whereHas('personalData', function ($query) {
                $query->where('gender', 'Male');
            })
            ->count();
        $totalFemaleNonCESO = PlanAppointee::whereNot('is_appointee', 1)
            ->whereHas('personalData', function ($query) {
                $query->where('gender', 'Female');
            })
            ->count();

            $totalMale = $totalMaleCESO + $totalMaleNonCESO;
            $totalFemale = $totalFemaleCESO + $totalFemaleNonCESO;


        return view('admin.plantilla.reports.statistics.index', compact(
            'plantillaAll',
            'plantillaCES',
            'plantillaNonCES',
            'totalMaleCESO',
            'totalFemaleCESO',
            'totalMaleNonCESO',
            'totalFemaleNonCESO',
            'percentageCES',
            'percentageNonCES',
            'totalMale',
            'totalFemale',
        ));
    }
}