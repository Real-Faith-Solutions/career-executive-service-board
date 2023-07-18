<?php

namespace App\Http\Controllers\Plantilla;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgencyLocationManagerController extends Controller
{
    public function index(){
        return view('admin.plantilla.agency_location_manager.index');
    }
}
