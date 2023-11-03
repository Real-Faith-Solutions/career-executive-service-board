<?php

namespace App\Http\Controllers\ERIS;

use App\Http\Controllers\Controller;
use App\Models\Eris\EradTblMain;
use App\Models\Eris\PanelBoardInterview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ConvertDateTimeToDate;

class PanelBoardInterviewController extends Controller
{
    // App\Models
    private PanelBoardInterview $panelBoardInterview;

    // App\Services
    private ConvertDateTimeToDate $convertDateTimeToDate;
 
    public function __construct(ConvertDateTimeToDate $convertDateTimeToDate)
    {
        $this->convertDateTimeToDate = $convertDateTimeToDate;
        $this->panelBoardInterview = new PanelBoardInterview();
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
        $panelBoardInterview = $erisTblMain->panelBoardInterview()->paginate(20);
        
        return view('admin.eris.partials.panel_board_interview.table', compact('acno', 'panelBoardInterview'));
    }

    public function create($acno)
    {
        $erisTblMainProfileData = EradTblMain::find($acno);

        return view('admin.eris.partials.panel_board_interview.form', compact('acno', 'erisTblMainProfileData'));
    }

    public function store(Request $request, $acno)
    {
        $panelBoardInterview = new PanelBoardInterview([

            'dteassign' => $request->dteassign, // date assign
            'dtesubmit' => $request->dtesubmit, // date submit
            'intrviewer' => $request->intrviewer, 
            'dteiview' => $request->dteiview, // recommendation
            'recom' => $request->recom, 
            'encoder' =>  $this->getFullNameAttribute(),

        ]);

        $erisTblMain = EradTblMain::find($request->acno);
        
        $erisTblMain->panelBoardInterview()->save($panelBoardInterview);
        
        return to_route('panel-board-interview.index', ['acno'=>$acno])->with('message', 'Save Sucessfully');     
    }

    public function edit($acno, $ctrlno)
    {
        $erisTblMainProfileData = EradTblMain::find($acno);

        $panelBoardInterview = $this->panelBoardInterview->getUserPanelBoardInterview($ctrlno);
        $convertDateFromAndTo = $this->convertDateTimeToDate->convertDateFromAndTo($panelBoardInterview['dateFrom'], $panelBoardInterview['dateTo']);
        
        return view('admin.eris.partials.panel_board_interview.edit', [
            'acno' => $acno, 
            'ctrlno' => $ctrlno,
            'erisTblMainProfileData' => $erisTblMainProfileData, 
            'dateAssigned' => $convertDateFromAndTo['dateFrom'],
            'dateSubmit' => $convertDateFromAndTo['dateTo'],
            'dateInterview' => $this->convertDateTimeToDate->convertDateGeneral($panelBoardInterview['dateInterview']),
            'panelBoardInterview' => $panelBoardInterview['panelBoardInterview'], 
        ]);
    }

    public function update(Request $request, $acno, $ctrlno)
    {
        $panelBoardInterview = PanelBoardInterview::find($ctrlno);
        $panelBoardInterview->dteassign = $request->dteassign;
        $panelBoardInterview->dtesubmit = $request->dtesubmit;
        $panelBoardInterview->intrviewer = $request->intrviewer;
        $panelBoardInterview->dteiview = $request->dteiview;
        $panelBoardInterview->recom = $request->recom;
        $panelBoardInterview->save();

        return to_route('panel-board-interview.index', ['acno'=>$acno])->with('info', 'Update Sucessfully');
    }

    public function destroy($ctrlno)
    {
        $panelBoardInterview = PanelBoardInterview::find($ctrlno);
        $panelBoardInterview->delete();

        return back()->with('message', 'Deleted Sucessfully');        
    }

    public function recentlyDeleted($acno)
    {
        //parent model
        $erisTblMainData = EradTblMain::withTrashed()->find($acno);

        // Access the soft deleted panelBoardInterview of the parent model
        $panelBoardInterviewTrashedRecord = $erisTblMainData->panelBoardInterview()->onlyTrashed()->paginate(20);
 
        return view('admin.eris.partials.panel_board_interview.trashbin', compact('panelBoardInterviewTrashedRecord', 'acno'));
    }

    public function restore($ctrlno)
    {
        $panelBoardInterviewTrashedRecord = PanelBoardInterview::onlyTrashed()->find($ctrlno);
        $panelBoardInterviewTrashedRecord->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }

    public function forceDelete($ctrlno)
    {
        $panelBoardInterviewTrashedRecord = PanelBoardInterview::onlyTrashed()->find($ctrlno);
        $panelBoardInterviewTrashedRecord->forceDelete();
  
        return back()->with('info', 'Data Permanently Deleted');
    }
}
