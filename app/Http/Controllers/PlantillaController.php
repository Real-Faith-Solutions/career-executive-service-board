<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plantilla;

class PlantillaController extends Controller
{
    public function viewPlantillaManagement(Request $request) {

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Plantilla') == 'true'){

            return view('admin.plantilla_management_system.plantilla_management_main_screen');
        }
        else{

            return view('restricted');
        }
    }

    public function addPlantillaManagementMainScreen(Request $request) {

        PlantillaManagementMainScreen::create([
            'sector' => $sector,
            'list_of_department_agency_per_sector' => $request->list_of_department_agency_per_sector,
            'list_of_office_location_per_department_agency' => $request->list_of_office_location_per_department_agency,
            'list_of_office_per_office_location' => $request->list_of_office_per_office_location,
            'list_of_positions_per_office' => $request->list_of_positions_per_office,
            'appointee_occupant_per_office' => $request->appointee_occupant_per_office,
        ]);
    }
}
