<?php

namespace App\Http\Controllers\Plantilla\Reports;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\AgencyLocation;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\PlanPosition;
use App\Models\Plantilla\Office;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OccupancyReportController extends Controller
{
    public function index()
    {
        $motherDepartment = DepartmentAgency::where('is_national_government', 1)->get();
        return view('admin.plantilla.reports.occupancy-report.index', compact(
            'motherDepartment'
        ));
    }

    public function generatePDF($deptid)
    {
        $currentDate = Carbon::now()->format('d F Y');
        $motherDepartmentAgency = DepartmentAgency::select('deptid', 'title', 'acronym')
            ->find($deptid);

        $office = Office::whereHas('agencyLocation', function ($query) use ($deptid) {
            $query->where('deptid', $deptid);
        })->get();

        $planPosition = PlanPosition::select('plantilla_id', 'pos_default', 'corp_sg', 'item_no', 'officeid', 'is_ces_pos', 'pres_apptee')
            ->whereHas('office.agencyLocation.departmentAgency', function ($query) use ($deptid) {
                $query->where('deptid', $deptid)
                    ->where('is_ces_pos', 1)
                    ->where('pres_apptee', 1)
                    ->where('is_active', true);
            })

            ->orderBy('corp_sg', 'desc')
            ->get();

        $counts = []; // Initialize an array to store counts

        foreach ($office as $officeDatas) {
            $counts[$officeDatas->officeid] = []; // Initialize counts for each office
            foreach ($planPosition as $planPositionDatas) {
                if ($officeDatas->officeid == $planPositionDatas->officeid) {
                    $posDefault = $planPositionDatas->pos_default;
                    $counts[$officeDatas->officeid][$posDefault] = isset($counts[$officeDatas->officeid][$posDefault])
                        ? $counts[$officeDatas->officeid][$posDefault] + 1
                        : 1;
                }
            }
        }

        $pdf = Pdf::loadView('admin.plantilla.reports.occupancy-report.pdf', compact(
            'motherDepartmentAgency',
            'planPosition',
            'office',
            'currentDate',
            'counts',
        ))
            ->setPaper('a4', 'landscape');
        return $pdf->stream($motherDepartmentAgency->acronym . '.pdf');
    }
}