<?php

namespace App\Http\Controllers\ERIS;

use App\Http\Controllers\Controller;
use App\Models\Eris\ErisTblMain;
use App\Models\Eris\PanelBoardInterview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request, $acno)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $panelBoardInterview = new PanelBoardInterview([

            'dteassign' => $request->dteassign, // date assign
            'dtesubmit' => $request->dtesubmit, // date submit
            'intrviewer' => $request->intrviewer, 
            'dteiview' => $request->dteiview, // recommendation
            'recom' => $request->recom, 
            'encoder' =>  $encoder,

        ]);

        $erisTblMain = ErisTblMain::find($request->acno);
        
        $erisTblMain->panelBoardInterview()->save($panelBoardInterview);
        
        return to_route('panel-board-interview.index', ['acno'=>$acno])->with('message', 'Save Sucessfully');     
    }
}
