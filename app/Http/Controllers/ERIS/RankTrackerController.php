<?php

namespace App\Http\Controllers\ERIS;

use App\Http\Controllers\Controller;
use App\Models\Eris\EradTblMain;
use App\Models\Eris\LibraryRankTracker;
use App\Models\Eris\RankTracker;
use App\Models\PersonalData;
use App\Models\ProfileTblCesStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RankTrackerController extends Controller
{
    public function index($acno)
    {
        $erisTblMain = EradTblMain::find($acno);
        $rankTracker = $erisTblMain->rankTracker()->paginate(20);

        return view('admin.eris.partials.rank_tracker.table', compact('acno', 'rankTracker'));
    }

    public function create($acno)
    {
        $erisTblMainProfileData = EradTblMain::find($acno);
        $libraryRankTracker = LibraryRankTracker::all();

        return view('admin.eris.partials.rank_tracker.form', compact('acno', 'erisTblMainProfileData', 'libraryRankTracker'));
    }

    public function store(Request $request, $acno)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        // retrieving r_catid rank tracker catid
        $r_catid = LibraryRankTracker::where('description', $request->description)->value('catid');

        // retrieving r_ctrlno rank tracker ctrlno
        $r_ctrlno = LibraryRankTracker::where('description', $request->description)->value('ctrlno');

        $cesno = EradTblMain::where('acno', $acno)->value('cesno');

        $latestCestatusCode = PersonalData::find($cesno);
        
        if($latestCestatusCode->cesStatus != null)
        {
            $latestCestatusDescription = $latestCestatusCode->cesStatus->description;
        }
        else
        {
            $latestCestatusDescription = null;
        }

        $rankTracker = new RankTracker([

            'r_catid' => $r_catid,
            'r_ctrlno' => $r_ctrlno,
            'description' => $request->description,
            'submit_dt' => $request->submit_dt, //  submit date
            'remarks' => $request->remarks, 
            'cesstatus' => $latestCestatusDescription,
            'encoder' =>  $encoder,

        ]);

        $erisTblMain = EradTblMain::find($request->acno);        

        $erisTblMain->rankTracker()->save($rankTracker);
   
        // update ces status based on $latestCestatusDescription in erad_tblranktracker table
        DB::table('erad_tblranktracker')
        ->where('acno', $acno)
        ->update(['cesstatus' => $latestCestatusDescription]);
        
        return to_route('eris-rank-tracker.index', ['acno'=>$acno])->with('message', 'Save Sucessfully');
    }

    public function edit($acno, $ctrlno)
    {
        $erisTblMainProfileData = EradTblMain::find($acno);
        $libraryRankTracker = LibraryRankTracker::all();
        $rankTracker = RankTracker::find($ctrlno);

        return view('admin.eris.partials.rank_tracker.edit', compact('acno', 'erisTblMainProfileData', 'rankTracker', 'libraryRankTracker', 'ctrlno'));
    }

    public function update(Request $request, $acno, $ctrlno)
    {
        $rankTracker = RankTracker::find($ctrlno);
        $rankTracker->description = $request->description;
        $rankTracker->submit_dt = $request->submit_dt; // submit date
        $rankTracker->remarks = $request->remarks;
        $rankTracker->save();

        return to_route('eris-rank-tracker.index', ['acno'=>$acno])->with('info', 'Update Sucessfully');
    }

    public function destroy($ctrlno)
    {
        $rankTracker = RankTracker::find($ctrlno);
        $rankTracker->delete();

       return back()->with('message', 'Deleted Sucessfully');        
    }

    public function recentlyDeleted($acno)
    {
        //parent model
        $erisTblMainData = EradTblMain::withTrashed()->find($acno);

        // Access the soft deleted rankTracker of the parent model
        $rankTrackerTrashedRecord = $erisTblMainData->rankTracker()->onlyTrashed()->paginate(20);
 
        return view('admin.eris.partials.rank_tracker.trashbin', compact('rankTrackerTrashedRecord', 'acno'));
    }

    public function restore($ctrlno)
    {
        $rankTrackerTrashedRecord = RankTracker::onlyTrashed()->find($ctrlno);
        $rankTrackerTrashedRecord->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }

    public function forceDelete($ctrlno)
    {
        $rankTrackerTrashedRecord = RankTracker::onlyTrashed()->find($ctrlno);
        $rankTrackerTrashedRecord->forceDelete();
  
        return back()->with('info', 'Data Permanently Deleted');
    }
}
