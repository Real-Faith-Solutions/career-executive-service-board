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
        $motherDepartment = DepartmentAgency::query()
            ->select('deptid', 'title')
            ->where('mother_deptid', 0)
            ->whereHas('agencyLocation.office.planPosition', function ($query) {
                $query->where('is_ces_pos', 1)
                    ->where('pres_apptee', 1)
                    ->where('is_active', 1);
            })
            ->orderBy('title', 'asc')
            ->get();
        return view('admin.plantilla.reports.occupancy-report.index', compact(
            'motherDepartment'
        ));
    }

    public function generatePDF($deptid)
    {
        $totalPosition = PlanPosition::query()
            ->where('is_ces_pos', 1)
            ->where('pres_apptee', 1)
            ->where('is_active', 1)
            ->whereHas('office.agencyLocation.departmentAgency', function ($query) use ($deptid) {
                $query->where('deptid', $deptid);
            })

            ->count();

        $currentDate = Carbon::now()->format('d F Y');
        $motherDepartmentAgency = DepartmentAgency::select('deptid', 'title', 'acronym', 'lastsubmit_dt')
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
            ->with(['planAppointee.personalData']) // Eager load relationships
            ->orderBy('corp_sg', 'desc')
            ->orderBy('item_no', 'desc') // Add this line to order by item_no
            ->get();

        // Sorting the collection based on corp_sg, item_no, and lastname
        $planPosition = $planPosition->sortBy([
            ['corp_sg', 'desc'],
            ['item_no', 'desc'],
            ['planAppointee.personalData.lastname', 'asc'],
        ]);

        // Rest of your code remains unchanged
        $counts = [];
        foreach ($office as $officeDatas) {
            $counts[$officeDatas->officeid] = [];
            foreach ($planPosition as $planPositionDatas) {
                if ($officeDatas->officeid == $planPositionDatas->officeid) {
                    $posDefault = $planPositionDatas->pos_default;
                    $counts[$officeDatas->officeid][$posDefault] = isset($counts[$officeDatas->officeid][$posDefault])
                        ? $counts[$officeDatas->officeid][$posDefault] + 1
                        : 1;
                }
            }
        }


        $pdf = PDF::loadView('admin.plantilla.reports.occupancy-report.pdf', compact(
            'totalPosition',
            'motherDepartmentAgency',
            'planPosition',
            'office',
            'currentDate',
            'counts',
        ))->setPaper('a4', 'landscape');

        $filename = $motherDepartmentAgency->acronym . '.pdf';
        $pdf->render($filename);
        $pageCount = $pdf->getDompdf()->getCanvas()->get_page_count();

        $pdf = PDF::loadView('admin.plantilla.reports.occupancy-report.pdf', compact(
            'pageCount',
            'totalPosition',
            'motherDepartmentAgency',
            'planPosition',
            'office',
            'currentDate',
            'counts',
        ))->setPaper('a4', 'landscape');

        return $pdf->stream($filename);
    }
}
