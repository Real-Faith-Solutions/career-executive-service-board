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
    public function index(Request $request)
    {
        $query = $request->input('search');
        $sectorDropdown = $request->input('sectorDropdown');
        $departmentDropdown = $request->input('departmentDropdown');
        $agencyLocationDropdown = $request->input('agencyLocationDropdown');
        $officeDropdown = $request->input('officeDropdown');

        $filterDropdown = PlanPosition::query();

        if ($officeDropdown) {
            $filterDropdown->where('officeid', $officeDropdown);
        }
        if ($query) {
            $filterDropdown->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('pos_default', 'LIKE', "%$query%")
                    ->orWhere('plantilla_id', 'LIKE', "%$query%");
            });
        }

        $datas = $filterDropdown->paginate(25);

        $sector = SectorManager::orderBy('title', 'ASC')->get();
        $department = DepartmentAgency::orderBy('title', 'ASC')->get();
        $agencyLocation = AgencyLocation::orderBy('title', 'ASC')->get();
        $office = Office::orderBy('title', 'ASC')->get();
        return view('admin.plantilla.library.position_manager.index', compact(
            'datas',
            'query',
            'sectorDropdown',
            'departmentDropdown',
            'agencyLocationDropdown',
            'officeDropdown',
            'sector',
            'department',
            'agencyLocation',
            'office',
        ));
    }

    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $request->validate([
            'officeid' => ['required'],
            'pos_code' => ['required'],
            'corp_sg' => ['required', 'integer'],
            'item_no' => ['required'],
            'cbasis_code' => ['required'],
            'item_no' => ['required', 'unique:plantilla_tblPlanPositions'],
        ], [
            'item_no.unique' => 'Item No. is already taken',
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
            'is_vacant' => true, // default true
            'is_occupied' => false, // default false
            'remarks' => $request->input('remarks'),
            'cbasis_code' => $request->input('cbasis_code'),
            'cbasis_remarks' => $request->input('cbasis_remarks'),
            'item_no' => $request->input('item_no'),
            'pres_apptee' => $request->input('pres_apptee'),
            // 'is_active' => $request->input('is_active'),
            'is_generic' => $request->input('is_generic'),
            'is_head' => $request->input('is_head'),
            'created_user' => $encoder,
            'lastupd_user' => $encoder,
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
    public function edit($plantilla_id)
    {
        $datas = PlanPosition::findOrFail($plantilla_id);
        $planPositionLibrary = PlanPositionLevelLibrary::orderBy('title', 'ASC')->get();
        $classBasis = ClassBasis::orderBy('basis', 'ASC')->get();
        $positionMasterLibrary = PositionMasterLibrary::orderBy('dbm_title', 'ASC')->get();
        $office = Office::orderBy('title', 'ASC')->get();
        $sector = SectorManager::orderBy('title', 'ASC')->get();
        $department = DepartmentAgency::orderBy('title', 'ASC')->get();
        $agencyLocation = AgencyLocation::orderBy('title', 'ASC')->get();
        return view('admin.plantilla.library.position_manager.edit', compact(
            'datas',
            'planPositionLibrary',
            'classBasis',
            'positionMasterLibrary',
            'office',
            'sector',
            'department',
            'agencyLocation',
        ));
    }

    public function update(Request $request, $plantilla_id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $request->validate([
            // 'pos_code' => ['required'],
            'corp_sg' => ['required', 'integer'],
            'item_no' => ['required'],
        ]);

        $planPosition = PlanPosition::withTrashed()->findOrFail($plantilla_id);
        $planPosition->update([
            // 'pos_code' => $request->input('pos_code'),
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
            'lastupd_user' => $encoder,
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
