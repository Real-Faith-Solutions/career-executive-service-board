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

        $boardInterview = BoardInterView::paginate(25);
        
        return view('admin.eris.reports.board_panel_interview_reports.report', compact('boardInterview', 'interviewType'));
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
        $panelBoardInterview = PanelBoardInterview::paginate(25);

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
