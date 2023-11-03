<?php

namespace App\Http\Controllers\ERIS\Report;

use App\Http\Controllers\Controller;
use App\Models\Eris\InDepthValidation;
use App\Models\Eris\RapidValidation;
use Illuminate\Http\Request;

class ValidationReportController extends Controller
{
    public function index()
    {
        $rapidValidation = RapidValidation::paginate(25);
        $inDepthValidation = InDepthValidation::paginate(25);

        return view('admin.eris.reports.validation_reports.rapid_validation', [

        ]);
    }
}
