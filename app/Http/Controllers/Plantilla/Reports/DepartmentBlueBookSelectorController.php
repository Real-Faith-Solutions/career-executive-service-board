<?php

namespace App\Http\Controllers\Plantilla\Reports;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\DepartmentAgency;
use Illuminate\Http\Request;

class DepartmentBlueBookSelectorController extends Controller
{
    public function index(Request $request)
    {
        $motherDepartmentAgency = DepartmentAgency::query()
            ->where('is_national_government', 1)
            ->select('title', 'deptid')
            ->orderBy('title', 'asc')
            ->get();

        $motherDepartmentAgencySelector = DepartmentAgency::query()
            ->select('deptid', 'title')
            // ->where('is_national_government', 0)
            // ->orWhere('is_national_government', null)
            ->where('mother_deptid', 0)
            ->whereHas('agencyLocation.office.planPosition', function ($query){
                $query->where('is_ces_pos', 1)
                ->where('pres_apptee', 1)
                ->where('is_active', 1);
            })
            ->orderBy('title', 'asc')
            ->get();

        return view('admin.plantilla.reports.blue-book-agency-selector.index', compact(
            'motherDepartmentAgency',
            'motherDepartmentAgencySelector',
        ));
    }

    public function setAsNational(Request $request, $deptid){

        $request->validate([
            'is_national' => ['required']
        ], [
            'is_national.required' => 'Select Department',
        ]);
        
        $motherDepartmentAgency = DepartmentAgency::find($deptid);

        $motherDepartmentAgency->update(['is_national_government' => 1]);

        return redirect()->back()->with('message', 'success'.$deptid);
    }

    public function setAsNotNational(Request $request, $deptid){
        $motherDepartmentAgency = DepartmentAgency::find($deptid);

        $motherDepartmentAgency->update(['is_national_government' => null]);

        return redirect()->back()->with('message', 'success'.$deptid);
    }

    
    
}
