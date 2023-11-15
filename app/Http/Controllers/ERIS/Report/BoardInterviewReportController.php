<?php

namespace App\Http\Controllers\ERIS\report;

use App\Http\Controllers\Controller;
use App\Models\Eris\BoardInterView;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BoardInterviewReportController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->input('sort_by', 'lastname'); // Default sorting by lastname.
        $sortOrder = $request->input('sort_order', 'asc'); // Default sorting order

        $boardInterview = BoardInterView::join('erad_tblMain', 'erad_tblMain.acno', '=', 'erad_tblBOARD.acno')
        ->select('erad_tblBOARD.*')
        ->with('erisTblMainBoardInterview')
        ->orderBy($sortBy, $sortOrder)
        ->paginate(25);
        
        return view('admin.eris.reports.board_panel_interview_report.board_interview_report.index', 
        compact(
            'boardInterview', 
            'sortBy', 
            'sortOrder'
        ));
    }

    public function generateReportPdf(Request $request)
    {
        $sortBy = $request->input('sort_by', 'lastname'); // Default sorting by lastname.
        $sortOrder = $request->input('sort_order', 'asc'); // Default sorting order

        $boardInterview = BoardInterView::join('erad_tblMain', 'erad_tblMain.acno', '=', 'erad_tblBOARD.acno')
        ->select('erad_tblBOARD.*')
        ->with('erisTblMainBoardInterview')
        ->orderBy($sortBy, $sortOrder)
        ->get();
        // ->paginate(25);

        $pdf = Pdf::loadView('admin.eris.reports.board_panel_interview_report.board_interview_report.report_pdf', [
            'boardInterview' => $boardInterview, 
            'sortBy' => $sortBy, 
            'sortOrder' => $sortOrder,
        ])
        ->setPaper('a4', 'landscape');

        return $pdf->stream('board-interview-report.pdf');
    }
}
