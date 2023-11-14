<?php

namespace App\Http\Controllers\ERIS\Report;

use App\Http\Controllers\Controller;
use App\Models\Eris\BoardInterView;
use App\Models\Eris\PanelBoardInterview;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BoardPanelInterviewReportController extends Controller
{
    public function index(Request $request)
    {
        $interviewType = $request->input('interview');
        $sortBy = $request->input('sort_by', 'dteassign'); // Default sorting by Ces No.
        $sortOrder = $request->input('sort_order', 'asc'); // Default sorting order

        // $boardInterview = BoardInterView::query()
        // ->orderBy($sortBy, $sortOrder)
        // ->paginate(25);

        $boardInterview = BoardInterView::join('erad_tblMain', 'erad_tblMain.acno', '=', 'erad_tblBOARD.acno')
        ->select('erad_tblBOARD.*')
        ->with('erisTblMainBoardInterview')
        ->orderBy($sortBy, $sortOrder)
        ->paginate(25);
        
        return view('admin.eris.reports.board_panel_interview_report.board_interview_report.index', compact('boardInterview', 'interviewType', 'sortBy', 'sortOrder'));
    }

    public function displayInterview(Request $request)
    {
        $interviewType = $request->input('interview');

        switch ($interviewType) 
        {
            case 'Panel Board Interview':
               
                return $this->panelBoardInterview($interviewType);

            default:
                return to_route('eris-board-interview-report.index');
        }
    }

    public function panelBoardInterview($interviewType)
    {
        $panelBoardInterview = PanelBoardInterview::join('erad_tblMain', 'erad_tblMain.acno', '=', 'erad_tblPBOARD.acno')
        ->orderBy('erad_tblMain.lastname')
        ->select('erad_tblPBOARD.*')
        ->with(['erisTblMainPanelBoardInterview' => function($query) {
            $query->orderBy('lastname');
        }])
        ->paginate(25);

        return view('admin.eris.reports.board_panel_interview_reports.panel_board_interview', compact('panelBoardInterview', 'interviewType'));
    }

    public function generateReportPdf(Request $request)
    {
        $interviewType = $request->input('interview-type');

        $panelBoardInterview =  'Panel Board Interview';

        if($interviewType == $panelBoardInterview)
        {
            $panelBoardInterview = PanelBoardInterview::all();
            $boardInterview = null;
        }
        
        if($interviewType == null)
        {
            $panelBoardInterview = null;
            $boardInterview = BoardInterView::all();
        }
        
        $pdf = Pdf::loadView('admin.eris.reports.board_panel_interview_reports.report_pdf', [
            'panelBoardInterview' => $panelBoardInterview,
            'boardInterview' => $boardInterview,
            'interviewType' => $interviewType,
        ])
        ->setPaper('a4', 'landscape');

        return $pdf->stream('panel-and-board-interview-report.pdf');
    }
}
