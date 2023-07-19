<?php

namespace App\Http\Controllers\Plantilla;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\DepartmentAgency;
use Illuminate\Http\Request;

class DepartmentAgencyManagerController extends Controller
{
    public function index(){
        $datas = DepartmentAgency::orderBy('title', 'ASC')
        ->paginate(10);
        return view ('admin.plantilla.department_agency_manager.index', compact('datas'));
    }
}
