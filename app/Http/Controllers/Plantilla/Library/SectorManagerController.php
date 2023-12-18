<?php

namespace App\Http\Controllers\Plantilla\Library;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\SectorManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SectorManagerController extends Controller
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
        $datas = SectorManager::query()
            ->where('title', 'LIKE', "%$query%")
            ->paginate(25);
        return view('admin.plantilla.library.sector_manager.index', compact(
            'datas',
            'query',
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:50', 'min:2', 'unique:plantilla_tblSector'],
            'description' => ['required', 'max:255', 'min:2',],
        ]);
        SectorManager::create($request->all());
        return redirect()->back()->with('message', 'The item has been successfully added!');
    }

    public function create()
    {
        return view('admin.plantilla.library.sector_manager.create');
    }

    public function edit($sectorid)
    {
        $datas = SectorManager::withTrashed()->findOrFail($sectorid);
        return view('admin.plantilla.library.sector_manager.edit', compact(
            'datas',
        ));
    }

    public function update(Request $request, $sectorid)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $request->validate([
            'title' => [
                'required',
                'max:50',
                'min:2',
                Rule::unique('plantilla_tblSector')->ignore($sectorid, 'sectorid')
            ],
            'description' => [
                'required',
                'max:255',
                'min:2',
            ],
        ]);

        $datas = SectorManager::withTrashed()->findOrFail($sectorid);
        $datas->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'encoder' => $encoder,
        ]);

        return redirect()->back()->with('message', 'The item has been successfully updated!');
    }

    public function trash()
    {
        $datas = SectorManager::onlyTrashed()
            ->get();
        return view('admin.plantilla.library.sector_manager.trash', compact('datas'));
    }

    public function restore($sectorid)
    {
        $datas = SectorManager::onlyTrashed()->findOrFail($sectorid);
        $datas->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    public function destroy($sectorid)
    {
        $data = SectorManager::findOrFail($sectorid);

        if ($data->departmentAgency()->exists()) {
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

    public function forceDelete($sectorid)
    {
        try {
            // Find the soft-deleted record by its ID
            $data = SectorManager::onlyTrashed()->findOrFail($sectorid);

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
