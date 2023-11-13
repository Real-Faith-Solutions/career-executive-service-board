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
        
        $rapidValidation = RapidValidation::leftJoin('erad_tblMain', 'erad_tblMain.acno', '=', 'erad_tblRVP.acno')
        ->select('erad_tblRVP.*')
        ->with('erisTblMainRapidValidation')
        ->when($startDate && $endDate, function ($query) use ($startDate, $endDate, $sortBy, $sortOrder) {
            return $query
                ->whereBetween(DB::raw('CAST(dteassign AS DATE)'), [$startDate, $endDate])
                ->orderBy($sortBy, $sortOrder);
        }, function ($query) use ($sortBy, $sortOrder) {
            return $query->orderBy($sortBy, $sortOrder);
        })
        ->paginate(25);

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

        $rapidValidation = RapidValidation::leftJoin('erad_tblMain', 'erad_tblMain.acno', '=', 'erad_tblRVP.acno')
        ->select('erad_tblRVP.*')
        ->with('erisTblMainRapidValidation')
        ->when($startDate && $endDate, function ($query) use ($startDate, $endDate, $sortBy, $sortOrder) {
            return $query
                ->whereBetween(DB::raw('CAST(dteassign AS DATE)'), [$startDate, $endDate])
                ->orderBy($sortBy, $sortOrder);
        }, function ($query) use ($sortBy, $sortOrder) {
            return $query->orderBy($sortBy, $sortOrder);
        })
        ->paginate(25);

        $pdf = Pdf::loadView('admin.eris.reports.validation_reports.rapid_validation.report_pdf', [
            'rapidValidation' => $rapidValidation,
        ])
        ->setPaper('a4', 'landscape');

        return $pdf->stream('rapid-validation-report.pdf');
    }
}
