<?php

namespace App\Http\Controllers\Plantilla\Reports;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\Office;
use App\Models\Plantilla\PlanAppointee;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttachedCesoAndCesPositionController extends Controller
{
    public function index(Request $request)
    {
        $motherDepartmentAgency = DepartmentAgency::query()
            ->where('is_national_government', 1)
            ->select('title', 'deptid')
            ->orderBy('title', 'asc')
            ->get();

        return view('admin.plantilla.reports.attached-ceso-eligibles-ces-position.index', compact(
            'motherDepartmentAgency',
        ));
    }

    public function generatePDF($deptid)
    {
        $currentDate = Carbon::now()->format('d F Y');
        $motherDepartmentAgency = DepartmentAgency::find($deptid);

        $departments = DepartmentAgency::with(['agencyLocation.office.planPosition.planAppointee'])
            ->where('mother_deptid', $deptid)
            ->whereHas('agencyLocation.office.planPosition.planAppointee')
            ->orderBy('title', 'asc')
            ->get();


        $office = Office::whereHas('agencyLocation', function ($query) use($deptid){
            $query->where('deptid', $deptid);
        })->get();



        $planAppointee = PlanAppointee::whereHas('personalData.cesStatus', function ($query) use ($deptid) {
            $query->where('description', 'LIKE', '%Ces%')
                ->orWhere('description', 'LIKE', '%Eli%');
        })
            ->whereHas('planPosition', function ($query) use ($deptid) {
                $query->where('is_ces_pos', 1)
                    ->where('pres_apptee', 1)
                    ->whereHas('office.agencyLocation.departmentAgency', function ($query) use ($deptid) {
                        $query->where('mother_deptid', $deptid);
                    });
            })
            ->join('plantilla_tblPlanPositions', 'plantilla_tblPlanPositions.plantilla_id', '=', 'plantilla_tblPlanAppointees.plantilla_id')
            ->join('profile_tblMain as personalData', 'personalData.cesno', '=', 'plantilla_tblPlanAppointees.cesno') // Adjust the join condition based on your actual relationships
            ->where('is_appointee', 1)
            ->orderBy('plantilla_tblPlanPositions.corp_sg', 'desc') // First sorting by corp_sg in desc
            ->orderBy('personalData.lastname') // Second sorting by lastname
            ->get();

        $pdf = Pdf::loadView(
            'admin.plantilla.reports.attached-ceso-eligibles-ces-position.pdf',
            compact(
                'departments',
                'office',
                'motherDepartmentAgency',
                'currentDate',
                'planAppointee',
            )
        )
            ->setPaper('a4', 'landscape');
        return $pdf->stream($motherDepartmentAgency->acronym . '.pdf');
    }
}
