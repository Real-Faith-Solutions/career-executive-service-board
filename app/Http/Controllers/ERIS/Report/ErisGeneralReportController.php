<?php

namespace App\Http\Controllers\ERIS\report;

use App\Http\Controllers\Controller;
use App\Jobs\GeneratePdfReport;
use App\Models\Eris\EradTblMain;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ErisGeneralReportController extends Controller
{
    public function index()
    {
        $conferred = "conferred";

        $eradTblMain = EradTblMain::where('c_status', '!=', $conferred)
            ->orderBy('acno')
            ->paginate(25);

        return view('admin.eris.reports.general_report.report', [
            'eradTblMain' => $eradTblMain,
        ]);
    }

    public function generatePdfReport()
    {
        $conferred = "conferred";

        $eradTblMain = EradTblMain::where('c_status', '!=', $conferred)
            ->orderBy('lastname')
            ->get(['acno', 'lastname', 'firstname', 'middlename', 'c_status']);
            // ->paginate(25);

        $pdf = Pdf::loadView('admin.eris.reports.general_report.report_pdf', [
            'eradTblMain' => $eradTblMain,
        ])
        ->setPaper('a4', 'landscape');

        return $pdf->stream('eris-general-report.pdf');
    }
}
