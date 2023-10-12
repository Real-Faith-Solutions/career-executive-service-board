<?php

namespace App\Http\Controllers\Plantilla\Reports;

use App\Http\Controllers\Controller;
use App\Models\PersonalData;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\PlanAppointee;
use App\Models\Plantilla\PlanPosition;
use App\Models\Plantilla\SectorManager;
use Illuminate\Http\Request;
use Symfony\Component\Finder\Iterator\DepthRangeFilterIterator;

class StatisticsController extends Controller
{
    public function index(Request $request)
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

        $sectorToggle = $request->input('sectorToggle');

        $toggleFilter = DepartmentAgency::query();
        if ($sectorToggle) {
            $toggleFilter->where('sectorid', $sectorToggle);
        }
        $departmentAgencies = $toggleFilter->orderBy('title', 'ASC')->get();

        $agencyStatistics = [];

        foreach ($departmentAgencies as $agency) {
            // Calculate statistics for male CESO appointees in this agency
            $totalMaleCESO = PlanAppointee::where('is_appointee', 1)
                ->whereHas('planPosition.office.agencyLocation', function ($query) use ($agency) {
                    $query->where('deptid', $agency->deptid);
                })->whereHas('personalData', function ($query) use ($agency) {
                    $query->where('gender', 'Male');
                })
                ->count();
            $totalMaleNonCESO = PlanAppointee::whereNot('is_appointee', 1)
                ->whereHas('planPosition.office.agencyLocation', function ($query) use ($agency) {
                    $query->where('deptid', $agency->deptid);
                })->whereHas('personalData', function ($query) use ($agency) {
                    $query->where('gender', 'Male');
                })
                ->count();
            $totalFemaleCESO = PlanAppointee::where('is_appointee', 1)
                ->whereHas('planPosition.office.agencyLocation', function ($query) use ($agency) {
                    $query->where('deptid', $agency->deptid);
                })->whereHas('personalData', function ($query) use ($agency) {
                    $query->where('gender', 'Female');
                })
                ->count();
            $totalFemaleNonCESO = PlanAppointee::whereNot('is_appointee', 1)
                ->whereHas('planPosition.office.agencyLocation', function ($query) use ($agency) {
                    $query->where('deptid', $agency->deptid);
                })->whereHas('personalData', function ($query) use ($agency) {
                    $query->where('gender', 'Female');
                })
                ->count();
            $totalCESO = PlanAppointee::where('is_appointee', 1)
                ->whereHas('planPosition.office.agencyLocation', function ($query) use ($agency) {
                    $query->where('deptid', $agency->deptid);
                })
                ->count();

            $totalNonCESO = PlanAppointee::whereNot('is_appointee', 1)
                ->whereHas('planPosition.office.agencyLocation', function ($query) use ($agency) {
                    $query->where('deptid', $agency->deptid);
                })
                ->count();

            // Store the statistics for this agency in the array
            $agencyStatistics[] = [
                'agency' => $agency,
                'total_male_ceso' => $totalMaleCESO,
                'total_male_nonceso' => $totalMaleNonCESO,
                'total_female_ceso' => $totalFemaleCESO,
                'total_female_nonceso' => $totalFemaleNonCESO,
                'total_ceso' => $totalCESO,
                'total_nonceso' => $totalNonCESO,
                'total_plantilla' => $totalCESO + $totalNonCESO,

            ];
        }

        $sectors = SectorManager::orderBy('title', 'ASC')->get();




        return view('admin.plantilla.reports.statistics.index', compact(
            'sectorToggle',
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
            'departmentAgencies',
            'agencyStatistics',
            'sectors',
        ));
    }
}
