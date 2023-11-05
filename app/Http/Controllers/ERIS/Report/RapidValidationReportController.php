<?php

namespace App\Http\Controllers\ERIS\Report;

use App\Http\Controllers\Controller;
use App\Models\Eris\RapidValidation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class RapidValidationReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        
        if($startDate && $endDate)
        {
            $rapidValidation = $this->rapidValidationDateFilter($startDate, $endDate);
        }
        else
        {
            $rapidValidation = RapidValidation::paginate(25);
        }

        return view('admin.eris.reports.validation_reports.rapid_validation.report', [
            'rapidValidation' => $rapidValidation,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }
    
    public function generatePdfReport(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        if($startDate && $endDate)
        {
            $rapidValidation = RapidValidation::whereBetween(DB::raw('CAST(dteassign AS DATE)'), [$startDate, $endDate])
            ->where('dteassign', '>=', $startDate)
            ->where('dteassign', '<=', $endDate)
            ->get();
        }
        else
        {
            $rapidValidation = RapidValidation::all();
        }

        $pdf = Pdf::loadView('admin.eris.reports.validation_reports.rapid_validation.report_pdf', [
            'rapidValidation' => $rapidValidation,
        ])
        ->setPaper('a4', 'landscape');

        return $pdf->stream('rapid-validation-report.pdf');
    }

    public function rapidValidationDateFilter($startDate, $endDate)
    {
        $rapidValidation = RapidValidation::whereBetween(DB::raw('CAST(dteassign AS DATE)'), [$startDate, $endDate])
        ->where('dteassign', '>=', $startDate)
        ->where('dteassign', '<=', $endDate)
        ->paginate(25);

        return $rapidValidation;
    }
}
