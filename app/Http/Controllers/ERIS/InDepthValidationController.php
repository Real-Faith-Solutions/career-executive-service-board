<?php

namespace App\Http\Controllers\ERIS;

use App\Http\Controllers\Controller;
use App\Models\Eris\ErisTblMain;
use App\Models\Eris\InDepthValidation;
use Illuminate\Http\Request;

class InDepthValidationController extends Controller
{
    public function index($acno )
    {
        $erisTblMain = ErisTblMain::find($acno);
        $inDepthValidation = $erisTblMain->inDepthValidation()->paginate(20);
        
        return view('admin.eris.partials.in_depth_validation.table', compact('acno', 'inDepthValidation'));
    }

    // public function create()
    // {
    //     return view('', compact(''));
    // }
}
