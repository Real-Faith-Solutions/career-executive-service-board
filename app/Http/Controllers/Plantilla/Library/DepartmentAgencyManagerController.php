<?php

namespace App\Http\Controllers\Plantilla\Library;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\DepartmentAgencyType;
use App\Models\Plantilla\SectorManager;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartmentAgencyManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = DepartmentAgency::all();
        return view('admin.plantilla.library.department_agency_manager.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sectorManagers = SectorManager::all();
        $agencyTypes = DepartmentAgencyType::all();
        return view('admin.plantilla.library.department_agency_manager.create', compact('sectorManagers', 'agencyTypes'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'agency_typeid' => ['required'],
            'title' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:plantilla_tblDeptAgency'],
            'acronym' => ['required', 'max:10', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'remarks' => ['required'],
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($deptid)
    {
        $datas = DepartmentAgency::findOrFail($deptid);
        $datas->delete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }
}
