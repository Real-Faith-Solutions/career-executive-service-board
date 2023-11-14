<?php

namespace App\Http\Controllers\Plantilla\Library;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\AgencyLocation;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\Office;
use App\Models\Plantilla\PlanAppointee;
use App\Models\Plantilla\PlanPosition;
use App\Models\Plantilla\SectorManager;
use Illuminate\Http\Request;

class OccupantBrowserController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $sectorDropdown = $request->input('sectorDropdown');
        $departmentDropdown = $request->input('departmentDropdown');
        $agencyLocationDropdown = $request->input('agencyLocationDropdown');
        $officeDropdown = $request->input('officeDropdown');
        $planAppointee = PlanAppointee::all();

        $filterDropdown = PlanPosition::query();

        // if ($query) {
        //     $filterDropdown->whereHas('planPosition.positionMasterLibrary', function ($queryBuilder) use ($query) {
        //         $queryBuilder->where('dbm_title', 'LIKE', "%$query");
        //     });
        // }

        // if ($officeDropdown) {
        //     $filterDropdown->whereHas('planPosition.office', function ($query) use ($officeDropdown) {
        //         $query->where('officeid', $officeDropdown)
        //             ->orWhere('dbm_title', 'LIKE', "%$query");
        //     });
        // }

        if ($query || $officeDropdown) {

            if ($query) {
                $filterDropdown->where('pos_default', 'LIKE', "%$query%")
                    ->orWhere('corp_sg', 'LIKE', "%$query%")
                    ->orWhere('item_no', 'LIKE', "%$query%");
            }

            if ($officeDropdown) {
                $filterDropdown->orWhereHas('office', function ($officeQuery) use ($officeDropdown) {
                    $officeQuery->where('officeid', $officeDropdown);
                });
            }
        }


        $planPositions =  $filterDropdown
            ->orderBy('corp_sg', 'desc')
            ->paginate(25);

        $sector = SectorManager::orderBy('title', 'ASC')->get();
        $department = DepartmentAgency::orderBy('title', 'ASC')->get();
        $agencyLocation = AgencyLocation::orderBy('title', 'ASC')->get();
        $office = Office::orderBy('title', 'ASC')->get();

        return view('admin.plantilla.library.occupant_browser.index', compact(
            'planAppointee',
            'planPositions',
            'query',
            'sector',
            'department',
            'agencyLocation',
            'sectorDropdown',
            'departmentDropdown',
            'agencyLocationDropdown',
            'office',
            'officeDropdown',
        ));;
    }

    public function edit($platilla_id)
    {
        $datas = PlanPosition::find($platilla_id);

        $selectedAppointee = PlanAppointee::where('plantilla_id', $datas->plantilla_id)
            ->where('is_appointee', true)
            ->first();

        $address = $datas->office->officeAddress->floor_bldg ?? '' . " " .
            $datas->office->officeAddress->house_no_st ?? '' . " " .
            $datas->office->officeAddress->brgy_dist ?? '' . " " .
            $datas->office->officeAddress->cities->name ?? '';


        if ($selectedAppointee) {
            $appointee = $selectedAppointee->personalData->lastname . " " .
                $selectedAppointee->personalData->firstname . " " .
                $selectedAppointee->personalData->name_extension . " " .
                $selectedAppointee->personalData->middlename . ", " .
                $selectedAppointee->personalData->cesStatus->description ?? '';

            $selectedApptStatus = $selectedAppointee->apptStatus->title ?? '';
            $selectedBasis = $selectedAppointee->basis ?? '';
        } else {
            $appointee = "No Appointed on this position";
            $selectedApptStatus = "";
            $selectedBasis = "";
        }

        return view('admin.plantilla.library.occupant_browser.edit', compact(
            'datas',
            'address',
            'appointee',
            'selectedAppointee',
            'selectedApptStatus',
            'selectedBasis',
        ));
    }
}