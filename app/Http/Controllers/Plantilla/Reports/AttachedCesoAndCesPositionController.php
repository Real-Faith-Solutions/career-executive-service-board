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
            ->select('deptid', 'title')
            ->where('mother_deptid', 0)
            ->whereHas('agencyLocation.office.planPosition', function ($query){
                $query->where('is_ces_pos', 1)
                ->where('pres_apptee', 1)
                ->where('is_active', 1);
            })
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

        $departments = DepartmentAgency::where('mother_deptid', $deptid)
            ->whereHas('agencyLocation.office.planPosition', function ($query) {
                $query->where('is_ces_pos', 1)
                    ->where('pres_apptee', 1)
                    ->where('is_active', 1)
                    ->whereHas('planAppointee', function ($query) {
                        $query->where('is_appointee', 1);
                    });
            })
            // ->has('agencyLocation.office.planPosition.planAppointee') // Ensure at least one planAppointee
            ->orderBy('title', 'asc')
            ->get();

        $office = Office::whereHas('agencyLocation', function ($query) use ($deptid) {
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

        $filename = $motherDepartmentAgency->acronym . '.pdf';
        $pdf->render($filename);
        $pageCount = $pdf->getDompdf()->getCanvas()->get_page_count();

        $pdf = Pdf::loadView(
            'admin.plantilla.reports.attached-ceso-eligibles-ces-position.pdf',
            compact(
                'pageCount',
                'departments',
                'office',
                'motherDepartmentAgency',
                'currentDate',
                'planAppointee',
            )
        )
            ->setPaper('a4', 'landscape');
        
        return $pdf->stream($filename);
    }
}
