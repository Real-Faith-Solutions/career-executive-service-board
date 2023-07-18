<?php

namespace App\Http\Controllers\Plantilla;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OfficeManagerController extends Controller
{
    public function index(){
        return view('admin.plantilla.office_manager.index');
    }
}
