<?php

namespace App\Http\Controllers\ERIS\Report;

use App\Http\Controllers\Controller;
use App\Models\Eris\InDepthValidation;
use App\Models\Eris\RapidValidation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


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

    public function generatePdfReport(Request $request)
    {
        $validationType = $request->input('validation-type');

        if($validationType == null)
        {
            $rapidValidation = RapidValidation::all();
            $inDepthValidation = null;
        }

        if($validationType == 'In Depth Validation')
        {
            $inDepthValidation = InDepthValidation::all();
            $rapidValidation = null;
        }


        $pdf = Pdf::loadView('admin.eris.reports.validation_reports.report_pdf', [
            'rapidValidation' => $rapidValidation,
            'inDepthValidation' => $inDepthValidation,
            'validationType' => $validationType,
        ])
        ->setPaper('a4', 'landscape');

        return $pdf->stream('validation-report.pdf');
    }
}
