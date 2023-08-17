<?php

namespace App\Http\Controllers\Plantilla;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\DepartmentAgencyType;
use App\Models\Plantilla\SectorManager;
use Illuminate\Http\Request;

class DepartmentAgencyManagerController extends Controller
{
    public function index(Request $request, ){
        $query = $request->input('search');
        $datas = DepartmentAgency::orderBy('title', 'ASC')
        ->where('title', 'LIKE', "%$query%")
        ->orWhere('acronym', 'LIKE', "%$query%")
        ->orWhere('website', 'LIKE', "%$query%")
        ->orWhere('plantillalib_tblAgencyType_id', 'LIKE', "%$query%")
        ->paginate(15);
        return view ('admin.plantilla.department_agency_manager.index', compact('datas', 'query'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plantillalib_tblAgencyType_id'=> ['required'],
            'title'=> ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'acronym'=> ['required', 'max:10', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'remarks'=> ['required'],
            'submitted_by'=> ['required'],
        ]);
        DepartmentAgency::create($request->all());
        return redirect()->back()->with('message', 'The item has been successfully added!');
    }

    public function showAgency($sectorid, $deptid)
    {
        $sector = SectorManager::find($sectorid);
        $sectorDatas = SectorManager::orderBy('title', 'ASC')->get();
        $departmentTypeDatas = DepartmentAgencyType::orderBy('title', 'ASC')->get();
        $department = DepartmentAgency::find($deptid);

        if (!$sector) {
            abort(404);
        }

        return view('admin.plantilla.department_agency_manager.edit', compact(
            'sector', 'department', 'sectorDatas',
            'departmentTypeDatas'
        ));
    }

    public function updateAgency(Request $request, $sectorid, $deptid){
        $request->validate([
            'title' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'plantillalib_tblAgencyType_id' => ['required'],
            'website' => ['required', 'max:40', 'min:2', 'url'],
            'acronym' => ['required', 'max:10', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'remarks' => ['required'],
        ]);
    
        $department = DepartmentAgency::withTrashed()->findOrFail($deptid);
        $department->update($request->only([
            'title', 
            'plantillalib_tblAgencyType_id', 
            'website', 
            'acronym', 
            'remarks'
        ]));
    
        return redirect()->back()->with('message', 'The item has been successfully updated!');
    }
    

    public function destroy($deptid)
    {
        $datas = DepartmentAgency::findOrFail($deptid);
        $datas->delete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }

}
