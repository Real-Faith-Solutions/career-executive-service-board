<?php

namespace App\Http\Controllers\Plantilla\Reports;

use App\Http\Controllers\Controller;
use App\Models\PersonalData;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\MotherDept;
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

        // planAppointee.planPosition.office.agencyLocation.departmentAgency
        // $totalPosition = DepartmentAgency::whereHas('agencyLocation.office.planPosition', function ($query) {
        //     $query->where('is_ces_pos', true)
        //         ->where('pres_apptee', true);
        // })
        // ->count();

        $totalPosition = PlanPosition::whereHas('office.agencyLocation.departmentAgency', function ($query) use ($deptid, $motherDepartmentAgency) {
            $query->where('mother_deptid', $deptid)
                ->orWhere('deptid', $deptid);
        })
            ->where('is_ces_pos', 1)
            ->where('pres_apptee', 1)
            ->where('is_active', 1)
            ->count();

        if ($totalPosition) {
            $occupiedCESPosition = PlanPosition::whereHas('office.agencyLocation.departmentAgency', function ($query) use ($deptid, $motherDepartmentAgency) {
                $query->where('mother_deptid', $deptid)
                    ->orWhere('deptid', $deptid);
            })
                ->where('is_ces_pos', 1)
                ->where('pres_apptee', 1)
                ->where('is_active', 1)
                ->whereHas('planAppointee', function ($query) {
                    $query->where('is_appointee', 1);
                })
                ->count();

            if ($occupiedCESPosition) {
                $occupiedCESPositionPercentage = round(($occupiedCESPosition / $totalPosition) * 100);
                $vacantCESPosition = $totalPosition - $occupiedCESPosition;
                $vacantCESPositionPercentage = (100 - $occupiedCESPositionPercentage);

                $cesosAndEligibles = PlanPosition::whereHas('office.agencyLocation.departmentAgency', function ($query) use ($deptid, $motherDepartmentAgency) {
                    $query->where('mother_deptid', $deptid)
                        ->orWhere('deptid', $deptid);
                })
                    ->where('is_ces_pos', 1)
                    ->where('pres_apptee', 1)
                    ->where('is_active', 1)
                    ->whereHas('planAppointee', function ($query) {
                        $query->where('is_appointee', 1)
                            ->whereHas('personalData.cesStatus', function ($query) {
                                $query->where('description', 'LIKE', '%Eli%')
                                    ->orWhere('description', 'LIKE', '%CES%');
                            });
                    })
                    ->count();

                $cesosAndEligiblesPercentage = round(($cesosAndEligibles / $occupiedCESPosition) * 100);


                $nonCesosAndNonEligibles = $occupiedCESPosition - $cesosAndEligibles;
                $nonCesosAndNonEligiblesPercentage = (100 - $cesosAndEligiblesPercentage);

                $ceso = PlanPosition::whereHas('office.agencyLocation.departmentAgency', function ($query) use ($deptid, $motherDepartmentAgency) {
                    $query->where('mother_deptid', $deptid)
                        ->orWhere('deptid', $deptid);
                })
                    ->where('is_ces_pos', 1)
                    ->where('pres_apptee', 1)
                    ->where('is_active', 1)
                    ->whereHas('planAppointee', function ($query) {
                        $query->where('is_appointee', 1)
                            ->whereHas('personalData.cesStatus', function ($query) {
                                $query->where('description', 'LIKE', '%CES%');
                            });
                    })
                    ->count();
                $cesoPercentage = round(($ceso / $cesosAndEligibles) * 100);
                $eligibles = PlanPosition::whereHas('office.agencyLocation.departmentAgency', function ($query) use ($deptid, $motherDepartmentAgency) {
                    $query->where('mother_deptid', $deptid)
                        ->orWhere('deptid', $deptid);
                })
                    ->where('is_ces_pos', 1)
                    ->where('pres_apptee', 1)
                    ->where('is_active', 1)
                    ->whereHas('planAppointee', function ($query) {
                        $query->where('is_appointee', 1)
                            ->whereHas('personalData.cesStatus', function ($query) {
                                $query->where('description', 'LIKE', '%Eli%');
                            });
                    })
                    ->count();
                $eligiblesPercentage = (100 - $cesoPercentage);

                $maleCesoAndEligibles = PlanPosition::whereHas('office.agencyLocation.departmentAgency', function ($query) use ($deptid, $motherDepartmentAgency) {
                    $query->where('mother_deptid', $deptid)
                        ->orWhere('deptid', $deptid);
                })
                    ->where('is_ces_pos', 1)
                    ->where('pres_apptee', 1)
                    ->where('is_active', 1)
                    ->whereHas('planAppointee', function ($query) {
                        $query->where('is_appointee', 1)
                            ->whereHas('personalData', function ($query) {
                                $query->where('gender', 'Male')
                                    ->whereHas('cesStatus', function ($query) {
                                        $query->where('description', 'LIKE', '%CES%')
                                            ->orWhere('description', 'LIKE', '%Eli%');
                                    });
                            });
                    })
                    ->count();

                $maleCeso = PlanPosition::whereHas('office.agencyLocation.departmentAgency', function ($query) use ($deptid, $motherDepartmentAgency) {
                    $query->where('mother_deptid', $deptid)
                        ->orWhere('deptid', $deptid);
                })
                    ->where('is_ces_pos', 1)
                    ->where('pres_apptee', 1)
                    ->where('is_active', 1)
                    ->whereHas('planAppointee', function ($query) {
                        $query->where('is_appointee', 1)
                            ->whereHas('personalData', function ($query) {
                                $query->where('gender', 'Male')
                                    ->whereHas('cesStatus', function ($query) {
                                        $query->where('description', 'LIKE', '%CES%');
                                    });
                            });
                    })
                    ->count();
                $maleEligibles = PlanPosition::whereHas('office.agencyLocation.departmentAgency', function ($query) use ($deptid, $motherDepartmentAgency) {
                    $query->where('mother_deptid', $deptid)
                        ->orWhere('deptid', $deptid);
                })
                    ->where('is_ces_pos', 1)
                    ->where('pres_apptee', 1)
                    ->where('is_active', 1)
                    ->whereHas('planAppointee', function ($query) {
                        $query->where('is_appointee', 1)
                            ->whereHas('personalData', function ($query) {
                                $query->where('gender', 'Male')
                                    ->whereHas('cesStatus', function ($query) {
                                        $query->where('description', 'LIKE', '%Eli%');
                                    });
                            });
                    })
                    ->count();
                $femaleCesoAndEligibles = PlanPosition::whereHas('office.agencyLocation.departmentAgency', function ($query) use ($deptid, $motherDepartmentAgency) {
                    $query->where('mother_deptid', $deptid)
                        ->orWhere('deptid', $deptid);
                })
                    ->where('is_ces_pos', 1)
                    ->where('pres_apptee', 1)
                    ->where('is_active', 1)
                    ->whereHas('planAppointee', function ($query) {
                        $query->where('is_appointee', 1)
                            ->whereHas('personalData', function ($query) {
                                $query->where('gender', 'Female')
                                    ->whereHas('cesStatus', function ($query) {
                                        $query->where('description', 'LIKE', '%CES%')
                                            ->orWhere('description', 'LIKE', '%Eli%');
                                    });
                            });
                    })
                    ->count();

                $femaleCeso = PlanPosition::whereHas('office.agencyLocation.departmentAgency', function ($query) use ($deptid, $motherDepartmentAgency) {
                    $query->where('mother_deptid', $deptid)
                        ->orWhere('deptid', $deptid);
                })
                    ->where('is_ces_pos', 1)
                    ->where('pres_apptee', 1)
                    ->where('is_active', 1)
                    ->whereHas('planAppointee', function ($query) {
                        $query->where('is_appointee', 1)
                            ->whereHas('personalData', function ($query) {
                                $query->where('gender', 'Female')
                                    ->whereHas('cesStatus', function ($query) {
                                        $query->where('description', 'LIKE', '%CES%');
                                    });
                            });
                    })
                    ->count();
                $femaleEligibles = PlanPosition::whereHas('office.agencyLocation.departmentAgency', function ($query) use ($deptid, $motherDepartmentAgency) {
                    $query->where('mother_deptid', $deptid)
                        ->orWhere('deptid', $deptid);
                })
                    ->where('is_ces_pos', 1)
                    ->where('pres_apptee', 1)
                    ->where('is_active', 1)
                    ->whereHas('planAppointee', function ($query) {
                        $query->where('is_appointee', 1)
                            ->whereHas('personalData', function ($query) {
                                $query->where('gender', 'Female')
                                    ->whereHas('cesStatus', function ($query) {
                                        $query->where('description', 'LIKE', '%Eli%');
                                    });
                            });
                    })
                    ->count();

                $countByMale = PlanPosition::whereHas('office.agencyLocation.departmentAgency', function ($query) use ($deptid, $motherDepartmentAgency) {
                    $query->where('mother_deptid', $deptid)
                        ->orWhere('deptid', $deptid);
                })
                    ->where('is_ces_pos', 1)
                    ->where('pres_apptee', 1)
                    ->where('is_active', 1)
                    ->whereHas('planAppointee', function ($query) {
                        $query->where('is_appointee', 1)
                            ->whereHas('personalData', function ($query) {
                                $query->where('gender', 'Male');
                            });
                    })
                    ->count();
                $countByFemale = PlanPosition::whereHas('office.agencyLocation.departmentAgency', function ($query) use ($deptid, $motherDepartmentAgency) {
                    $query->where('mother_deptid', $deptid)
                        ->orWhere('deptid', $deptid);
                })
                    ->where('is_ces_pos', 1)
                    ->where('pres_apptee', 1)
                    ->where('is_active', 1)
                    ->whereHas('planAppointee', function ($query) {
                        $query->where('is_appointee', 1)
                            ->whereHas('personalData', function ($query) {
                                $query->where('gender', 'Female');
                            });
                    })
                    ->count();
                $maleNonCesNonEligibles = ($countByMale - $maleCesoAndEligibles);
                $femaleNonCesNonEligibles = ($countByFemale - $femaleCesoAndEligibles);

                $maleCesoAndEligiblesPercentage = round(($maleCesoAndEligibles / $occupiedCESPosition) * 100);
                $nonMaleCesoAndEligiblesPercentage = round(($maleNonCesNonEligibles / $occupiedCESPosition) * 100);
                $femaleCesoAndEligiblesPercentage = round(($femaleCesoAndEligibles / $occupiedCESPosition) * 100);
                $nonFemaleCesoAndEligiblesPercentage = round(($femaleNonCesNonEligibles / $occupiedCESPosition) * 100);


                $totalPercentage = $maleCesoAndEligiblesPercentage +
                    $nonMaleCesoAndEligiblesPercentage +
                    $femaleCesoAndEligiblesPercentage +
                    $nonFemaleCesoAndEligiblesPercentage;

                $nonFemaleCesoAndEligiblesPercentage = round($nonFemaleCesoAndEligiblesPercentage + (100 - $totalPercentage));

                $countByMalePercentage = round(($countByMale / $occupiedCESPosition) * 100);


                $countByFemalePercentage = (100 - $countByMalePercentage);
            }
        } else {
            $countByFemalePercentage = 0;
            $countByMalePercentage = 0;
            $nonMaleCesoAndEligiblesPercentage = 0;
            $nonFemaleCesoAndEligiblesPercentage = 0;
            $femaleCesoAndEligiblesPercentage = 0;
            $maleCesoAndEligiblesPercentage = 0;
            $femaleNonCesNonEligibles = 0;
            $maleNonCesNonEligibles = 0;
            $countByFemale = 0;
            $countByMale = 0;
            $femaleEligibles = 0;
            $femaleCeso = 0;
            $femaleCesoAndEligibles = 0;
            $maleEligibles = 0;
            $maleCeso = 0;
            $maleCesoAndEligibles = 0;
            $eligiblesPercentage = 0;
            $eligibles = 0;
            $cesoPercentage = 0;
            $ceso = 0;
            $nonCesosAndNonEligiblesPercentage = 0;
            $nonCesosAndNonEligibles = 0;
            $cesosAndEligiblesPercentage = 0;
            $cesosAndEligibles = 0;
            $occupiedCESPositionPercentage = 0;
            $vacantCESPositionPercentage = 0;
            $totalPosition = 0;
            $occupiedCESPosition = 0;
            $vacantCESPosition = 0;
        }





        $pdf = Pdf::loadView(
            'admin.plantilla.reports.statistics.pdf',
            compact(
                'countByFemalePercentage',
                'countByMalePercentage',
                'nonMaleCesoAndEligiblesPercentage',
                'nonFemaleCesoAndEligiblesPercentage',
                'femaleCesoAndEligiblesPercentage',
                'maleCesoAndEligiblesPercentage',
                'femaleNonCesNonEligibles',
                'maleNonCesNonEligibles',
                'countByFemale',
                'countByMale',
                'femaleEligibles',
                'femaleCeso',
                'femaleCesoAndEligibles',
                'maleEligibles',
                'maleCeso',
                'maleCesoAndEligibles',
                'eligiblesPercentage',
                'eligibles',
                'cesoPercentage',
                'ceso',
                'nonCesosAndNonEligiblesPercentage',
                'nonCesosAndNonEligibles',
                'cesosAndEligiblesPercentage',
                'cesosAndEligibles',
                'motherDepartmentAgency',
                'occupiedCESPositionPercentage',
                'vacantCESPositionPercentage',
                'totalPosition',
                'occupiedCESPosition',
                'vacantCESPosition',
            )
        )
            ->setPaper('a4', 'portrait');
        return $pdf->stream($motherDepartmentAgency->acronym . '.pdf');
    }

    public function index(Request $request)
    {
        $motherDepartmentAgency = DepartmentAgency::query()
            ->select('deptid', 'title')
            ->where('mother_deptid', 0)
            ->whereHas('agencyLocation.office.planPosition', function ($query){
                $query->where('is_ces_pos', 1)
                ->where('pres_apptee', 1)
                ->where('is_active', 1);
            })
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
        $recentAppointee = PlanAppointee::query()
            ->where('is_appointee', 1)
            ->whereHas('planPosition', function ($query) {
                $query->where('is_ces_pos', 1)
                    ->where('pres_apptee', 1)
                    ->where('is_active', 1);
            })
            ->orderBy('created_dt', 'desc')
            ->limit(5)
            ->get();


        $plantillaAll = PlanPosition::query()
            ->where('is_ces_pos', 1)
            ->where('pres_apptee', 1)
            ->where('is_active', 1)
            ->count();

        $occupiedCESPosition = PlanPosition::query()
            ->where('is_ces_pos', 1)
            ->where('pres_apptee', 1)
            ->where('is_active', 1)
            ->whereHas('planAppointee', function ($query) {
                $query->where('is_appointee', 1);
            })
            ->count();


        $plantillaCES = PlanPosition::query()
            ->where('is_ces_pos', 1)
            ->where('pres_apptee', 1)
            ->where('is_active', 1)
            ->whereHas('planAppointee', function ($query) {
                $query->where('is_appointee', 1)
                    ->whereHas('personalData.cesStatus', function ($query) {
                        $query->where('description', 'LIKE', '%Eli%')
                            ->orWhere('description', 'LIKE', '%CES%');
                    });
            })
            ->count();

        $plantillaNonCES = PlanPosition::query()
            ->where('is_ces_pos', 1)
            ->where('pres_apptee', 1)
            ->where('is_active', 1)
            ->whereHas('planAppointee', function ($query) {
                $query->where('is_appointee', 1)
                    ->whereHas('personalData.cesStatus', function ($query) {
                        $query->where('description', 'LIKE', '%-%')
                            ->orWhere('description', 'LIKE', '%CSE%');
                    });
            })
            ->count();

        if ($plantillaAll != null) {
            $percentageCES = ($plantillaCES / $occupiedCESPosition) * 100;
            $percentageNonCES = (100 - $percentageCES);
        } else {
            $percentageCES = null;
            $percentageNonCES = null;
        }

        $totalMaleCESOChart = PlanPosition::query()
            ->where('is_ces_pos', 1)
            ->where('pres_apptee', 1)
            ->where('is_active', 1)
            ->whereHas('planAppointee', function ($query) {
                $query->where('is_appointee', 1)
                    ->whereHas('personalData', function ($query) {
                        $query->where('gender', 'Male')
                            ->whereHas('cesStatus', function ($query) {
                                $query->where('description', 'LIKE', '%CES%')
                                    ->orWhere('description', 'LIKE', '%Eli%');
                            });
                    });
            })
            ->count();

        $totalMale = PlanPosition::query()
            ->where('is_ces_pos', 1)
            ->where('pres_apptee', 1)
            ->where('is_active', 1)
            ->whereHas('planAppointee', function ($query) {
                $query->where('is_appointee', 1)
                    ->whereHas('personalData', function ($query) {
                        $query->where('gender', 'Male');
                    });
            })
            ->count();
        $totalMaleNonCESOChart = ($totalMale - $totalMaleCESOChart);


        $totalFemaleCESOChart = PlanPosition::query()
            ->where('is_ces_pos', 1)
            ->where('pres_apptee', 1)
            ->where('is_active', 1)
            ->whereHas('planAppointee', function ($query) {
                $query->where('is_appointee', 1)
                    ->whereHas('personalData', function ($query) {
                        $query->where('gender', 'Female')
                            ->whereHas('cesStatus', function ($query) {
                                $query->where('description', 'LIKE', '%CES%')
                                    ->orWhere('description', 'LIKE', '%Eli%');
                            });
                    });
            })
            ->count();

        $totalFemale = PlanPosition::query()
            ->where('is_ces_pos', 1)
            ->where('pres_apptee', 1)
            ->where('is_active', 1)
            ->whereHas('planAppointee', function ($query) {
                $query->where('is_appointee', 1)
                    ->whereHas('personalData', function ($query) {
                        $query->where('gender', 'Female');
                    });
            })
            ->count();
        $totalFemaleNonCESOChart = ($totalFemale - $totalFemaleCESOChart);


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
