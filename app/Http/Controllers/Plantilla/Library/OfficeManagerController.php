<?php

namespace App\Http\Controllers\Plantilla\Library;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\AgencyLocation;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\Office;
use App\Models\Plantilla\OfficeAddress;
use App\Models\ProfileLibCities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficeManagerController extends Controller
{
    public function index()
    {
        $datas = Office::all();

        return view('admin.plantilla.library.office_manager.index', compact(
            'datas'
        ));
    }

    public function create()
    {
        $cities = ProfileLibCities::orderBy('name', 'ASC')->get();
        $agencyLocations = AgencyLocation::all();
        $departmentAgencies = DepartmentAgency::all();

        return view('admin.plantilla.library.office_manager.create', compact(
            'cities',
            'agencyLocations',
            'departmentAgencies',
        ));
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
            'title' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'acronym' => ['required', 'max:10', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
        ]);

        // dd($request->all());

        $office = Office::withTrashed()->findOrFail($officeid);
        $office->update([
            'officelocid' => $request->input('officelocid'),
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
