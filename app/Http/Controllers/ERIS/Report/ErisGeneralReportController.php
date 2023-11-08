<?php

namespace App\Http\Controllers\ERIS\report;

use App\Http\Controllers\Controller;
use App\Models\Eris\EradTblMain;
use Illuminate\Http\Request;

class ErisGeneralReportController extends Controller
{
    public function index()
    {
        $conferred = "conferred";

        $eradTblMain = EradTblMain::where('c_status', '!=', $conferred)
            ->orderBy('lastname')
            ->orderBy('acno')
            ->paginate(25);

        return view('admin.eris.reports.general_report.report', [
            'eradTblMain' => $eradTblMain,
        ]);
    }
}
