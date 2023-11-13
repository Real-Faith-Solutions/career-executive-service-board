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
        $sortBy = $request->input('sort_by', 'dteassign'); // Default sorting by date assign.
        $sortOrder = $request->input('sort_order', 'desc'); // Default sorting order
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        
        if($startDate && $endDate)
        {
            $rapidValidation = $this->rapidValidationDateFilter($startDate, $endDate, $sortBy, $sortOrder);
        }
        else
        {
            $rapidValidation = RapidValidation::with(['erisTblMainRapidValidation'])
            ->orderBy($sortBy, $sortOrder)
            ->paginate(25);
        }

        return view('admin.eris.reports.validation_reports.rapid_validation.report', [
            'rapidValidation' => $rapidValidation,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'sort_by' => $sortBy,
            'sort_order' => $sortOrder,
        ]);
    }
    
    public function generatePdfReport(Request $request, $sortBy, $sortOrder)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        if($startDate && $endDate)
        {
            $rapidValidation = RapidValidation::whereBetween(DB::raw('CAST(dteassign AS DATE)'), [$startDate, $endDate])
            ->where('dteassign', '>=', $startDate)
            ->where('dteassign', '<=', $endDate)
            ->orderBy($sortBy, $sortOrder)
            ->get();
        }
        else
        {
            $rapidValidation = RapidValidation::with(['erisTblMainRapidValidation'])
            ->orderBy($sortBy, $sortOrder)
            ->get();
        }

        $pdf = Pdf::loadView('admin.eris.reports.validation_reports.rapid_validation.report_pdf', [
            'rapidValidation' => $rapidValidation,
        ])
        ->setPaper('a4', 'landscape');

        return $pdf->stream('rapid-validation-report.pdf');
    }

    public function rapidValidationDateFilter($startDate, $endDate, $sortBy, $sortOrder)
    {
        $rapidValidation = RapidValidation::whereBetween(DB::raw('CAST(dteassign AS DATE)'), [$startDate, $endDate])
        ->where('dteassign', '>=', $startDate)
        ->where('dteassign', '<=', $endDate)
        ->orderBy($sortBy, $sortOrder)
        ->paginate(25);

        return $rapidValidation;
    }
}
