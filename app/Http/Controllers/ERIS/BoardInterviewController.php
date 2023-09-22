<?php

namespace App\Http\Controllers\ERIS;

use App\Http\Controllers\Controller;
use App\Models\Eris\BoardInterView;
use App\Models\Eris\ErisTblMain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoardInterviewController extends Controller
{
    public function index($acno)
    {
        $erisTblMain = ErisTblMain::find($acno);
        $boardInterview = $erisTblMain->boardInterview()->paginate(20);

        return view('admin.eris.partials.board_interview.table', compact('acno', 'boardInterview'));
    }

    public function create($acno)
    {
        $erisTblMainProfileData = ErisTblMain::find($acno);

        return view('admin.eris.partials.board_interview.form', compact('acno', 'erisTblMainProfileData'));
    }

    public function store(Request $request, $acno)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $boardInterview = new BoardInterView([

            'dteassign' => $request->dteassign, // date assign
            'dtesubmit' => $request->dtesubmit, // date submit
            'intrviewer' => $request->intrviewer, // interviewer 
            'dteiview' => $request->dteiview, // recommendation
            'recom' => $request->recom, // recommendation
            'encoder' =>  $encoder,

        ]);

        $erisTblMain = ErisTblMain::find($request->acno);
        
        $erisTblMain->boardInterview()->save($boardInterview);
        
        return to_route('eris-board-interview.index', ['acno'=>$acno])->with('message', 'Save Sucessfully');
    }

    public function edit($acno, $ctrlno)
    {
        $erisTblMainProfileData = ErisTblMain::find($acno);
        $boardInterview = BoardInterView::find($ctrlno);

        return view('admin.eris.partials.board_interview.edit', compact('acno', 'erisTblMainProfileData', 'boardInterview', 'ctrlno'));
    }

    public function update(Request $request, $acno, $ctrlno)
    {
        $boardInterview = BoardInterView::find($ctrlno);
        $boardInterview->dteassign = $request->dteassign;
        $boardInterview->dtesubmit = $request->dtesubmit;
        $boardInterview->intrviewer = $request->intrviewer;
        $boardInterview->dteiview = $request->dteiview;
        $boardInterview->recom = $request->recom;
        $boardInterview->save();

        return to_route('eris-board-interview.index', ['acno'=>$acno])->with('info', 'Update Sucessfully');
    }
}
