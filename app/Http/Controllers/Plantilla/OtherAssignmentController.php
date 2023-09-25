<?php

namespace App\Http\Controllers\Plantilla;

use App\Http\Controllers\Controller;
use App\Models\PersonalData;
use App\Models\Plantilla\AgencyLocation;
use App\Models\Plantilla\ApptStatus;
use App\Models\Plantilla\ClassBasis;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\Office;
use App\Models\Plantilla\PlanAppointee;
use App\Models\Plantilla\PlanPosition;
use App\Models\Plantilla\PlanPositionLevelLibrary;
use App\Models\Plantilla\PositionMasterLibrary;
use App\Models\Plantilla\SectorManager;
use App\Models\ProfileLibCities;
use Illuminate\Http\Request;

class OtherAssignmentController extends Controller
{

    public function create(Request $request, $sectorid, $deptid, $officelocid, $officeid, $plantilla_id)
    {
        $sector = SectorManager::find($sectorid);
        $department = DepartmentAgency::find($deptid);
        $departmentLocation = AgencyLocation::find($officelocid);
        $office = Office::find($officeid);
        $planPosition = PlanPosition::find($plantilla_id);

        $cities = ProfileLibCities::orderBy('name', 'ASC')->get();

        $planAppointee = PlanAppointee::query()
            ->where('plantilla_id', $planPosition->plantilla_id)
            ->get();

        $planPositionLibrary = PlanPositionLevelLibrary::orderBy('title', 'ASC')->get();
        $positionMasterLibrary = PositionMasterLibrary::orderBy('dbm_title', 'ASC')->get();
        $apptStatus = ApptStatus::orderBy('title', 'ASC')->get();

        return view('admin.plantilla.other_assignment.create', compact(
            'sector',
            'department',
            'departmentLocation',
            'office',
            'cities',
            'planAppointee',
            'planPositionLibrary',
            'positionMasterLibrary',
            'planPosition',
            'apptStatus',
            'personalData',

        ));;
    }
}
