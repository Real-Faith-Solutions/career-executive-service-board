<?php

namespace App\Http\Controllers\Plantilla\Library;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\AgencyLocation;
use App\Models\Plantilla\ApptStatus;
use App\Models\Plantilla\OtherAssignment;
use App\Models\Plantilla\PlanAppointee;
use App\Models\Plantilla\PlanPosition;
use App\Models\ProfileLibCities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtherAssignmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkPermission:plantilla_view_library')->only('index');
 
        $this->middleware('checkPermission:plantilla_add_library')->only(['store', 'create']);
 
        $this->middleware('checkPermission:plantilla_edit_library')->only(['edit', 'update']);

        $this->middleware('checkPermission:plantilla_delete_library')->only(['trash', 'restore', 'destroy', 'forceDelete']);
    }

    public function index($appointee_id)
    {
        $appointee = PlanAppointee::find($appointee_id);
        $datas = OtherAssignment::where('cesno', $appointee->cesno)->paginate(25);
        return view('admin.plantilla.library.other_assignment.index', compact(
            'datas',
            'appointee',
        ));
    }

    public function create($appointee_id)
    {
        $appointee = PlanAppointee::find($appointee_id);
        $apptStatus = ApptStatus::orderBy('title', 'ASC')->get();
        // $departmentLocation = AgencyLocation::orderBy('title', 'ASC')->get();
        $cities = ProfileLibCities::orderBy('name', 'ASC')->get();

        return view('admin.plantilla.library.other_assignment.create', compact(
            'appointee',
            'apptStatus',
            'cities',
        ));
    }

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

    public function edit($appointee_id, $detailed_code)
    {
        $appointee_id = $appointee_id;
        $datas = OtherAssignment::find($detailed_code);
        $cities = ProfileLibCities::orderBy('name', 'ASC')->get();
        $apptStatus = ApptStatus::orderBy('title', 'ASC')->get();
        return view('admin.plantilla.library.other_assignment.edit', compact(
            'appointee_id',
            'datas',
            'cities',
            'apptStatus',
        ));
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

    public function trash($detailed_code)
    {
        $datas = OtherAssignment::onlyTrashed()
            ->get();
        $detailed_code = $detailed_code;
        return view('admin.plantilla.library.other_assignment.trash', compact(
            'datas',
            'detailed_code',
        ));
    }

    public function restore($detailed_code)
    {
        $datas = OtherAssignment::onlyTrashed()->findOrFail($detailed_code);
        $datas->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    public function destroy($detailed_code)
    {
        $data = OtherAssignment::findOrFail($detailed_code);

        if ($data->cities()->exists()) {
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

    public function forceDelete($detailed_code)
    {
        try {
            // Find the soft-deleted record by its ID
            $data = OtherAssignment::onlyTrashed()->findOrFail($detailed_code);

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
}
