<?php

namespace App\Http\Controllers\Plantilla;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\AgencyLocation;
use App\Models\Plantilla\AgencyLocationLibrary;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\Office;
use App\Models\Plantilla\SectorManager;
use App\Models\ProfileLibCities;
use App\Models\ProfileLibTblRegion;
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
            'lastupd_enc' => $encoder,
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
        $cities = ProfileLibCities::orderBy('name', 'ASC')->get();
        $region = ProfileLibTblRegion::orderBy('regionSeq', 'ASC')->get();

        $office = Office::query()
            ->where('officelocid', $officelocid)
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('title', 'LIKE', "%$query")
                    ->orWhere('acronym', 'LIKE', "%$query")
                    ->orWhere('website', 'LIKE', "%$query");
            })
            ->orderBy('title', 'ASC')
            ->paginate(10);

        return view('admin.plantilla.agency_location_manager.edit', compact(
            'sector',
            'department',
            'departmentLocation',
            'agencyLocationLibrary',
            'office',
            'query',
            'cities',
            'region',

        ));;
    }

    public function update(Request $request, $officelocid)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();
        $request->validate([
            'title' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'acronym' => ['required', 'max:10', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'loctype_id' => ['required'],
            'region' => ['required'],
        ]);

        $departmentLocation = AgencyLocation::withTrashed()->findOrFail($officelocid);
        $departmentLocation->update([
            'title' => $request->input('title'),
            'acronym' => $request->input('acronym'),
            'loctype_id' => $request->input('loctype_id'),
            'telno' => $request->input('telno'),
            'emailaddr' => $request->input('emailaddr'),
            'region' => $request->input('region'),
            'lastupd_enc' => $encoder,
        ]);


        return redirect()->back()->with('message', 'The item has been successfully updated!');
    }

    public function destroy($officelocid)
    {
        $datas = AgencyLocation::findOrFail($officelocid);
        $datas->delete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }
}
