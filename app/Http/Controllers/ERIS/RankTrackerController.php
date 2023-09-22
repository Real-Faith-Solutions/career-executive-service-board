<?php

namespace App\Http\Controllers\ERIS;

use App\Http\Controllers\Controller;
use App\Models\Eris\ErisTblMain;
use App\Models\Eris\LibraryRankTracker;
use App\Models\Eris\RankTracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RankTrackerController extends Controller
{
    public function index($acno)
    {
        $erisTblMain = ErisTblMain::find($acno);
        $rankTracker = $erisTblMain->rankTracker()->paginate(20);

        return view('admin.eris.partials.rank_tracker.table', compact('acno', 'rankTracker'));
    }

    public function create($acno)
    {
        $erisTblMainProfileData = ErisTblMain::find($acno);
        $libraryRankTracker = LibraryRankTracker::all();

        return view('admin.eris.partials.rank_tracker.form', compact('acno', 'erisTblMainProfileData', 'libraryRankTracker'));
    }

    public function store(Request $request, $acno)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $rankTracker = new RankTracker([

            'description' => $request->description,
            'submit_dt' => $request->submit_dt, //  submit date
            'remarks' => $request->remarks, 
            'encoder' =>  $encoder,

        ]);

        $erisTblMain = ErisTblMain::find($request->acno);
        
        $erisTblMain->rankTracker()->save($rankTracker);
        
        return to_route('eris-rank-tracker.index', ['acno'=>$acno])->with('message', 'Save Sucessfully');
    }

    public function edit($acno, $ctrlno)
    {
        $erisTblMainProfileData = ErisTblMain::find($acno);
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
}
