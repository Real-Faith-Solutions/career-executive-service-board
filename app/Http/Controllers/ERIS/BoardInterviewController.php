<?php

namespace App\Http\Controllers\ERIS;

use App\Http\Controllers\Controller;
use App\Models\Eris\BoardInterView;
use App\Models\Eris\EradTblMain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ConvertDateTimeToDate;


class BoardInterviewController extends Controller
{
    // App\Models
    private BoardInterView $boardInterView;

    // App\Services
    private ConvertDateTimeToDate $convertDateTimeToDate;
 
    public function __construct(ConvertDateTimeToDate $convertDateTimeToDate)
    {
        $this->convertDateTimeToDate = $convertDateTimeToDate;
        $this->boardInterView = new BoardInterView();
    }

    public function getFullNameAttribute()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        return $encoder;
    }

    public function index($acno)
    {
        $erisTblMain = EradTblMain::find($acno);
        $boardInterview = $erisTblMain->boardInterview()->paginate(20);

        return view('admin.eris.partials.board_interview.table', compact('acno', 'boardInterview'));
    }

    public function create($acno)
    {
        $erisTblMainProfileData = EradTblMain::find($acno);

        return view('admin.eris.partials.board_interview.form', compact('acno', 'erisTblMainProfileData'));
    }

    public function store(Request $request, $acno)
    {
        $boardInterview = new BoardInterView([

            'dteassign' => $request->dteassign, // date assign
            'dtesubmit' => $request->dtesubmit, // date submit
            'intrviewer' => $request->intrviewer, // interviewer 
            'dteiview' => $request->dteiview, // recommendation
            'recom' => $request->recom, // recommendation
            'encoder' =>  $this->getFullNameAttribute(),

        ]);

        $erisTblMain = EradTblMain::find($request->acno);
        
        $erisTblMain->boardInterview()->save($boardInterview);
        
        return to_route('eris-board-interview.index', ['acno'=>$acno])->with('message', 'Save Sucessfully');
    }

    public function edit($acno, $ctrlno)
    {
        $erisTblMainProfileData = EradTblMain::find($acno);
        $boardInterview = $this->boardInterView->getUserBoardInterview($ctrlno);
        $convertDateFromAndTo = $this->convertDateTimeToDate->convertDateFromAndTo($boardInterview['dateFrom'], $boardInterview['dateTo']);

        return view('admin.eris.partials.board_interview.edit', [
            'acno' => $acno, 
            'ctrlno' => $ctrlno,
            'erisTblMainProfileData' => $erisTblMainProfileData, 
            'boardInterview' => $boardInterview['boardInterview'], 
            'assignedDate' => $convertDateFromAndTo['dateFrom'],
            'submittionDate' => $convertDateFromAndTo['dateTo'],
            'dateInterview' => $this->convertDateTimeToDate->convertDateGeneral($boardInterview['dteiview']),

        ]);
    }

    public function update(Request $request, $acno, $ctrlno)
    {
        $boardInterview = BoardInterView::find($ctrlno);
        $boardInterview->dteassign = $request->dteassign;
        $boardInterview->dtesubmit = $request->dtesubmit;
        $boardInterview->intrviewer = $request->intrviewer;
        $boardInterview->dteiview = $request->dteiview;
        $boardInterview->recom = $request->recom;
        $boardInterview->update();

        return to_route('eris-board-interview.index', ['acno'=>$acno])->with('info', 'Update Sucessfully');
    }

    public function destroy($ctrlno)
    {
        $boardInterview = BoardInterView::find($ctrlno);
        $boardInterview->delete();

        return back()->with('message', 'Deleted Sucessfully');        
    }

    public function recentlyDeleted($acno)
    {
        //parent model
        $erisTblMainData = EradTblMain::withTrashed()->find($acno);

        // Access the soft deleted boardInterview of the parent model
        $boardInterViewTrashedRecord = $erisTblMainData->boardInterview()->onlyTrashed()->paginate(20);
 
        return view('admin.eris.partials.board_interview.trashbin', compact('boardInterViewTrashedRecord', 'acno'));
    }

    public function restore($ctrlno)
    {
        $boardInterViewTrashedRecord = BoardInterView::onlyTrashed()->find($ctrlno);
        $boardInterViewTrashedRecord->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }

    public function forceDelete($ctrlno)
    {
        $boardInterViewTrashedRecord = BoardInterView::onlyTrashed()->find($ctrlno);
        $boardInterViewTrashedRecord->forceDelete();
  
        return back()->with('info', 'Data Permanently Deleted');
    }
}
