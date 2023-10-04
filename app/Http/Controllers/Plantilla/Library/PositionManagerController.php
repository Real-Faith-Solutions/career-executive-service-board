<?php

namespace App\Http\Controllers\Plantilla\Library;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\AgencyLocation;
use App\Models\Plantilla\ClassBasis;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\Office;
use App\Models\Plantilla\PlanPosition;
use App\Models\Plantilla\PlanPositionLevelLibrary;
use App\Models\Plantilla\PositionMasterLibrary;
use App\Models\Plantilla\SectorManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PositionManagerController extends Controller
{
    public function index()
    {
        $datas = PlanPosition::all();
        return view('admin.plantilla.library.position_manager.index', compact('datas'));
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
            'cbasis_code' => ['required'],
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
            // 'is_active' => $request->input('is_active'),
            'is_generic' => $request->input('is_generic'),
            'is_head' => $request->input('is_head'),
            'created_user' => $encoder,
        ]);



        return redirect()->back()->with('message', 'The item has been successfully added!');
    }

    public function create()
    {
        $planPositionLibrary = PlanPositionLevelLibrary::orderBy('title', 'ASC')->get();
        $classBasis = ClassBasis::orderBy('basis', 'ASC')->get();
        $positionMasterLibrary = PositionMasterLibrary::orderBy('dbm_title', 'ASC')->get();
        $office = Office::orderBy('title', 'ASC')->get();
        $sector = SectorManager::orderBy('title', 'ASC')->get();
        $department = DepartmentAgency::orderBy('title', 'ASC')->get();
        $agencyLocation = AgencyLocation::orderBy('title', 'ASC')->get();
        return view('admin.plantilla.library.position_manager.create', compact(
            'planPositionLibrary',
            'classBasis',
            'positionMasterLibrary',
            'office',
            'sector',
            'department',
            'agencyLocation',
        ));
    }
    public function edit($appt_stat_code)
    {
        $datas = PlanPosition::withTrashed()->findOrFail($appt_stat_code);
        return view('admin.plantilla.library.position_manager.edit', compact(
            'datas',
        ));
    }

    public function update(Request $request, $appt_stat_code)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $request->validate([
            'title' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:plantillalib_tblapptstatus'],

        ]);

        $datas = PlanPosition::withTrashed()->findOrFail($appt_stat_code);
        $datas->update([
            'title' => $request->input('title'),
            'encoder' => $encoder,
        ]);

        return redirect()->back()->with('message', 'The item has been successfully updated!');
    }

    public function trash()
    {
        $datas = PlanPosition::onlyTrashed()
            ->get();
        return view('admin.plantilla.library.position_manager.trash', compact('datas'));
    }

    public function restore($plantilla_id)
    {
        $datas = PlanPosition::onlyTrashed()->findOrFail($plantilla_id);
        $datas->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    public function destroy($plantilla_id)
    {
        $data = PlanPosition::findOrFail($plantilla_id);

        if ($data->positionMasterLibrary()->exists()) {
            return redirect()->back()->with('error', 'Cannot delete this item because it has related records.');
        }
        if ($data->classBasis()->exists()) {
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

    public function forceDelete($plantilla_id)
    {
        try {
            // Find the soft-deleted record by its ID
            $data = PlanPosition::onlyTrashed()->findOrFail($plantilla_id);

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
