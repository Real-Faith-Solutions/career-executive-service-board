<?php

namespace App\Http\Controllers\Plantilla;

use App\Http\Controllers\Controller;
use App\Models\PersonalData;
use App\Models\Plantilla\AgencyLocation;
use App\Models\Plantilla\ApptStatus;
use App\Models\Plantilla\ClassBasis;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\Office;
use App\Models\Plantilla\OtherAssignment;
use App\Models\Plantilla\PlanAppointee;
use App\Models\Plantilla\PlanPosition;
use App\Models\Plantilla\PlanPositionLevelLibrary;
use App\Models\Plantilla\PositionAppointee;
use App\Models\Plantilla\PositionMasterLibrary;
use App\Models\Plantilla\SectorManager;
use App\Models\ProfileLibCities;
use App\Models\ProfileLibTblAppAuthority;
use App\Models\ProfileTblCesStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ConvertDateTimeToDate;

class AppointeeOccupantManagerController extends Controller
{
    private ConvertDateTimeToDate $convertDateTimeToDate;

    public function __construct(ConvertDateTimeToDate $convertDateTimeToDate)
    {
        $this->convertDateTimeToDate = $convertDateTimeToDate;
        // $this->boardInterView = new BoardInterView();
    }

    public function create(Request $request, $sectorid, $deptid, $officelocid, $officeid, $plantilla_id)
    {
        $sector = SectorManager::find($sectorid);
        $department = DepartmentAgency::find($deptid);
        $departmentLocation = AgencyLocation::find($officelocid);
        $office = Office::find($officeid);
        $planPosition = PlanPosition::find($plantilla_id);

        $cities = ProfileLibCities::orderBy('name', 'ASC')->get();
        $appAuthority = ProfileLibTblAppAuthority::select('code', 'description')
            ->orderBy('description', 'asc')
            ->get();

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
            $personalData = PersonalData::where('cesno', $cesno)
                ->select('cesno', 'title', 'lastname', 'firstname', 'name_extension', 'picture', 'emailadd', 'status', 'birthdate')
                ->first();

            if (!$personalData) {
                return redirect()->back()->with('error', 'No Personal data found.');
            } else {
                $authority = ProfileTblCesStatus::where('cesno', $personalData->cesno)
                    ->where('cesstat_code', $personalData->CESStat_code)
                    ->first();
            }
        } else {
            $personalData = null;
            $authority = null;
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
            'appAuthority',

        ));;
    }

    public function store(Request $request)
    {

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $cesno = $request->cesno;
        $plantilla_id = $request->plantilla_id;
        $planAppointee = PlanAppointee::where('cesno', $cesno)
            ->select('is_appointee')
            ->get();

        $planPosition = PlanPosition::find($plantilla_id);

        $is_appointee = $request->is_appointee;

        if ($is_appointee == true) {

            foreach ($planAppointee as $data) {
                if ($data->is_appointee == true) {
                    return redirect()->back()->with('error', 'This Official is already appointed in other position');
                }
            }

            $hasAppointee = $planPosition->planAppointee()->where('is_appointee', true)->exists();

            if ($hasAppointee) {
                return redirect()->back()->with('error', 'This Position is already have appointees');
            }
        }

        $request->validate([
            'appt_stat_code' => ['required'],
            'appt_date' => ['required'],
            'assum_date' => ['required'],
        ], [
            'appt_stat_code.required' => 'The Personnel Movement field is required.',
            'assum_date.required' => 'The Assumption Date field is required.',
            'appt_date.required' => 'The Appointment Date field is required.',
        ]);

        $planAppointee = PlanAppointee::create([
            'plantilla_id' => $request->input('plantilla_id'),
            'cesno' => $request->input('cesno'),
            'appt_stat_code' => $request->input('appt_stat_code'),
            'appt_date' => $request->input('appt_date'),
            'assum_date' => $request->input('assum_date'),
            'is_appointee' => $request->input('is_appointee'),
            'ofc_stat_code' => $request->input('ofc_stat_code'),
            'basis' => $request->input('basis'),
            'created_user' => $encoder,
            'lastupd_user' => $encoder,
        ]);

        PositionAppointee::create([
            'appointee_id' => $planAppointee->appointee_id,
            'name' => $request->name,
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
        $otherAssignment = OtherAssignment::where('cesno', $appointees->cesno)->paginate(25);

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
            'otherAssignment',

        ));;
    }
    public function edit(Request $request, $sectorid, $deptid, $officelocid, $officeid, $plantilla_id, $appointee_id)
    {
        $sector = SectorManager::find($sectorid);
        $department = DepartmentAgency::find($deptid);
        $departmentLocation = AgencyLocation::find($officelocid);
        $office = Office::find($officeid);
        $planPosition = PlanPosition::find($plantilla_id);
        $appointees = PlanAppointee::find($appointee_id);
        $assumDate = $appointees->assum_date;
        $apptDate = $appointees->appt_date;
        $convertedAssumDate = $this->convertDateTimeToDate->convertDateGeneral($assumDate);
        $convertedApptDate = $this->convertDateTimeToDate->convertDateGeneral($apptDate);
        $appAuthority = ProfileLibTblAppAuthority::select('code', 'description')
            ->orderBy('description', 'asc')
            ->get();
        $selectedAppAuthority = PositionAppointee::select('id', 'name')
            ->where('appointee_id', $appointee_id)
            ->latest()
            ->first();


        $cities = ProfileLibCities::orderBy('name', 'ASC')->get();

        $planAppointee = PlanAppointee::query()
            ->where('plantilla_id', $planPosition->plantilla_id)
            ->get();

        $authority = ProfileTblCesStatus::where('cesno', $appointees->personalData->cesno)
            ->where('cesstat_code', $appointees->personalData->CESStat_code)
            ->first();

        $planPositionLibrary = PlanPositionLevelLibrary::orderBy('title', 'ASC')->get();
        $positionMasterLibrary = PositionMasterLibrary::orderBy('dbm_title', 'ASC')->get();
        $classBasis = ClassBasis::orderBy('basis', 'ASC')->get();
        $apptStatus = ApptStatus::orderBy('title', 'ASC')->get();
        $otherAssignment = OtherAssignment::where('cesno', $appointees->cesno)->get();

        return view('admin.plantilla.appointee_occupant_browser.show', compact(
            'selectedAppAuthority',
            'appAuthority',
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
            'otherAssignment',
            'authority',
            'convertedAssumDate',
            'convertedApptDate',

        ));;
    }

    public function update(Request $request, $appointee_id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $request->validate([
            'appt_stat_code' => ['required'],
            'appt_date' => ['required'],
            'assum_date' => ['required'],
        ]);

        $planAppointee = PlanAppointee::withTrashed()->findOrFail($appointee_id);
        $positionAppointee = PositionAppointee::withTrashed()->findOrFail($appointee_id);
        $planAppointee->update([
            'appt_stat_code' => $request->input('appt_stat_code'),
            'appt_date' => $request->input('appt_date'),
            'assum_date' => $request->input('assum_date'),
            'is_appointee' => $request->input('is_appointee'),
            'ofc_stat_code' => $request->input('ofc_stat_code'),
            'basis' => $request->input('basis'),
            'lastupd_user' => $encoder,
        ]);

        $positionAppointee->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->back()->with('message', 'The item has been successfully updated!');
    }
}
