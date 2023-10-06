<?php

namespace App\Http\Controllers\Plantilla\Library;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\PlanAppointee;
use Illuminate\Http\Request;

class OccupantBrowserController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        $datas = PlanAppointee::query()
            ->where('appointee_id', 'LIKE', "%$query%")

            ->paginate(25);

        return view('admin.plantilla.library.occupant_browser.index', compact(
            'datas',
            'query',
        ));;
    }

    public function edit($appointee_id)
    {
        $datas = PlanAppointee::find($appointee_id);
        $address = $datas->planPosition->office->officeAddress->floor_bldg . " " .
            $datas->planPosition->office->officeAddress->house_no_st . " " .
            $datas->planPosition->office->officeAddress->brgy_dist . " " .
            $datas->planPosition->office->officeAddress->city_code;

        $appointee = $datas->personalData->lastname . " " .
            $datas->personalData->firstname . " " .
            $datas->personalData->name_extension . " " .
            $datas->personalData->middlename;
        return view('admin.plantilla.library.occupant_browser.edit', compact(
            'datas',
            'address',
            'appointee',
        ));;
    }
}
