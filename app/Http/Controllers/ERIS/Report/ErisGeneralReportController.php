<?php

namespace App\Http\Controllers\ERIS\report;

use App\Http\Controllers\Controller;
use App\Models\Eris\EradTblMain;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ErisGeneralReportController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->input('sortBy', 'acno'); // Default sorting acdate.
        $sortOrder = $request->input('sortOrder', 'asc'); // Default sorting order

        $conferred = "conferred";

        $eradTblMain = EradTblMain::where('c_status', '!=', $conferred)
            ->orderBy($sortBy, $sortOrder)
            ->paginate(25);

        return view('admin.eris.reports.general_report.report', [
            'eradTblMain' => $eradTblMain,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
        ]);
    }

    public function generatePdfReport($sortBy, $sortOrder)
    {
        $conferred = "conferred";

        $eradTblMain = EradTblMain::where('c_status', '!=', $conferred)
            ->orderBy($sortBy,$sortOrder)
            ->get(['acno', 'lastname', 'firstname', 'middlename', 'c_status']);
            // ->paginate(25);

        $pdf = Pdf::loadView('admin.eris.reports.general_report.report_pdf', [
            'eradTblMain' => $eradTblMain,
        ])
        ->setPaper('a4', 'landscape');

        return $pdf->stream('eris-general-report.pdf');
    }
}
