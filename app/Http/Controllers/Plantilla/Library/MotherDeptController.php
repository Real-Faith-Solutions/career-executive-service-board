<?php

namespace App\Http\Controllers\Plantilla\Library;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\MotherDept;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MotherDeptController extends Controller
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
        $datas = MotherDept::query()
            ->where('title', 'LIKE', "%$query%")
            ->paginate(25);
        return view('admin.plantilla.library.mother_department.index', compact(
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
            'title' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:plantilla_motherdept'],
        ]);
        MotherDept::create([
            'title' => $request->input('title'),
            'encoder' => $encoder,
            'updated_by' => $encoder,
        ]);
        return redirect()->back()->with('message', 'The item has been successfully added!');
    }

    public function create()
    {
        return view('admin.plantilla.library.mother_department.create');
    }
    
    public function edit($deptid)
    {
        $datas = MotherDept::withTrashed()->findOrFail($deptid);
        return view('admin.plantilla.library.mother_department.edit', compact(
            'datas',
        ));
    }

    public function update(Request $request, $deptid)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $request->validate([
            'title' => ['required', 'max:40', 'min:2', 'unique:plantilla_motherdept',],
        ]);

        $datas = MotherDept::withTrashed()->findOrFail($deptid);
        $datas->update([
            'title' => $request->input('title'),
            'updated_by' => $encoder,
        ]);

        return redirect()->back()->with('message', 'The item has been successfully updated!');
    }

    public function trash()
    {
        $datas = MotherDept::onlyTrashed()
            ->get();
        return view('admin.plantilla.library.mother_department.trash', compact('datas'));
    }

    public function restore($deptid)
    {
        $datas = MotherDept::onlyTrashed()->findOrFail($deptid);
        $datas->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    public function destroy($deptid)
    {
        $data = MotherDept::findOrFail($deptid);

        if ($data->deptAgency()->exists()) {
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

    public function forceDelete($deptid)
    {
        try {
            // Find the soft-deleted record by its ID
            $data = MotherDept::onlyTrashed()->findOrFail($deptid);

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
