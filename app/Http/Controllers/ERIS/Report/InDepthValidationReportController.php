<?php

namespace App\Http\Controllers\Eris\Report;

use App\Http\Controllers\Controller;
use App\Models\Eris\InDepthValidation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InDepthValidationReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        if($startDate && $endDate)
        {
            $inDepthValidation = $this->inDepthValidationDateFilter($startDate, $endDate);
        }
        else
        {
            $inDepthValidation = InDepthValidation::paginate(25);
        }

        return view('admin.eris.reports.validation_reports.inDepth_validation.inDepth_validation', [
            'inDepthValidation' => $inDepthValidation,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }

    public function generateReportPdf(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        if($startDate && $endDate)
        {
            $inDepthValidation = $this->inDepthValidationDateFilter($startDate, $endDate);
        }
        else
        {
            $inDepthValidation = InDepthValidation::all();
        }

        $pdf = Pdf::loadView('admin.eris.reports.validation_reports.inDepth_validation.report_pdf', [
            'inDepthValidation' => $inDepthValidation,
        ])
        ->setPaper('a4', 'landscape');

        return $pdf->stream('in-depth-validation-report.pdf');
    }

    public function inDepthValidationDateFilter($startDate, $endDate)
    {
        $inDepthValidation = InDepthValidation::whereBetween(DB::raw('CAST(dteassign AS DATE)'), [$startDate, $endDate])
        ->where('dteassign', '>=', $startDate)
        ->where('dteassign', '<=', $endDate)
        ->paginate(25);

        return $inDepthValidation;
    }
}
