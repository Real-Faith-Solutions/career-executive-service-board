<?php

namespace App\Http\Controllers\Plantilla\Reports;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\PlanPosition;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CESOccupancyStatisticsReportSummaryController extends Controller
{
    public function generatePDF($deptid)
    {
        $title = $deptid;
        $motherDepartmentAgency = DepartmentAgency::find($deptid);

        $totalPosition = PlanPosition::whereHas('office.agencyLocation.departmentAgency', function ($query) use ($deptid, $motherDepartmentAgency) {
            $query->where('mother_deptid', $deptid)
                ->orWhere('deptid', $deptid);
        })
            ->where('is_ces_pos', 1)
            ->where('pres_apptee', 1)
            ->where('is_active', 1)
            ->count();



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
        if ($cesosAndEligibles) {
            $cesoPercentage = round(($ceso / $cesosAndEligibles) * 100);
        } else {
            $cesoPercentage = null;
        }
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

        $pdf = Pdf::loadView(
            'admin.plantilla.reports.ces-occupancy-statistics-report-summary.pdf',
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
                'title',
            )
        )
            ->setPaper('a4', 'portrait');
        return $pdf->stream($title . '.pdf');
    }
}
