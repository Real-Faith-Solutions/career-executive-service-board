<?php

namespace App\Http\Controllers\Plantilla\Reports;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\Office;
use App\Models\Plantilla\PlanPosition;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttachedOccupancyReportController extends Controller
{
    public function index()
    {
        $motherDepartment = DepartmentAgency::where('is_national_government', 1)->get();
        return view('admin.plantilla.reports.attached-occupancy-report.index', compact(
            'motherDepartment'
        ));
    }

    public function generatePDF($deptid)
    {
        $currentDate = Carbon::now()->format('d F Y');
        $motherDepartmentAgency = DepartmentAgency::select('deptid', 'title', 'acronym', 'mother_deptid')
            ->find($deptid);


        $office = Office::whereHas('agencyLocation.departmentAgency', function ($query) use ($deptid) {
            $query->where('mother_deptid', $deptid);
        })
            ->orderBy('title', 'asc')
            ->get();

        $planPosition = PlanPosition::select('plantilla_id', 'pos_default', 'corp_sg', 'item_no', 'officeid', 'is_ces_pos', 'pres_apptee')
            ->whereHas('office.agencyLocation.departmentAgency', function ($query) use ($deptid) {
                $query->where('mother_deptid', $deptid)
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
            ['item_no', 'asc'],
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

        $pdf = Pdf::loadView('admin.plantilla.reports.attached-occupancy-report.pdf', compact(
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
