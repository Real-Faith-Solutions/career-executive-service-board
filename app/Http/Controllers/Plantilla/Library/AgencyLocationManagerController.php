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

    public function __construct()
    {
        $this->middleware('checkPermission:plantilla_view_library')->only('index');
 
        $this->middleware('checkPermission:plantilla_add_library')->only(['store', 'create']);
 
        $this->middleware('checkPermission:plantilla_edit_library')->only(['edit', 'update']);

        $this->middleware('checkPermission:plantilla_delete_library')->only(['trash', 'restore', 'destroy', 'forceDelete']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the input values
        $query = $request->input('search');
        $sectorDropdown = $request->input('sectorDropdown');
        $departmentDropdown = $request->input('departmentDropdown');

        // Initialize the query builder
        $filterDropdown = AgencyLocation::query();

        // Apply search filter if a search query is provided
        if ($query) {
            $filterDropdown->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('title', 'LIKE', "%$query%")
                    ->orWhere('acronym', 'LIKE', "%$query%");
            });
        }

        // Apply department filter if a department is selected
        if ($departmentDropdown) {
            $filterDropdown->where('deptid', $departmentDropdown);
        }

        // Get the paginated results
        $agencyLocation = $filterDropdown
            ->orderBy('title')
            ->paginate(25);

        // Retrieve dropdown data
        $sector = SectorManager::orderBy('title', 'ASC')->get();
        $department = DepartmentAgency::orderBy('title', 'ASC')->get();

        return view('admin.plantilla.library.agency_location_manager.index', compact(
            'agencyLocation',
            'query',
            'sector',
            'department',
            'sectorDropdown',
            'departmentDropdown'
        ));
    }


    public function create()
    {
        $sectors = SectorManager::select('sectorid', 'title')
            ->get();
        $departmentAgencies = DepartmentAgency::select('deptid', 'title', 'sectorid')
            ->orderBy('title', 'asc')
            ->get();
        $agencyLocationLibrary = AgencyLocationLibrary::select('agencyloc_Id', 'title')
            ->get();
        $region = ProfileLibTblRegion::select('reg_code', 'name', 'acronym')
            ->orderBy('regionSeq', 'ASC')
            ->get();

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
            'title' => ['required', 'max:40', 'min:2',],
            'acronym' => ['required', 'min:2',],
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
        $departmentAgencies = DepartmentAgency::where('deptid', $agencyLocation->deptid)
            ->orderBy('title', 'asc')
            ->get();
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
            'title' => ['required', 'max:40', 'min:2',],
            'acronym' => ['required', 'min:2',],
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
