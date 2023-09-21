<?php

namespace App\Http\Controllers\ERIS;

use App\Http\Controllers\Controller;
use App\Models\Eris\ErisTblMain;
use Illuminate\Http\Request;

class RapidValidationController extends Controller
{
    public function index($acno)
    {
        $erisTblMain = ErisTblMain::find($acno);
        $rapidValidation = $erisTblMain->rapidValidation()->paginate(20);

        return view('admin.eris.partials.rapid_validation.table', compact('acno', 'rapidValidation'));
    }
}
