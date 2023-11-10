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
        $sortBy = $request->input('sortBy', 'dteassign'); // Default sorting by date assign.
        $sortOrder = $request->input('sortOrder', 'desc'); // Default sorting order

        if($startDate && $endDate)
        {
            $inDepthValidation = $this->inDepthValidationDateFilter($startDate, $endDate, $sortBy, $sortOrder);
        }
        else
        {
            $inDepthValidation = InDepthValidation::with(['erisTblMainInDepthValidation'])
            ->orderBy($sortBy, $sortOrder)
            ->paginate(25);
        }

        return view('admin.eris.reports.validation_reports.inDepth_validation.inDepth_validation', [
            'inDepthValidation' => $inDepthValidation,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
        ]);
    }

    public function generateReportPdf(Request $request, $sortBy, $sortOrder)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        if($startDate && $endDate)
        {
            $inDepthValidation = InDepthValidation::whereBetween(DB::raw('CAST(dteassign AS DATE)'), [$startDate, $endDate])
            ->where('dteassign', '>=', $startDate)
            ->where('dteassign', '<=', $endDate)
            ->orderBy($sortBy, $sortOrder)
            ->paginate(25);
        }
        else
        {
            $inDepthValidation = InDepthValidation::orderBy($sortBy, $sortOrder)
            ->get();
        }

        $pdf = Pdf::loadView('admin.eris.reports.validation_reports.inDepth_validation.report_pdf', [
            'inDepthValidation' => $inDepthValidation,
        ])
        ->setPaper('a4', 'landscape');

        return $pdf->stream('in-depth-validation-report.pdf');
    }

    public function inDepthValidationDateFilter($startDate, $endDate, $sortBy, $sortOrder)
    {
        $inDepthValidation = InDepthValidation::whereBetween(DB::raw('CAST(dteassign AS DATE)'), [$startDate, $endDate])
        ->where('dteassign', '>=', $startDate)
        ->where('dteassign', '<=', $endDate)
        ->orderBy($sortBy, $sortOrder)
        ->paginate(25);

        return $inDepthValidation;
    }
}
