<?php

namespace App\Http\Controllers\Plantilla;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\AgencyLocation;
use App\Models\Plantilla\ClassBasis;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\Office;
use App\Models\Plantilla\OfficeAddress;
use App\Models\Plantilla\PlanAppointee;
use App\Models\Plantilla\PlanPosition;
use App\Models\Plantilla\PlanPositionLevelLibrary;
use App\Models\Plantilla\PositionMasterLibrary;
use App\Models\Plantilla\SectorManager;
use App\Models\ProfileLibCities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficeManagerController extends Controller
{

    public function show(Request $request, $sectorid, $deptid, $officelocid, $officeid)
    {
        $sector = SectorManager::find($sectorid);
        $department = DepartmentAgency::find($deptid);
        $departmentLocation = AgencyLocation::find($officelocid);
        $office = Office::find($officeid);

        $cities = ProfileLibCities::orderBy('name', 'ASC')->get();


        $planPositions = PlanPosition::query()
            ->where('officeid', $office->officeid)
            ->orderBy('corp_sg', 'desc')
            ->orderBy('item_no', 'asc')
            ->paginate(25);

        $allPlanPosition = PlanPosition::all();
        $planAppointee = PlanAppointee::all();





        $planPositionLibrary = PlanPositionLevelLibrary::orderBy('title', 'ASC')->get();
        $positionMasterLibrary = PositionMasterLibrary::orderBy('dbm_title', 'ASC')->get();
        $classBasis = ClassBasis::orderBy('basis', 'ASC')->get();

        return view('admin.plantilla.office_manager.edit', compact(
            'sector',
            'department',
            'departmentLocation',
            'office',
            'cities',
            'planPositions',
            'planPositionLibrary',
            'positionMasterLibrary',
            'classBasis',
            'allPlanPosition',
            'planAppointee',
        ));;
    }
    public function edit(Request $request, $sectorid, $deptid, $officelocid, $officeid)
    {
        $sector = SectorManager::find($sectorid);
        $department = DepartmentAgency::find($deptid);
        $departmentLocation = AgencyLocation::find($officelocid);
        $office = Office::find($officeid);

        $cities = ProfileLibCities::orderBy('name', 'ASC')->get();


        $planPositions = PlanPosition::query()
            ->where('officeid', $office->officeid)
            // ->where('is_active', true)
            ->get();

        $planPositionLibrary = PlanPositionLevelLibrary::orderBy('title', 'ASC')->get();
        $positionMasterLibrary = PositionMasterLibrary::orderBy('dbm_title', 'ASC')->get();
        $classBasis = ClassBasis::orderBy('basis', 'ASC')->get();

        return view('admin.plantilla.office_manager.show', compact(
            'sector',
            'department',
            'departmentLocation',
            'office',
            'cities',
            'planPositions',
            'planPositionLibrary',
            'positionMasterLibrary',
            'classBasis',

        ));;
    }
}
