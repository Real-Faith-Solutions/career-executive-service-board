<?php

namespace App\Http\Controllers\Plantilla\Reports;

use App\Http\Controllers\Controller;
use App\Models\PersonalData;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\PlanAppointee;
use App\Models\Plantilla\PlanPosition;
use App\Models\Plantilla\SectorManager;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Symfony\Component\Finder\Iterator\DepthRangeFilterIterator;

class StatisticsController extends Controller
{
    public function generatePDF($deptid)
    {

        $motherDepartmentAgency = DepartmentAgency::find($deptid);

        $totalPosition = PlanPosition::whereHas('office.planPosition.agencyLocation.departmentAgency.departmentAgency', function ($query) use ($deptid) {
            $query->where('deptid', $deptid);
        })->count();

        $occupiedCESPosition = DepartmentAgency::whereHas('agencyLocation.office.planPosition.planAppointee', function ($query) {
            // unfinish
        })->count();


        $pdf = Pdf::loadView(
            'admin.plantilla.reports.statistics.pdf',
            compact(
                'motherDepartmentAgency',
                'totalPosition',
                'occupiedCESPosition',
            )
        )
            ->setPaper('a4', 'portrait');
        return $pdf->stream($motherDepartmentAgency->acronym . '.pdf');
    }

    public function index(Request $request)
    {
        $motherDepartmentAgency = DepartmentAgency::query()
            ->where('is_national_government', 1)
            ->select('title', 'deptid')
            ->orderBy('title', 'asc')
            ->get();
        $chartsAndDatas = $this->chartsAndDatas();
        $totalMaleCESOChart = $chartsAndDatas['totalMaleCESOChart'];
        $totalFemaleCESOChart = $chartsAndDatas['totalFemaleCESOChart'];
        $totalMaleNonCESOChart = $chartsAndDatas['totalMaleNonCESOChart'];
        $totalFemaleNonCESOChart = $chartsAndDatas['totalFemaleNonCESOChart'];
        $plantillaAll = $chartsAndDatas['plantillaAll'];
        $plantillaCES = $chartsAndDatas['plantillaCES'];
        $percentageCES = $chartsAndDatas['percentageCES'];
        $plantillaNonCES = $chartsAndDatas['plantillaNonCES'];
        $percentageNonCES = $chartsAndDatas['percentageNonCES'];
        $totalMale = $chartsAndDatas['totalMale'];
        $totalFemale = $chartsAndDatas['totalFemale'];
        $recentAppointee = $chartsAndDatas['recentAppointee'];

        return view('admin.plantilla.reports.statistics.index', compact(
            'motherDepartmentAgency',
            'totalMaleCESOChart',
            'totalFemaleCESOChart',
            'totalMaleNonCESOChart',
            'totalFemaleNonCESOChart',
            'plantillaAll',
            'plantillaCES',
            'percentageCES',
            'plantillaNonCES',
            'percentageNonCES',
            'totalMale',
            'totalFemale',
            'recentAppointee',
        ));
    }


