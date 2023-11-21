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
use App\Models\Plantilla\PositionAppointee;
use App\Models\Plantilla\PositionMasterLibrary;
use App\Models\Plantilla\SectorManager;
use App\Models\ProfileLibTblAppAuthority;
use App\Models\ProfileLibTblCesStatus;
use App\Models\ProfileTblCesStatus;
use App\Services\ConvertDateTimeToDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OccupantManagerController extends Controller
{
    private ConvertDateTimeToDate $convertDateTimeToDate;

    public function __construct(ConvertDateTimeToDate $convertDateTimeToDate)
    {
        $this->convertDateTimeToDate = $convertDateTimeToDate;
        // $this->boardInterView = new BoardInterView();

        //permissions
        $this->middleware('checkPermission:plantilla_view_library')->only('index');
 
        $this->middleware('checkPermission:plantilla_add_library')->only(['store', 'create']);
 
        $this->middleware('checkPermission:plantilla_edit_library')->only(['edit', 'update']);

        $this->middleware('checkPermission:plantilla_delete_library')->only(['trash', 'restore', 'destroy', 'forceDelete']);
    }

    public function index(Request $request)
    {
        $query = $request->input('search');
        $cesStatusDropdown = $request->input('cesStatusDropdown');

        $filterDropdown = PlanAppointee::query();

        if ($cesStatusDropdown) {
            $filterDropdown->whereHas('personalData', function ($queryBuilder) use ($cesStatusDropdown) {
                $queryBuilder->where('CESStat_code', $cesStatusDropdown);
            });
        }

        if ($query) {
            $filterDropdown->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('cesno', 'LIKE', "%$query")
                    ->orWhereHas('personalData', function ($subQuery) use ($query) {
                        $subQuery->where('firstname', 'LIKE', "%$query")
                            ->orWhere('lastname', 'LIKE', "%$query")
                            ->orWhere('middlename', 'LIKE', "%$query")
                            ->orWhere('name_extension', 'LIKE', "%$query");
                    });
                // Add more conditions if needed.
            });
        }



        $datas = $filterDropdown->paginate(25);
        $cesStatus = ProfileLibTblCesStatus::orderBy('description', 'ASC')->get();



        return view('admin.plantilla.library.occupant_manager.index', compact(
            'datas',
            'query',
            'cesStatus',
            'cesStatusDropdown',
        ));
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
        $personalDataList = PersonalData::select('cesno', 'lastname', 'firstname', 'name_extension', 'middlename')->get();
        $appAuthority = ProfileLibTblAppAuthority::select('code', 'description')
            ->orderBy('description', 'asc')
            ->get();

        $cesno = $request->input('cesnoSearch');
        if ($cesno !== null) {
            $personalData = PersonalData::where('cesno', $cesno)->first();

            $selectedPersonalData = $personalData->lastname . " " .
                $personalData->firstname . " " .
                $personalData->name_extension . " " .
                $personalData->middlename . " ";
            if (!$personalData) {
                return redirect()->back()->with('error', 'No Personal data found.');
            }
        } else {
            $personalData = null;
            $selectedPersonalData = null;
        }

        return view('admin.plantilla.library.occupant_manager.create', compact(
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
            'selectedPersonalData',
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
        return view('admin.plantilla.library.occupant_manager.trash', compact('datas'));
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

        // $authority = ProfileTblCesStatus::where('cesno', $datas->personalData->cesno)
        //     ->where('cesstat_code', $datas->personalData->CESStat_code)
        //     ->first();

        $assumDate = $datas->assum_date;
        $apptDate = $datas->appt_date;
        $convertedAssumDate = $this->convertDateTimeToDate->convertDateGeneral($assumDate);
        $convertedApptDate = $this->convertDateTimeToDate->convertDateGeneral($apptDate);

        $appAuthority = ProfileLibTblAppAuthority::select('code', 'description')
            ->orderBy('description', 'asc')
            ->get();
        $selectedAppAuthority = PositionAppointee::select('id', 'name')
            ->where('appointee_id', $appointee_id)
            ->latest()
            ->first();


        return view('admin.plantilla.library.occupant_manager.edit', compact(
            'datas',
            'sector',
            'department',
            'agencyLocation',
            'office',
            'planPositionLibrary',
            'positionMasterLibrary',
            'classBasis',
            'apptStatus',
            // 'authority',
            'appAuthority',
            'selectedAppAuthority',
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
        $planAppointee->update([
            'appt_stat_code' => $request->input('appt_stat_code'),
            'appt_date' => $request->input('appt_date'),
            'assum_date' => $request->input('assum_date'),
            'is_appointee' => $request->input('is_appointee'),
            'ofc_stat_code' => $request->input('ofc_stat_code'),
            'basis' => $request->input('basis'),
            'lastupd_user' => $encoder,
        ]);
        PositionAppointee::create([
            'appointee_id' => $planAppointee->appointee_id,
            'name' => $request->name,
        ]);

        // $positionAppointee = PositionAppointee::withTrashed()->findOrFail($appointee_id);

        // $positionAppointee->update([
        //     'name' => $request->input('name'),
        // ]);

        return redirect()->back()->with('message', 'The item has been successfully updated!');
    }
}