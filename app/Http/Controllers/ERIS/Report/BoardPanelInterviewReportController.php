<?php

namespace App\Http\Controllers\ERIS\Report;

use App\Http\Controllers\Controller;
use App\Models\Eris\BoardInterView;
use App\Models\Eris\PanelBoardInterview;
use Illuminate\Http\Request;

class BoardPanelInterviewReportController extends Controller
{
    public function index(Request $request)
    {
        $interviewType = $request->input('interview');

        $boardInterview = BoardInterView::paginate(25);
        $panelBoardInterview = PanelBoardInterview::paginate(25);
        
        return view('admin.eris.reports.board_panel_interview_reports.report', compact('boardInterview', 'panelBoardInterview', 'interviewType'));
    }

    public function displayInterview(Request $request)
    {
        $interviewType = $request->input('interview');

        switch ($interviewType) 
        {
            case 'Board Interview':

                return $this->boardInterview($interviewType);

            case 'Panel Board Interview':
               
                return $this->panelBoardInterview($interviewType);

            default:
                return to_route('eris-board-interview-report.index');
        }
    }

    public function boardInterview($interviewType)
    {
        $boardInterview = BoardInterView::paginate(25);
        
        return view('admin.eris.reports.board_panel_interview_reports.board_interview', compact('boardInterview', 'interviewType'));
    }

    public function panelBoardInterview($interviewType)
    {
        $panelBoardInterview = PanelBoardInterview::paginate(25);

        return view('admin.eris.reports.board_panel_interview_reports.panel_board_interview', compact('panelBoardInterview', 'interviewType'));
    }
}
