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
use Illuminate\Support\Facades\Auth;

class AppointeeOccupantManagerController extends Controller
{
    public function index()
    {
        return view('admin.plantilla.appointee_occupant_manager.index');
    }

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
        $classBasis = ClassBasis::orderBy('basis', 'ASC')->get();
        $apptStatus = ApptStatus::orderBy('title', 'ASC')->get();
        $personalDataList = PersonalData::all();

        $cesno = $request->input('cesnoSearch');
        if ($cesno !== null) {
            $personalData = PersonalData::where('cesno', $cesno)->first();

            // You can handle the case when no matching PersonalData is found here
            if (!$personalData) {
                return redirect()->back()->with('error', 'No Personal data found.');
            }
        } else {
            // Handle the case when cesno is not provided or is null
            $personalData = null; // Set it to null or handle it as needed
        }

        return view('admin.plantilla.appointee_occupant_browser.create', compact(
            'sector',
            'department',
            'departmentLocation',
            'office',
            'cities',
            'planAppointee',
            'planPositionLibrary',
            'positionMasterLibrary',
            'classBasis',
            'planPosition',
            'apptStatus',
            'personalData',
            'cesno',
            'personalDataList',

        ));;
    }

    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $request->validate([
            'plantilla_id' => ['required'],
            'cesno' => ['required', 'unique:plantilla_tblPlanAppointees'],
            'appt_stat_code' => ['required'],
            'appt_date' => ['required'],
            'assum_date' => ['required'],

        ]);

        PlanAppointee::create([
            'plantilla_id' => $request->input('plantilla_id'),
            'cesno' => $request->input('cesno'),
            'appt_stat_code' => $request->input('appt_stat_code'),
            'appt_date' => $request->input('appt_date'),
            'assum_date' => $request->input('assum_date'),
            'is_appointee' => $request->input('is_appointee'),
            'ofc_stat_code' => $request->input('ofc_stat_code'),
            'basis' => $request->input('basis'),
            'created_user' => $encoder,
        ]);



        return redirect()->back()->with('message', 'The item has been successfully added!');
    }

    public function destroy($appointee_id)
    {
        $datas = PlanAppointee::findOrFail($appointee_id);
        $datas->delete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }


    public function show(Request $request, $sectorid, $deptid, $officelocid, $officeid, $plantilla_id, $appointee_id)
    {
        $sector = SectorManager::find($sectorid);
        $department = DepartmentAgency::find($deptid);
        $departmentLocation = AgencyLocation::find($officelocid);
        $office = Office::find($officeid);
        $planPosition = PlanPosition::find($plantilla_id);
        $appointees = PlanAppointee::find($appointee_id);

        $cities = ProfileLibCities::orderBy('name', 'ASC')->get();


        $planAppointee = PlanAppointee::query()
            ->where('plantilla_id', $planPosition->plantilla_id)
            ->get();

        $planPositionLibrary = PlanPositionLevelLibrary::orderBy('title', 'ASC')->get();
        $positionMasterLibrary = PositionMasterLibrary::orderBy('dbm_title', 'ASC')->get();
        $classBasis = ClassBasis::orderBy('basis', 'ASC')->get();
        $apptStatus = ApptStatus::orderBy('title', 'ASC')->get();
        return view('admin.plantilla.appointee_occupant_browser.edit', compact(
            'sector',
            'department',
            'departmentLocation',
            'office',
            'cities',
            'planAppointee',
            'planPositionLibrary',
            'positionMasterLibrary',
            'classBasis',
            'planPosition',
            'apptStatus',
            'appointees',

        ));;
    }
}
