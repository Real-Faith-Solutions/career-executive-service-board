<?php

namespace App\Http\Controllers\ERIS\report;

use App\Http\Controllers\Controller;
use App\Models\Eris\PanelBoardInterview;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PanelBoardInterviewReportController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->input('sort_by', 'lastname'); // Default sorting by lastname.
        $sortOrder = $request->input('sort_order', 'asc'); // Default sorting order

        $panelBoardInterview = PanelBoardInterview::join('erad_tblMain', 'erad_tblMain.acno', '=', 'erad_tblPBOARD.acno')
        ->select('erad_tblPBOARD.*')
        ->with('erisTblMainPanelBoardInterview')
        ->orderBy($sortBy, $sortOrder)
        ->paginate(25);

        return view('admin.eris.reports.board_panel_interview_report.panel_board_interview_report.index', 
        compact(
            'panelBoardInterview', 
            'sortBy',
            'sortOrder',
        ));
    }

    public function generateReportPdf(Request $request)
    {
        $sortBy = $request->input('sort_by', 'lastname'); // Default sorting by lastname.
        $sortOrder = $request->input('sort_order', 'asc'); // Default sorting order

        $panelBoardInterview = PanelBoardInterview::join('erad_tblMain', 'erad_tblMain.acno', '=', 'erad_tblPBOARD.acno')
        ->select('erad_tblPBOARD.*')
        ->with('erisTblMainPanelBoardInterview')
        ->orderBy($sortBy, $sortOrder)
        ->get();
        // ->paginate(25);

        $pdf = Pdf::loadView('admin.eris.reports.board_panel_interview_report.panel_board_interview_report.report_pdf', [
            'panelBoardInterview' => $panelBoardInterview, 
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
        ])
        ->setPaper('a4', 'landscape');

        return $pdf->stream('panel-board-interview-report.pdf');
    }
}
