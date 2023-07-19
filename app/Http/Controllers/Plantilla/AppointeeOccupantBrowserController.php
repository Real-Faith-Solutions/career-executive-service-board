<?php

namespace App\Http\Controllers\Plantilla;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointeeOccupantBrowserController extends Controller
{
    public function index(){
        return view('admin.plantilla.appointee_occupant_browser.index');
    }
}
