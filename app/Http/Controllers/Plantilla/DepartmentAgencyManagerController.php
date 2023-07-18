<?php

namespace App\Http\Controllers\Plantilla;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartmentAgencyManagerController extends Controller
{
    public function index(){
        return view ('admin.plantilla.department_agency_manager.index');
    }
}
