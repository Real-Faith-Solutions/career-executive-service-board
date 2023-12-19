<?php

namespace App\Http\Controllers\Plantilla\Library;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\ApptStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonnelMovementController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkPermission:plantilla_view_library')->only('index');
 
        $this->middleware('checkPermission:plantilla_add_library')->only(['store', 'create']);
 
        $this->middleware('checkPermission:plantilla_edit_library')->only(['edit', 'update']);

        $this->middleware('checkPermission:plantilla_delete_library')->only(['trash', 'restore', 'destroy', 'forceDelete']);
    }

    public function index(Request $request)
    {
        $query = $request->input('search');

        $datas = ApptStatus::query()
            ->where('title', 'LIKE', "%$query%")
            ->paginate(25);
        return view('admin.plantilla.library.personnel_movement.index', compact(
            'datas',
            'query',
        ));
    }

    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $request->validate([
            'title' => ['required', 'max:50', 'min:2', 'unique:plantillalib_tblapptstatus'],
        ]);
        $data = $request->all();
        $data['encoder'] = $encoder;
        $data['updated_by'] = $encoder;
        ApptStatus::create($data);
        return redirect()->back()->with('message', 'The item has been successfully added!');
    }

    public function create()
    {
        return view('admin.plantilla.library.personnel_movement.create');
    }
    
    public function edit($appt_stat_code)
    {
        $datas = ApptStatus::withTrashed()->findOrFail($appt_stat_code);
        return view('admin.plantilla.library.personnel_movement.edit', compact(
            'datas',
        ));
    }

    public function update(Request $request, $appt_stat_code)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $request->validate([
            'title' => ['required', 'max:50', 'min:2', 'unique:plantillalib_tblapptstatus'],

        ]);

        $datas = ApptStatus::withTrashed()->findOrFail($appt_stat_code);
        $datas->update([
            'title' => $request->input('title'),
            'updated_by' => $encoder,
        ]);

        return redirect()->back()->with('message', 'The item has been successfully updated!');
    }

    public function trash()
    {
        $datas = ApptStatus::onlyTrashed()
            ->get();
        return view('admin.plantilla.library.personnel_movement.trash', compact('datas'));
    }

    public function restore($appt_stat_code)
    {
        $datas = ApptStatus::onlyTrashed()->findOrFail($appt_stat_code);
        $datas->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    public function destroy($appt_stat_code)
    {
        $data = ApptStatus::findOrFail($appt_stat_code);

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

    public function forceDelete($appt_stat_code)
    {
        try {
            // Find the soft-deleted record by its ID
            $data = ApptStatus::onlyTrashed()->findOrFail($appt_stat_code);

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
