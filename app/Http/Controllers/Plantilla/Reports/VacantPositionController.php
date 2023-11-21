<?php

namespace App\Http\Controllers\Plantilla\Reports;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\Office;
use App\Models\Plantilla\PlanPosition;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VacantPositionController extends Controller
{
    public function index()
    {
        $motherDepartment = DepartmentAgency::where('is_national_government', 1)->get();
        return view('admin.plantilla.reports.vacant-position.index', compact(
            'motherDepartment'
        ));
    }

    public function generatePDF($deptid)
    {
        $currentDate = Carbon::now()->format('d F Y');
        $motherDepartmentAgency = DepartmentAgency::select('deptid', 'title', 'acronym')
            ->find($deptid);

        $no = 1;
        $planPosition = PlanPosition::select('plantilla_id', 'pos_default', 'corp_sg', 'item_no', 'officeid', 'is_ces_pos', 'pres_apptee')
            ->whereHas('office.agencyLocation.departmentAgency', function ($query) use ($deptid) {
                $query->where('deptid', $deptid)
                    ->where('is_ces_pos', 1)
                    ->where('pres_apptee', 1)
                    ->where('is_active', true);
            })
            ->orderBy('corp_sg', 'desc')
            ->orderBy('item_no', 'asc')
            ->get();

        $pdf = Pdf::loadView('admin.plantilla.reports.vacant-position.pdf', compact(
            'currentDate',
            'motherDepartmentAgency',
            'planPosition',
            'no',
        ))
            ->setPaper('a4', 'landscape');
        return $pdf->stream($motherDepartmentAgency->acronym . '.pdf');
    }
}
