<?php

namespace App\Http\Controllers\Plantilla\Reports;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\AgencyLocation;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\PlanPosition;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class OccupancyReportController extends Controller
{
    public function index()
    {
        $motherDepartment = DepartmentAgency::where('is_national_government', 1)->get();
        return view('admin.plantilla.reports.occupancy-report.index', compact(
            'motherDepartment'
        ));
    }

    public function pdf($deptid)
    {
        $motherDepartmentAgency = DepartmentAgency::find($deptid);

        $agencyLocation = AgencyLocation::where('deptid', $deptid)
            ->get();

        $planPosition = PlanPosition::whereHas('office.agencyLocation.departmentAgency', function ($query) use ($deptid) {
            $query->where('deptid', $deptid);
        })->get();

        $pdf = Pdf::loadView('admin.plantilla.reports.occupancy-report.pdf', compact(
            'motherDepartmentAgency',
            'planPosition',
            'agencyLocation',
        ))
            ->setPaper('a4', 'landscape');
        return $pdf->stream($motherDepartmentAgency->acronym . '.pdf');
    }
}
