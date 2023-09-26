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
use App\Models\Plantilla\PositionMasterLibrary;
use App\Models\Plantilla\SectorManager;
use App\Models\ProfileLibCities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtherAssignmentController extends Controller
{

    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $request->validate([
            'appt_status_code' => ['required'],
            'from_dt' => ['required'],
            'to_dt' => ['required'],
        ], [
            'appt_status_code.required' => 'This Status field is required.',
            'from_dt.required' => 'This From date field is required.',
            'to_dt.required' => 'This To date field is required.',
        ]);

        $data = $request->all();
        $data['encoder'] = $encoder;
        $data['lastupd_enc'] = $encoder;

        OtherAssignment::create($data);

        return redirect()->back()->with('message', 'The item has been successfully added!');
    }

    public function destroy($detailed_code)
    {
        $datas = OtherAssignment::findOrFail($detailed_code);
        $datas->delete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }

    public function show(Request $request, $sectorid, $deptid, $officelocid, $officeid, $plantilla_id, $appointee_id, $detailed_code)
    {
        $sector = SectorManager::find($sectorid);
        $department = DepartmentAgency::find($deptid);
        $departmentLocation = AgencyLocation::find($officelocid);
        $office = Office::find($officeid);
        $planPosition = PlanPosition::find($plantilla_id);
        $appointees = PlanAppointee::find($appointee_id);
        $otherAssignment = OtherAssignment::find($detailed_code);
        $cities = ProfileLibCities::orderBy('name', 'ASC')->get();

        $planAppointee = PlanAppointee::query()
            ->where('plantilla_id', $planPosition->plantilla_id)
            ->get();

        $planPositionLibrary = PlanPositionLevelLibrary::orderBy('title', 'ASC')->get();
        $positionMasterLibrary = PositionMasterLibrary::orderBy('dbm_title', 'ASC')->get();
        $classBasis = ClassBasis::orderBy('basis', 'ASC')->get();
        $apptStatus = ApptStatus::orderBy('title', 'ASC')->get();

        return view('admin.plantilla.other_assignment.edit', compact(
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

    public function update(Request $request, $detailed_code)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $request->validate([
            'appt_status_code' => ['required'],
            'from_dt' => ['required'],
            'to_dt' => ['required'],
        ], [
            'appt_status_code.required' => 'This Status field is required.',
            'from_dt.required' => 'This From date field is required.',
            'to_dt.required' => 'This To date field is required.',
        ]);

        $data = $request->all();
        $data['lastupd_enc'] = $encoder;

        $otherAssignment = OtherAssignment::find($detailed_code);
        $otherAssignment->update($data);

        return redirect()->back()->with('message', 'The item has been successfully updated!');
    }
}
