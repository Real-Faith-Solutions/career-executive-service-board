<?php

namespace App\Http\Controllers\ERIS;

use App\Http\Controllers\Controller;
use App\Models\Eris\ErisTblMain;
use Illuminate\Http\Request;

class PanelBoardInterviewController extends Controller
{
    public function index($acno)
    {
        $erisTblMain = ErisTblMain::find($acno);
        $panelBoardInterview = $erisTblMain->panelBoardInterview()->paginate(20);
        
        return view('admin.eris.partials.panel_board_interview.table', compact('acno', 'panelBoardInterview'));
    }

    public function create($acno)
    {
        $erisTblMainProfileData = ErisTblMain::find($acno);

        return view('admin.eris.partials.panel_board_interview.form', compact('acno', 'erisTblMainProfileData'));
    }
}
