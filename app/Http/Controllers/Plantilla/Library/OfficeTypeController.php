<?php

namespace App\Http\Controllers\Plantilla\Library;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\DepartmentAgencyType;
use App\Models\Plantilla\SectorManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficeTypeController extends Controller
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
        $sectorDropdown = $request->input('sectorDropdown');

        $filterDropdown = DepartmentAgencyType::query();

        if ($sectorDropdown) {
            $filterDropdown->where('sectorid', $sectorDropdown);
        }


        $datas = $filterDropdown->paginate(25);


        $sector = SectorManager::orderBy('title', 'ASC')->get();
        return view('admin.plantilla.library.office_type.index', compact(
            'datas',
            'query',
            'sector',
            'sectorDropdown',
        ));
    }

    public function create()
    {
        $sectors = SectorManager::orderBy('title', 'ASC')->get();
        return view('admin.plantilla.library.office_type.create', compact(
            'sectors'
        ));
    }

    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();
        $request->validate([
            'title' => ['required', 'max:40', 'min:2'],
            'sectorid' => ['required'],
        ]);

        $data = $request->all();
        $data['encoder'] = $encoder;
        $data['updated_by'] = $encoder;
        DepartmentAgencyType::create($data);
        return redirect()->back()->with('message', 'The item has been successfully added!');
    }

    public function destroy($agency_typeid)
    {
        $data = DepartmentAgencyType::findOrFail($agency_typeid);

        if ($data->departmentAgency()->exists()) {
            return redirect()->back()->with('error', 'Cannot delete this item because it has related records.');
        }
        if ($data->sector()->exists()) {
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

    public function edit($agency_typeid)
    {
        $datas = DepartmentAgencyType::withTrashed()->findOrFail($agency_typeid);
        $sectors = SectorManager::orderBy('title', 'ASC')->get();

        return view('admin.plantilla.library.office_type.edit', compact(
            'datas',
            'sectors',
        ));
    }

    public function update(Request $request, $agency_typeid)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $request->validate([
            'title' => ['required', 'max:40', 'min:2'],
            'sectorid' => ['required'],
        ]);

        $datas = DepartmentAgencyType::withTrashed()->findOrFail($agency_typeid);
        $datas->update([
            'title' => $request->input('title'),
            'sectorid' => $request->input('sectorid'),
            'encoder' => $encoder,
            'updated_by' => $encoder,
        ]);

        return redirect()->back()->with('message', 'The item has been successfully updated!');
    }

    public function trash()
    {
        $datas = DepartmentAgencyType::onlyTrashed()
            ->get();
        return view('admin.plantilla.library.office_type.trash', compact('datas'));
    }

    public function restore($agency_typeid)
    {
        $datas = DepartmentAgencyType::onlyTrashed()->findOrFail($agency_typeid);
        $datas->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    public function forceDelete($agency_typeid)
    {
        try {
            // Find the soft-deleted record by its ID
            $data = DepartmentAgencyType::onlyTrashed()->findOrFail($agency_typeid);

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
