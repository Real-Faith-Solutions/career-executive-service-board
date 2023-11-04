<?php

namespace App\Http\Controllers\Plantilla;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\AgencyLocation;
use App\Models\Plantilla\AgencyLocationLibrary;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\DepartmentAgencyType;
use App\Models\Plantilla\MotherDept;
use App\Models\Plantilla\SectorManager;
use App\Models\ProfileLibTblRegion;
use Illuminate\Http\Request;

class DepartmentAgencyManagerController extends Controller
{
    public function index(Request $request,)
    {
        $query = $request->input('search');
        $datas = DepartmentAgency::orderBy('title', 'ASC')
            ->where('title', 'LIKE', "%$query%")
            ->orWhere('acronym', 'LIKE', "%$query%")
            ->orWhere('website', 'LIKE', "%$query%")
            ->orWhere('agency_typeid', 'LIKE', "%$query%")
            ->paginate(15);
        return view('admin.plantilla.department_agency_manager.index', compact('datas', 'query'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'agency_typeid' => ['required'],
            'title' => ['required', 'max:40', 'min:2',],
            'acronym' => ['required', 'max:10', 'min:2',],
            'remarks' => ['required'],
            'submitted_by' => ['required'],
        ]);
        DepartmentAgency::create($request->all());
        return redirect()->back()->with('message', 'The item has been successfully added!');
    }

    public function showAgency(Request $request, $sectorid, $deptid)
    {
        $query = $request->input('search');
        $sector = SectorManager::find($sectorid);
        $sectorDatas = SectorManager::orderBy('title', 'ASC')->get();
        $departmentTypeDatas = DepartmentAgencyType::query()
            ->where('sectorid', $sectorid)
            ->orderBy('title', 'ASC')->get();
        $department = DepartmentAgency::find($deptid);
        $agencyLocationLibrary = AgencyLocationLibrary::all();
        $region = ProfileLibTblRegion::orderBy('regionSeq', 'ASC')->get();
        $motherDepartment = MotherDept::all();

        // $agencyLocation = AgencyLocation::query()
        //     ->where('deptid', $deptid)
        //     ->where(function ($queryBuilder) use ($query) {
        //         $queryBuilder->where('title', 'LIKE', "%$query")
        //             ->orWhere('acronym', 'LIKE', "%$query")
        //             ->orWhere('region', 'LIKE', "%$query");
        //     })
        //     ->orderBy('title', 'ASC')
        //     ->paginate(25);

        $agencyLocation = AgencyLocation::where('deptid', $deptid)->get();

        return view('admin.plantilla.department_agency_manager.edit', compact(
            'sector',
            'department',
            'sectorDatas',
            'departmentTypeDatas',
            'agencyLocation',
            'agencyLocationLibrary',
            'query',
            'region',
            'motherDepartment',
        ));
    }
    public function show(Request $request, $sectorid, $deptid)
    {
        $query = $request->input('search');
        $sector = SectorManager::find($sectorid);
        $sectorDatas = SectorManager::orderBy('title', 'ASC')->get();
        $departmentTypeDatas = DepartmentAgencyType::query()
            ->where('sectorid', $sectorid)
            ->orderBy('title', 'ASC')->get();
        $department = DepartmentAgency::find($deptid);
        $agencyLocationLibrary = AgencyLocationLibrary::all();
        $region = ProfileLibTblRegion::orderBy('regionSeq', 'ASC')->get();
        $motherDepartment = MotherDept::orderBy('title', 'asc')
            ->get();

        // $agencyLocation = AgencyLocation::query()
        //     ->where('deptid', $deptid)
        //     ->where(function ($queryBuilder) use ($query) {
        //         $queryBuilder->where('title', 'LIKE', "%$query")
        //             ->orWhere('acronym', 'LIKE', "%$query")
        //             ->orWhere('region', 'LIKE', "%$query");
        //     })
        //     ->orderBy('title', 'ASC')
        //     ->paginate(25);

        $agencyLocation = AgencyLocation::where('deptid', $deptid)->get();

        return view('admin.plantilla.department_agency_manager.show', compact(
            'sector',
            'department',
            'sectorDatas',
            'departmentTypeDatas',
            'agencyLocation',
            'agencyLocationLibrary',
            'query',
            'region',
            'motherDepartment',
        ));
    }

    public function destroy($deptid)
    {
        $datas = DepartmentAgency::findOrFail($deptid);
        $datas->delete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }
}