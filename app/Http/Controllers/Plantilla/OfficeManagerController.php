<?php

namespace App\Http\Controllers\Plantilla;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\AgencyLocation;
use App\Models\Plantilla\ClassBasis;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\Office;
use App\Models\Plantilla\OfficeAddress;
use App\Models\Plantilla\PlanPosition;
use App\Models\Plantilla\PlanPositionLevelLibrary;
use App\Models\Plantilla\PositionMasterLibrary;
use App\Models\Plantilla\SectorManager;
use App\Models\ProfileLibCities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficeManagerController extends Controller
{
    public function index()
    {
        return view('admin.plantilla.office_manager.index');
    }


    public function show(Request $request, $sectorid, $deptid, $officelocid, $officeid)
    {
        $sector = SectorManager::find($sectorid);
        $department = DepartmentAgency::find($deptid);
        $departmentLocation = AgencyLocation::find($officelocid);
        $office = Office::find($officeid);

        $cities = ProfileLibCities::orderBy('name', 'ASC')->get();


        $planPositions = PlanPosition::query()
            ->where('officeid', $office->officeid)
            ->where('is_active', true)
            ->get();

        $planPositionLibrary = PlanPositionLevelLibrary::orderBy('title', 'ASC')->get();
        $positionMasterLibrary = PositionMasterLibrary::orderBy('dbm_title', 'ASC')->get();
        $classBasis = ClassBasis::orderBy('basis', 'ASC')->get();

        return view('admin.plantilla.office_manager.edit', compact(
            'sector',
            'department',
            'departmentLocation',
            'office',
            'cities',
            'planPositions',
            'planPositionLibrary',
            'positionMasterLibrary',
            'classBasis',

        ));;
    }


    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $request->validate([

            'officelocid' => ['required'],
            'title' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'acronym' => ['required', 'max:10', 'min:2', 'regex:/^[a-zA-Z ]*$/'],

        ]);
        $primaryKey = Office::create([
            'officelocid' => $request->input('officelocid'),
            'title' => $request->input('title'),
            'acronym' => $request->input('acronym'),
            'website' => $request->input('website'),
            'isActive' => $request->input('isActive'),
            'encoder' => $encoder,
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
            'isActive' => $request->input('isActive'),
            'ofcaddrid' => $request->input('ofcaddrid'),
            'encoder' => $encoder,
        ]);

        return redirect()->back()->with('message', 'The item has been successfully added!');
    }

    public function update(Request $request, $officeid)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $request->validate([
            'officelocid' => ['city_code'],
            'title' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'acronym' => ['required', 'max:10', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
        ]);

        $office = Office::withTrashed()->findOrFail($officeid);
        $office->update([
            'title' => $request->input('title'),
            'acronym' => $request->input('acronym'),
            'website' => $request->input('website'),
            'isActive' => $request->input('isActive'),
            'lastupd_enc' => $encoder,
        ]);

        $officeAddress = OfficeAddress::withTrashed()->findOrFail($officeid);
        $officeAddress->update([
            'floor_bldg' => $request->input('floor_bldg'),
            'house_no_st' => $request->input('house_no_st'),
            'brgy_dist' => $request->input('brgy_dist'),
            'city_code' => $request->input('city_code'),
            'contactno' => $request->input('contactno'),
            'emailadd' => $request->input('emailadd'),
            'isActive' => $request->input('isActive'),
            'ofcaddrid' => $request->input('ofcaddrid'),
            'updated_by' => $encoder,
        ]);



        return redirect()->back()->with('message', 'The item has been successfully updated!');
    }

    public function destroy($officeid)
    {
        $datas = Office::findOrFail($officeid);
        $datas->delete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }
}
