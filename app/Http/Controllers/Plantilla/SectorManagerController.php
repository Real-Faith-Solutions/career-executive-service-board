<?php

namespace App\Http\Controllers\Plantilla;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SectorManagerController extends Controller
{
    public function index(){
        return view ('admin.plantilla.sector_manager.index');
    }
}
