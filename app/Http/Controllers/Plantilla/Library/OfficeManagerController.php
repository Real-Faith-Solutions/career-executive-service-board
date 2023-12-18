<?php

namespace App\Http\Controllers\Plantilla\Library;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\AgencyLocation;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\Office;
use App\Models\Plantilla\OfficeAddress;
use App\Models\Plantilla\SectorManager;
use App\Models\ProfileLibCities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficeManagerController extends Controller
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
        $departmentDropdown = $request->input('departmentDropdown');
        $agencyLocationDropdown = $request->input('agencyLocationDropdown');

        $filterDropdown = Office::query();

        // Apply search filter if a search query is provided
        if ($query) {
            $filterDropdown->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('title', 'LIKE', "%$query%")
                    ->orWhere('acronym', 'LIKE', "%$query%");
            });
        }

        if ($agencyLocationDropdown) {
            $filterDropdown->where('officelocid', $agencyLocationDropdown);
        }


        $datas = $filterDropdown->paginate(25);
        $sector = SectorManager::orderBy('title', 'ASC')->get();
        $department = DepartmentAgency::orderBy('title', 'ASC')->get();
        $agencyLocation = AgencyLocation::orderBy('title', 'ASC')->get();

        return view('admin.plantilla.library.office_manager.index', compact(
            'datas',
            'query',
            'sector',
            'department',
            'agencyLocation',
            'sectorDropdown',
            'departmentDropdown',
            'agencyLocationDropdown',
        ));
    }

    public function create(Request $request)
    {
        $sectorDropdown = $request->input('sectorDropdown');
        $departmentDropdown = $request->input('departmentDropdown');
        $agencyLocationDropdown = $request->input('agencyLocationDropdown');

        $sector = SectorManager::select('sectorid', 'title')
            ->orderBy('title', 'ASC')
            ->get();
        $cities = ProfileLibCities::select('city_code', 'name')
            ->orderBy('name', 'ASC')
            ->get();
        $agencyLocation = AgencyLocation::select('officelocid', 'title', 'deptid')
            ->get();
        $department = DepartmentAgency::select('deptid', 'title', 'sectorid')
            ->get();

        return view('admin.plantilla.library.office_manager.create', compact(
            'cities',
            'agencyLocation',
            'department',
            'sector',
            'sectorDropdown',
            'departmentDropdown',
            'agencyLocationDropdown',
        ));
    }

    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $request->validate([
            'officelocid' => ['required'],
            'city_code' => ['required'],
            'title' => ['required', 'max:50', 'min:2',],
            'acronym' => ['required', 'min:2', 'max:25'],

        ]);
        $primaryKey = Office::create([
            'officelocid' => $request->input('officelocid'),
            'title' => $request->input('title'),
            'acronym' => $request->input('acronym'),
            'website' => $request->input('website'),
            // 'isActive' => $request->input('isActive'),
            'encoder' => $encoder,
            'lastupd_enc' => $encoder,
        ]);

        // office address
        OfficeAddress::create([
            'officeid' => $primaryKey->officeid,
            'floor_bldg' => $request->input('floor_bldg'),
            'house_no_st' => $request->input('house_no_st'),
            'brgy_dist' => $request->input('brgy_dist'),
            'city_code' => $request->input('city_code'),
            'contactno' => $request->input('contactno'),
            'emailadd' => $request->input('emailadd'),
            // 'isActive' => $request->input('isActive'),
            'ofcaddrid' => $request->input('ofcaddrid'),
            'encoder' => $encoder,
            'updated_by' => $encoder,
        ]);

        return redirect()->back()->with('message', 'The item has been successfully added!');
    }

    public function edit($officeid)
    {
        $datas = Office::find($officeid);
        $agencyLocations = AgencyLocation::where('deptid', $datas->agencyLocation->deptid)->get();

        $cities = ProfileLibCities::orderBy('name', 'ASC')->get();
        $departmentAgencies = DepartmentAgency::where('deptid', $datas->deptid)->get();

        return view('admin.plantilla.library.office_manager.edit', compact(
            'cities',
            'agencyLocations',
            'datas',
            'departmentAgencies',
        ));
    }

    public function update(Request $request, $officeid)
    {

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $request->validate([
            // 'officelocid' => ['required'],
            'title' => ['required', 'max:50', 'min:2',],
            'acronym' => ['required', 'min:2', 'max:25'],
        ]);

        $office = Office::withTrashed()->findOrFail($officeid);
        $office->update([
            'officelocid' => $request->input('officelocid'),
            'title' => $request->input('title'),
            'acronym' => $request->input('acronym'),
            'website' => $request->input('website'),
            'is_active' => $request->input('is_active'),
            'lastupd_enc' => $encoder,
        ]);

        $officeAddress = OfficeAddress::withTrashed()->find($officeid);
        $officeAddress->update([
            'floor_bldg' => $request->input('floor_bldg'),
            'house_no_st' => $request->input('house_no_st'),
            'brgy_dist' => $request->input('brgy_dist'),
            'city_code' => $request->input('city_code'),
            'contactno' => $request->input('contactno'),
            'emailadd' => $request->input('emailadd'),
            'isActive' => $request->input('is_active'),
            'ofcaddrid' => $request->input('ofcaddrid'),
            'updated_by' => $encoder,
        ]);
        return redirect()->back()->with('message', 'The item has been successfully updated!');
    }

    public function destroy($officeid)
    {
        $data = Office::findOrFail($officeid);

        if ($data->officeAddress()->exists()) {
            return redirect()->back()->with('error', 'Cannot delete this item because it has related records.');
        }
        if ($data->agencyLocation()->exists()) {
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
        $datas = Office::onlyTrashed()
            ->get();
        return view('admin.plantilla.library.office_manager.trash', compact('datas'));
    }

    public function restore($officeid)
    {
        $datas = Office::onlyTrashed()->findOrFail($officeid);
        $datas->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    public function forceDelete($officeid)
    {
        try {
            // Find the soft-deleted record by its ID
            $data = Office::onlyTrashed()->findOrFail($officeid);

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