<?php

namespace App\Http\Controllers\Plantilla\Library;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\AgencyLocation;
use App\Models\Plantilla\AgencyLocationLibrary;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\SectorManager;
use App\Models\ProfileLibTblRegion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgencyLocationManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search');
        $agencyLocation = AgencyLocation::query()
            ->where('title', 'LIKE', "%$query%")
            ->orWhere('acronym', 'LIKE', "%$query%")
            ->paginate(25);
        $agencyLocationLibrary = AgencyLocationLibrary::all();
        $region = ProfileLibTblRegion::orderBy('regionSeq', 'ASC')->get();

        return view('admin.plantilla.library.agency_location_manager.index', compact(
            'agencyLocation',
            'agencyLocationLibrary',
            'region',
            'query',
        ));
    }

    public function create()
    {
        $sectors = SectorManager::all();
        $departmentAgencies = DepartmentAgency::all();
        $agencyLocationLibrary = AgencyLocationLibrary::all();
        $region = ProfileLibTblRegion::orderBy('regionSeq', 'ASC')->get();

        return view('admin.plantilla.library.agency_location_manager.create', compact(
            'sectors',
            'departmentAgencies',
            'agencyLocationLibrary',
            'region',
        ));
    }

    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $request->validate([
            'deptid' => ['required'],
            'title' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'acronym' => ['required', 'max:10', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'loctype_id' => ['required'],
            'region' => ['required'],
        ]);
        AgencyLocation::create([
            'deptid' => $request->input('deptid'),
            'title' => $request->input('title'),
            'acronym' => $request->input('acronym'),
            'loctype_id' => $request->input('loctype_id'),
            'telno' => $request->input('telno'),
            'emailaddr' => $request->input('emailaddr'),
            'region' => $request->input('region'),
            'encoder' => $encoder,
            'updated_by' => $encoder,
        ]);
        return redirect()->back()->with('message', 'The item has been successfully added!');
    }

    public function destroy($officelocid)
    {
        $data = AgencyLocation::findOrFail($officelocid);

        if ($data->agencyLocationLibrary()->exists()) {
            return redirect()->back()->with('error', 'Cannot delete this item because it has related records.');
        }
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

    public function forceDelete($officelocid)
    {
        try {
            // Find the soft-deleted record by its ID
            $data = AgencyLocation::onlyTrashed()->findOrFail($officelocid);

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

    public function edit($officelocid)
    {
        $agencyLocation = AgencyLocation::find($officelocid);

        $sectors = SectorManager::all();
        $departmentAgencies = DepartmentAgency::all();
        $agencyLocationLibrary = AgencyLocationLibrary::all();
        $region = ProfileLibTblRegion::orderBy('regionSeq', 'ASC')->get();

        return view('admin.plantilla.library.agency_location_manager.edit', compact(
            'agencyLocation',
            'sectors',
            'departmentAgencies',
            'agencyLocationLibrary',
            'region',
        ));
    }

    public function update(Request $request, $officelocid)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();
        $request->validate([
            'deptid' => ['required'],
            'title' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'acronym' => ['required', 'max:10', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'loctype_id' => ['required'],
            'region' => ['required'],
        ]);

        $departmentLocation = AgencyLocation::withTrashed()->findOrFail($officelocid);
        $departmentLocation->update([
            'deptid' => $request->input('deptid'),
            'title' => $request->input('title'),
            'acronym' => $request->input('acronym'),
            'loctype_id' => $request->input('loctype_id'),
            'telno' => $request->input('telno'),
            'emailaddr' => $request->input('emailaddr'),
            'region' => $request->input('region'),
            'updated_by' => $encoder,
        ]);


        return redirect()->back()->with('message', 'The item has been successfully updated!');
    }

    public function trash()
    {
        $datas = AgencyLocation::onlyTrashed()
            ->get();
        return view('admin.plantilla.library.agency_location_manager.trash', compact('datas'));
    }

    public function restore($officelocid)
    {
        $datas = AgencyLocation::onlyTrashed()->findOrFail($officelocid);
        $datas->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }
}
