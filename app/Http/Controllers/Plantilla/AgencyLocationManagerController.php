<?php

namespace App\Http\Controllers\Plantilla;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\AgencyLocation;
use App\Models\Plantilla\AgencyLocationLibrary;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\SectorManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgencyLocationManagerController extends Controller
{
    public function index()
    {
        return view('admin.plantilla.agency_location_manager.index');
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
            'agencyloc_Id' => ['required'],
            'region' => ['required'],
        ]);
        AgencyLocation::create([
            'deptid' => $request->input('deptid'),
            'title' => $request->input('title'),
            'acronym' => $request->input('acronym'),
            'agencyloc_Id' => $request->input('agencyloc_Id'),
            'telno' => $request->input('telno'),
            'email' => $request->input('email'),
            'region' => $request->input('region'),
            'encoder' => $encoder,
        ]);
        return redirect()->back()->with('message', 'The item has been successfully added!');
    }

    public function show(Request $request, $sectorid, $deptid, $officelocid)
    {
        $query = $request->input('search');
        $sector = SectorManager::find($sectorid);
        $department = DepartmentAgency::find($deptid);
        $departmentLocation = AgencyLocation::find($officelocid);

        $agencyLocationLibrary = AgencyLocationLibrary::all();



        // $agencyLocation = AgencyLocation::query()
        //     ->where('deptid', $deptid)
        //     ->where(function ($queryBuilder) use ($query) {
        //         $queryBuilder->where('title', 'LIKE', "%$query");
        //     })
        //     ->orderBy('title', 'ASC')
        //     ->paginate(10);

        return view('admin.plantilla.agency_location_manager.edit', compact(
            'sector',
            'department',
            'departmentLocation',
            'agencyLocationLibrary',

        ));;
    }

    public function update(Request $request, $officelocid)
    {


        $request->validate([
            'title' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'acronym' => ['required', 'max:10', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            // 'agencyloc_Id' => ['required'],
            'region' => ['required'],
        ]);

        $departmentLocation = AgencyLocation::withTrashed()->findOrFail($officelocid);
        // $departmentLocation->update($request->only(
        //     'title',
        //     'acronym',
        //     'agencyloc_Id',
        //     'telno',
        //     'email',
        //     'region',
        //     'encoder',
        // ));
        $departmentLocation->update([
            'title' => $request->input('title'),
            'acronym' => $request->input('acronym'),
            'agencyloc_Id' => $request->input('agencyloc_Id'),
            'telno' => $request->input('telno'),
            'email' => $request->input('email'),
            'region' => $request->input('region'),
        ]);

        // dd($departmentLocation->all());
        return redirect()->back()->with('message', 'The item has been successfully updated!');
    }

    public function destroy($officelocid)
    {
        $datas = AgencyLocation::findOrFail($officelocid);
        $datas->delete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }
}
