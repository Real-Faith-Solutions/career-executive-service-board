<?php

namespace App\Http\Controllers\Plantilla;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\AgencyLocation;
use App\Models\Plantilla\ClassBasis;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\Office;
use App\Models\Plantilla\PlanPosition;
use App\Models\Plantilla\PlanPositionLevelLibrary;
use App\Models\Plantilla\PositionMasterLibrary;
use App\Models\Plantilla\SectorManager;
use App\Models\ProfileLibCities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlantillaPositionManagerController extends Controller
{
    public function index()
    {
        return view('admin.plantilla.plantilla_office_manager.index');
    }

    public function show(Request $request, $sectorid, $deptid, $officelocid, $officeid, $plantilla_id)
    {
        $sector = SectorManager::find($sectorid);
        $department = DepartmentAgency::find($deptid);
        $departmentLocation = AgencyLocation::find($officelocid);
        $office = Office::find($officeid);
        $planPosition = PlanPosition::find($plantilla_id);

        $cities = ProfileLibCities::orderBy('name', 'ASC')->get();


        // $planPositions = PlanPosition::query()
        //     ->where('officeid', $office->officeid)
        //     ->where('is_active', true)
        //     ->get();

        $planPositionLibrary = PlanPositionLevelLibrary::orderBy('title', 'ASC')->get();
        $positionMasterLibrary = PositionMasterLibrary::orderBy('dbm_title', 'ASC')->get();
        $classBasis = ClassBasis::orderBy('basis', 'ASC')->get();

        return view('admin.plantilla.appointee_occupant_manager.edit', compact(
            'sector',
            'department',
            'departmentLocation',
            'office',
            'cities',
            // 'planPositions',
            'planPositionLibrary',
            'positionMasterLibrary',
            'classBasis',
            'planPosition',

        ));;
    }


    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        // dd($request->all());

        $request->validate([
            'officeid' => ['required'],
            'pos_code' => ['required'],
            'corp_sg' => ['required', 'integer'],
            'item_no' => ['required'],
        ]);
        PlanPosition::create([
            'officeid' => $request->input('officeid'),
            'pos_code' => $request->input('pos_code'),
            'pos_suffix' => $request->input('pos_suffix'),
            'pos_func_name' => $request->input('pos_func_name'),
            'pos_default' => $request->input('pos_default'),
            'corp_sg' => $request->input('corp_sg'),
            // 'pos_sequence' => $request->input('pos_sequence'),
            'is_ces_pos' => $request->input('is_ces_pos'),
            'is_vacant' => $request->input('is_vacant'),
            'is_occupied' => $request->input('is_occupied'),
            'remarks' => $request->input('remarks'),
            'cbasis_code' => $request->input('cbasis_code'),
            'cbasis_remarks' => $request->input('cbasis_remarks'),
            'item_no' => $request->input('item_no'),
            'pres_apptee' => $request->input('pres_apptee'),
            'is_active' => $request->input('is_active'),
            'is_generic' => $request->input('is_generic'),
            'is_head' => $request->input('is_head'),
            'encoder' => $encoder,
        ]);



        return redirect()->back()->with('message', 'The item has been successfully added!');
    }

    public function destroy($plantilla_id)
    {
        $datas = PlanPosition::findOrFail($plantilla_id);
        $datas->delete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }
}
