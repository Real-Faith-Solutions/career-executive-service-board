<?php

namespace App\Http\Controllers\Plantilla\Library;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\AgencyLocation;
use App\Models\Plantilla\AgencyLocationLibrary;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\DepartmentAgencyType;
use App\Models\Plantilla\MotherDept;
use App\Models\Plantilla\SectorManager;
use App\Models\ProfileLibTblRegion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartmentAgencyManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sectorToggle = $request->input('sectorToggle');
        $query = $request->input('search');
        $filterDropdown = DepartmentAgency::query();

        if ($sectorToggle) {
            $filterDropdown->where('sectorid', $sectorToggle);
        }

        if ($query) {
            $filterDropdown->orWhere('title', 'LIKE', "%$query%")
                ->orWhere('acronym', 'LIKE', "%$query%");
        }

        $datas = $filterDropdown->paginate(25);
        $sector = SectorManager::all();

        return view('admin.plantilla.library.department_agency_manager.index', compact(
            'datas',
            'sector',
            'sectorToggle',
            'query',
        ));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sectorManagers = SectorManager::all();
        $agencyTypes = DepartmentAgencyType::all();
        $motherDepartment = MotherDept::all();
        return view('admin.plantilla.library.department_agency_manager.create', compact(
            'sectorManagers',
            'agencyTypes',
            'motherDepartment',
        ));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'agency_typeid' => ['required'],
            'title' => ['required', 'min:2', 'unique:plantilla_tblDeptAgency'],
            'acronym' => ['required', 'max:10', 'min:2',],
            'remarks' => ['required'],
            'mother_deptid' => ['required'],
            'submitted_by' => ['required'],
        ]);
        // dd($request->all());
        DepartmentAgency::create($request->all());
        return redirect()->back()->with('message', 'The item has been successfully added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $deptid)
    {
        $department = DepartmentAgency::find($deptid);
        $sectorDatas = SectorManager::orderBy('title', 'ASC')->get();
        $motherDepartment = MotherDept::orderBy('title', 'ASC')->get();

        $departmentTypeDatas = DepartmentAgencyType::query()
            ->where('sectorid', $department->sectorid)
            ->orderBy('title', 'ASC')->get();

        return view('admin.plantilla.library.department_agency_manager.edit', compact(
            'departmentTypeDatas',
            'department',
            'sectorDatas',
            'motherDepartment',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $deptid)
    {
        $request->validate([
            'title' => ['required', 'max:40', 'min:2',],
            'agency_typeid' => ['required'],
            'website' => ['max:40', 'min:2', 'url'],
            'acronym' => ['required', 'max:10', 'min:2',],
            'remarks' => ['required'],
            'mother_deptid' => ['required'],
        ]);

        $department = DepartmentAgency::withTrashed()->findOrFail($deptid);
        $department->update($request->only([
            'title',
            'agency_typeid',
            'website',
            'acronym',
            'remarks',
            'mother_deptid',
        ]));

        return redirect()->back()->with('message', 'The item has been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($deptid)
    {
        $data = DepartmentAgency::findOrFail($deptid);

        if ($data->departmentAgencyType()->exists()) {
            return redirect()->back()->with('error', 'Cannot delete this item because it has related records.');
        }
        if ($data->sectorManager()->exists()) {
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
        $datas = DepartmentAgency::onlyTrashed()
            ->get();
        return view('admin.plantilla.library.department_agency_manager.trash', compact('datas'));
    }

    public function restore($deptid)
    {
        $datas = DepartmentAgency::onlyTrashed()->findOrFail($deptid);
        $datas->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    public function forceDelete($deptid)
    {
        try {
            // Find the soft-deleted record by its ID
            $data = DepartmentAgency::onlyTrashed()->findOrFail($deptid);

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
