<?php

namespace App\Http\Controllers\Plantilla\Library;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\AgencyLocation;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\Office;
use App\Models\Plantilla\PlanAppointee;
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

        $filterDropdown = PlanAppointee::query();

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
            $filterDropdown->whereHas('planPosition', function ($queryBuilder) use ($query, $officeDropdown) {
                $queryBuilder->where(function ($subQuery) use ($query, $officeDropdown) {
                    if ($query) {
                        $subQuery->where('pos_default', 'LIKE', "%$query%")
                            ->orWhere('corp_sg', 'LIKE', "%$query%");
                    }

                    if ($officeDropdown) {
                        $subQuery->orWhereHas('planPosition', function ($officeQuery) use ($officeDropdown, $query) {
                            $officeQuery->where('officeid', $officeDropdown);
                        });
                    }
                });
            });
        }

        $datas =  $filterDropdown
            ->whereHas('planPosition', function ($query) {
                $query->orderBy('corp_sg', 'desc');
            })
            ->paginate(25);

        $sector = SectorManager::orderBy('title', 'ASC')->get();
        $department = DepartmentAgency::orderBy('title', 'ASC')->get();
        $agencyLocation = AgencyLocation::orderBy('title', 'ASC')->get();
        $office = Office::orderBy('title', 'ASC')->get();

        return view('admin.plantilla.library.occupant_browser.index', compact(
            'datas',
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

    public function edit($appointee_id)
    {
        $datas = PlanAppointee::find($appointee_id);
        $address = $datas->planPosition->office->officeAddress->floor_bldg ?? '' . " " .
            $datas->planPosition->office->officeAddress->house_no_st ?? '' . " " .
            $datas->planPosition->office->officeAddress->brgy_dist ?? '' . " " .
            $datas->planPosition->office->officeAddress->city_code ?? '';

        $appointee = $datas->personalData->lastname ?? '' . " " .
            $datas->personalData->firstname ?? '' . " " .
            $datas->personalData->name_extension ?? '' . " " .
            $datas->personalData->middlename ?? '';
        return view('admin.plantilla.library.occupant_browser.edit', compact(
            'datas',
            'address',
            'appointee',
        ));;
    }
}
