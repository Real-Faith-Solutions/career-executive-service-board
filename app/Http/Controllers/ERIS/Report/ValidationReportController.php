<?php

namespace App\Http\Controllers\ERIS\Report;

use App\Http\Controllers\Controller;
use App\Models\Eris\InDepthValidation;
use App\Models\Eris\RapidValidation;
use Illuminate\Http\Request;

class ValidationReportController extends Controller
{
    public function rapidValidation(Request $request)
    {
        $validation = $request->input('validation');

        $rapidValidation = RapidValidation::paginate(25);
        
        return view('admin.eris.reports.validation_reports.rapid_validation', compact('rapidValidation', 'validation'));
    }

    public function displayValidation(Request $request)
    {
        $validation = $request->input('validation');

        switch ($validation) 
        {
            case 'In Depth Validation':
               
                return $this->inDepthValidation($validation);

            default:
                return to_route('validation-report.index');
        }
    }

    public function inDepthValidation($validation)
    {
        $inDepthValidation = InDepthValidation::paginate(25);

        return view('admin.eris.reports.validation_reports.inDepth_validation', compact('inDepthValidation','validation'));
    }
}