    private function chartsAndDatas()
    {
        $recentAppointee = PlanAppointee::orderBy('plantilla_id', 'DESC')->take(5)->get();

        $plantillaAll = PlanAppointee::all()->count();


        $plantillaCES = PlanAppointee::whereHas('planPosition', function ($query) {
            $query->where('is_ces_pos', 1)
                ->where('pres_apptee', 1);
        })->count();

        $plantillaNonCES = PlanAppointee::whereHas('planPosition', function ($query) {
            $query->where('is_ces_pos', '!=', 1)
                ->orWhere('pres_apptee', '!=', 1);
        })->count();

        if ($plantillaAll != null) {
            $percentageCES = ($plantillaCES / $plantillaAll) * 100;
            $percentageNonCES = ($plantillaNonCES / $plantillaAll) * 100;
        } else {
            $percentageCES = null;
            $percentageNonCES = null;
        }

        $totalMaleCESOChart = PlanAppointee::whereHas('planPosition', function ($query) {
            $query->where('is_ces_pos', 1)
                ->where('pres_apptee', 1);
        })
            ->whereHas('personalData', function ($query) {
                $query->where('gender', 'Male');
            })
            ->count();


        $totalFemaleCESOChart = PlanAppointee::whereHas('planPosition', function ($query) {
            $query->where('is_ces_pos', 1)
                ->where('pres_apptee', 1);;
        })
            ->whereHas('personalData', function ($query) {
                $query->where('gender', 'Female');
            })
            ->count();

        $totalMaleNonCESOChart = PlanAppointee::whereHas('planPosition', function ($query) {
            $query->where('is_ces_pos', '!=', 1)
                ->orWhere('pres_apptee', '!=', 1);
        })
            ->whereHas('personalData', function ($query) {
                $query->where('gender', 'Male');
            })
            ->count();
        $totalFemaleNonCESOChart = PlanAppointee::whereHas('planPosition', function ($query) {
            $query->where('is_ces_pos', '!=', 1)
                ->orWhere('pres_apptee', '!=', 1);
        })
            ->whereHas('personalData', function ($query) {
                $query->where('gender', 'Female');
            })
            ->count();

        $totalMale = $totalMaleCESOChart + $totalMaleNonCESOChart;
        $totalFemale = $totalFemaleCESOChart + $totalFemaleNonCESOChart;

        $datas = [
            'recentAppointee' => $recentAppointee,
            'plantillaAll' => $plantillaAll,
            'plantillaCES' => $plantillaCES,
            'plantillaNonCES' => $plantillaNonCES,
            'totalMaleCESOChart' => $totalMaleCESOChart,
            'totalFemaleCESOChart' => $totalFemaleCESOChart,
            'totalMaleNonCESOChart' => $totalMaleNonCESOChart,
            'totalFemaleNonCESOChart' => $totalFemaleNonCESOChart,
            'percentageCES' => $percentageCES,
            'percentageNonCES' => $percentageNonCES,
            'totalMale' => $totalMale,
            'totalFemale' => $totalFemale,
        ];
        return $datas;
    }

    private function oldStatistics(Request $request)
    {
        $sectorToggle = $request->input('sectorToggle');

        $toggleFilter = DepartmentAgency::query();
        if ($sectorToggle) {
            $toggleFilter->where('sectorid', $sectorToggle);
        }
        $departmentAgencies = $toggleFilter->orderBy('title', 'ASC')->get();

        $agencyStatistics = [];

        foreach ($departmentAgencies as $agency) {
            // Calculate statistics for male CESO appointees in this agency
            $totalMaleCESO = PlanAppointee::whereHas('planPosition', function ($query) {
                $query->where('is_ces_pos', 1);
            })
                ->whereHas('planPosition.office.agencyLocation', function ($query) use ($agency) {
                    $query->where('deptid', $agency->deptid);
                })
                ->whereHas('personalData', function ($query) {
                    $query->where('gender', 'Male');
                })
                ->count();

            $totalMaleNonCESO = PlanAppointee::whereHas('planPosition', function ($query) {
                $query->whereNot('is_ces_pos', 1);
            })
                ->whereHas('planPosition.office.agencyLocation', function ($query) use ($agency) {
                    $query->where('deptid', $agency->deptid);
                })
                ->whereHas('personalData', function ($query) {
                    $query->where('gender', 'Male');
                })
                ->count();

            $totalFemaleCESO = PlanAppointee::whereHas('planPosition', function ($query) {
                $query->where('is_ces_pos', 1);
            })
                ->whereHas('planPosition.office.agencyLocation', function ($query) use ($agency) {
                    $query->where('deptid', $agency->deptid);
                })
                ->whereHas('personalData', function ($query) {
                    $query->where('gender', 'Female');
                })
                ->count();

            $totalFemaleNonCESO = PlanAppointee::whereHas('planPosition', function ($query) {
                $query->whereNot('is_ces_pos', 1);
            })
                ->whereHas('planPosition.office.agencyLocation', function ($query) use ($agency) {
                    $query->where('deptid', $agency->deptid);
                })
                ->whereHas('personalData', function ($query) {
                    $query->where('gender', 'Female');
                })
                ->count();



            $totalCESO = PlanAppointee::whereHas('planPosition', function ($query) {
                $query->where('is_ces_pos', 1);
            })
                ->whereHas('planPosition.office.agencyLocation', function ($query) use ($agency) {
                    $query->where('deptid', $agency->deptid);
                })
                ->count();

            $totalNonCESO = PlanAppointee::whereHas('planPosition', function ($query) {
                $query->whereNot('is_ces_pos', 1);
            })
                ->whereHas('planPosition.office.agencyLocation', function ($query) use ($agency) {
                    $query->where('deptid', $agency->deptid);
                })
                ->count();

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

        $datas = [
            'sectorToggle' => $sectorToggle,
            'departmentAgencies' => $departmentAgencies,
            'agencyStatistics' => $agencyStatistics,
            'sectors' => $sectors,
        ];

        return $datas;
    }
}
