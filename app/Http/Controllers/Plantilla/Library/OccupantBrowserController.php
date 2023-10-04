<?php

namespace App\Http\Controllers\Plantilla\Library;

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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OccupantBrowserController extends Controller
{
    public function index()
    {
        $datas = PlanAppointee::all();
        // $sector = SectorManager::orderBy('title', 'ASC')->get();
        // $department = DepartmentAgency::orderBy('title', 'ASC')->get();
        // $departmentLocation = AgencyLocation::orderBy('title', 'ASC')->get();
        // $office = Office::orderBy('title', 'ASC')->get();

        $planPositionLibrary = PlanPositionLevelLibrary::orderBy('title', 'ASC')->get();
        $positionMasterLibrary = PositionMasterLibrary::orderBy('dbm_title', 'ASC')->get();
        $classBasis = ClassBasis::orderBy('basis', 'ASC')->get();
        $apptStatus = ApptStatus::orderBy('title', 'ASC')->get();

        return view('admin.plantilla.library.occupant_browser.index', compact(
            'datas',
            'planPositionLibrary',
            'positionMasterLibrary',
            'classBasis',
            'apptStatus',

        ));;
    }

    public function create(Request $request)
    {
        $planPositions = PlanPosition::all();
        $sector = SectorManager::orderBy('title', 'ASC')->get();
        $department = DepartmentAgency::orderBy('title', 'ASC')->get();
        $agencyLocation = AgencyLocation::orderBy('title', 'ASC')->get();
        $office = Office::orderBy('title', 'ASC')->get();

        $planPositionLibrary = PlanPositionLevelLibrary::orderBy('title', 'ASC')->get();
        $positionMasterLibrary = PositionMasterLibrary::orderBy('dbm_title', 'ASC')->get();
        $classBasis = ClassBasis::orderBy('basis', 'ASC')->get();
        $apptStatus = ApptStatus::orderBy('title', 'ASC')->get();
        $personalDataList = PersonalData::all();

        $cesno = $request->input('cesnoSearch');
        if ($cesno !== null) {
            $personalData = PersonalData::where('cesno', $cesno)->first();
            if (!$personalData) {
                return redirect()->back()->with('error', 'No Personal data found.');
            }
        } else {
            $personalData = null;
        }

        return view('admin.plantilla.library.occupant_browser.create', compact(
            'planPositions',
            'sector',
            'department',
            'agencyLocation',
            'office',
            'planPositionLibrary',
            'positionMasterLibrary',
            'classBasis',
            'apptStatus',
            'personalDataList',
            'cesno',
            'personalData',

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
        ], [
            'plantilla_id.required' => 'The Position field is required.',
            'cesno.unique' => 'This official is already appointed to another position.',
            'appt_stat_code.required' => 'The Personnel Movement field is required.',
            'assum_date.required' => 'The Assumption Date field is required.',
            'appt_date.required' => 'The Appointment Date field is required.',
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
            'lastupd_user' => $encoder,
        ]);



        return redirect()->back()->with('message', 'The item has been successfully added!');
    }

    public function destroy($appointee_id)
    {
        $data = PlanAppointee::findOrFail($appointee_id);

        if ($data->personalData()->exists()) {
            return redirect()->back()->with('error', 'Cannot delete this item because it has related records.');
        }
        if ($data->apptStatus()->exists()) {
            return redirect()->back()->with('error', 'Cannot delete this item because it has related records.');
        }

        try {
            $data->delete();

            if ($data->trashed()) {
                return redirect()->back()->with('message', 'The item has been successfully deleted!');
            } else {
                return redirect()->back()->with('error', 'Something went wrong!');
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'Record not found!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function trash()
    {
        $datas = PlanAppointee::onlyTrashed()
            ->get();
        return view('admin.plantilla.library.occupant_browser.trash', compact('datas'));
    }

    public function restore($appointee_id)
    {
        $datas = PlanAppointee::onlyTrashed()->findOrFail($appointee_id);
        $datas->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    public function forceDelete($appointee_id)
    {
        try {
            // Find the soft-deleted record by its ID
            $data = PlanAppointee::onlyTrashed()->findOrFail($appointee_id);

            // Permanently delete the record
            $data->forceDelete();

            // Check if the delete operation was successful
            if ($data) {
                return redirect()->back()->with('message', 'The item has been successfully deleted!');
            } else {
                return redirect()->back()->with('error', 'Something went wrong!');
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            // Handle the case where the record is not found
            return redirect()->back()->with('error', 'Record not found!');
        } catch (\Exception $exception) {
            // Handle other exceptions if they occur
            return redirect()->back()->with('error', 'An error occurred!');
        }
    }

    public function edit($appointee_id)
    {
        $datas = PlanAppointee::find($appointee_id);
        $sector = SectorManager::orderBy('title', 'ASC')->get();
        $department = DepartmentAgency::orderBy('title', 'ASC')->get();
        $agencyLocation = AgencyLocation::orderBy('title', 'ASC')->get();
        $office = Office::orderBy('title', 'ASC')->get();

        $planPositionLibrary = PlanPositionLevelLibrary::orderBy('title', 'ASC')->get();
        $positionMasterLibrary = PositionMasterLibrary::orderBy('dbm_title', 'ASC')->get();
        $classBasis = ClassBasis::orderBy('basis', 'ASC')->get();
        $apptStatus = ApptStatus::orderBy('title', 'ASC')->get();


        return view('admin.plantilla.library.occupant_browser.edit', compact(
            'datas',
            'sector',
            'department',
            'agencyLocation',
            'office',
            'planPositionLibrary',
            'positionMasterLibrary',
            'classBasis',
            'apptStatus',

        ));;
    }
}
