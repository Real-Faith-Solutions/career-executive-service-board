<?php

namespace App\Http\Controllers\ERIS;

use App\Http\Controllers\Controller;
use App\Models\Eris\ErisTblMain;
use Illuminate\Http\Request;

class ErisProfileController extends Controller
{
    public function index()
    {
       $erisTblMain = ErisTblMain::paginate(25);

       return view('admin.eris.view_profile.table', compact('erisTblMain'));
    }
}
