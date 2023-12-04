<?php

namespace App\Http\Controllers\Plantilla\Reports;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\Office;
use App\Models\Plantilla\PlanAppointee;
use App\Models\Plantilla\PlanPosition;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttachedVacantPositionController extends Controller
{
    public function index(Request $request)
    {
        $motherDepartmentAgency = DepartmentAgency::query()
            ->where('is_national_government', 1)
            ->select('title', 'deptid')
            ->orderBy('title', 'asc')
            ->get();

        return view('admin.plantilla.reports.attached-vacant-position.index', compact(
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
                        $query->where('is_appointee', true);
                    });
            })
            ->has('agencyLocation.office.planPosition.planAppointee') // Ensure at least one planAppointee
            ->orderBy('title', 'asc')
            ->get();

            $planPosition = PlanPosition::select('plantilla_id', 'pos_default', 'corp_sg', 'item_no', 'officeid', 'is_ces_pos', 'pres_apptee')
            ->whereHas('office.agencyLocation.departmentAgency', function ($query) use ($deptid) {
                $query->where('deptid', $deptid);
            })
            ->whereDoesntHave('planAppointee', function ($query) {
                $query->where('is_appointee', 1);
            })
            ->orderBy('corp_sg', 'desc')
            ->orderBy('item_no', 'asc')
            ->get();

        $pdf = Pdf::loadView(
            'admin.plantilla.reports.attached-vacant-position.pdf',
            compact(
                'departments',
                'planPosition',
                'motherDepartmentAgency',
                'currentDate',
            )
        )
            ->setPaper('a4', 'landscape');
        return $pdf->stream($motherDepartmentAgency->acronym . '.pdf');
    }
}
