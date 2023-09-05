<?php

namespace App\Http\Controllers\Plantilla;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\AgencyLocation;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\Office;
use App\Models\Plantilla\SectorManager;
use Illuminate\Http\Request;

class OfficeManagerController extends Controller
{
    public function index()
    {
        return view('admin.plantilla.office_manager.index');
    }


    public function show(Request $request, $sectorid, $deptid, $officelocid, $officeid)
    {
        $query = $request->input('search');
        $sector = SectorManager::find($sectorid);
        $department = DepartmentAgency::find($deptid);
        $departmentLocation = AgencyLocation::find($officelocid);
        $office = Office::find($officeid);



        // $office = Office::query()
        //     ->where('officelocid', $officelocid)
        //     ->where(function ($queryBuilder) use ($query) {
        //         $queryBuilder->where('title', 'LIKE', "%$query")
        //         ->orWhere('acronym', 'LIKE', "%$query")
        //         ->orWhere('website', 'LIKE', "%$query");
        //     })
        //     ->orderBy('title', 'ASC')
        //     ->paginate(10);

        return view('admin.plantilla.office_manager.edit', compact(
            'sector',
            'department',
            'departmentLocation',
            'query',
            'office',

        ));;
    }









    public function destroy($officeid)
    {
        $datas = Office::findOrFail($officeid);
        $datas->delete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }
}
