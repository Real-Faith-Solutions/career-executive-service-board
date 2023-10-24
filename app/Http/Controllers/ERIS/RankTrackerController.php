<?php

namespace App\Http\Controllers\ERIS;

use App\Http\Controllers\Controller;
use App\Models\Eris\EradTblMain;
use App\Models\Eris\LibraryRankTracker;
use App\Models\Eris\RankTracker;
use App\Models\Eris\RankTracker201;
use App\Models\PersonalData;
use App\Models\ProfileTblCesStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RankTrackerController extends Controller
{
    // App\Models
    private LibraryRankTracker $libraryRankTracker;
    private PersonalData $personalData;

    public function __construct()
    {
        $this->libraryRankTracker = new LibraryRankTracker();
        $this->personalData = new PersonalData();
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
        $cesno = $erisTblMain->cesno;
        $rankTracker = $erisTblMain->rankTracker()->paginate(25);

        return view('admin.eris.partials.rank_tracker.table', compact('acno', 'rankTracker', 'cesno'));
    }

    public function create($acno)
    {
        $erisTblMainProfileData = EradTblMain::find($acno);
        $libraryRankTracker = LibraryRankTracker::all();

        return view('admin.eris.partials.rank_tracker.form', compact('acno', 'erisTblMainProfileData', 'libraryRankTracker'));
    }

    public function store(Request $request, $acno)
    {
        $request->validate([
            'description' => ['required', Rule::unique('erad_tblranktracker')->where('acno', $acno)],
        ]);

        $cesno = EradTblMain::where('acno', $acno)->value('cesno');

        $rankTracker = new RankTracker([

            'r_catid' => $this->libraryRankTracker->getRankTrackerCatId($request->description),
            'r_ctrlno' => $this->libraryRankTracker->getRankTrackerControlNo($request->description),
            'description' => $request->description,
            'submit_dt' => $request->submit_dt, //  submit date
            'remarks' => $request->remarks, 
            'cesstatus' => $this->personalData->latestCesStatus($cesno),
            'encoder' =>  $this->getFullNameAttribute(),

        ]);

        $erisTblMain = EradTblMain::find($request->acno);        

        $erisTblMain->rankTracker()->save($rankTracker);

        // store in rank tracker 201
        RankTracker201::create([

            'cesno' =>  $cesno,
            'r_catid' => $this->libraryRankTracker->getRankTrackerCatId($request->description),
            'r_ctrlno' => $this->libraryRankTracker->getRankTrackerControlNo($request->description),
            'description' => $request->description,
            'remarks' => $request->remarks,
            'submit_dt' => $request->submit_dt, //  submit date,
            'encoder' =>  $this->getFullNameAttribute(),
            
        ]);
   
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

    public function destroy($ctrlno, $cesno)
    {
        $rankTracker = RankTracker::find($ctrlno);

        if ($rankTracker) 
        {
            $ctrlno = RankTracker201::where('cesno', $cesno)
                ->where('r_catid', $rankTracker->r_catid)
                ->where('r_ctrlno', $rankTracker->r_ctrlno)
                ->where('description', $rankTracker->description)
                ->where('remarks', $rankTracker->remarks)
                ->where('submit_dt', $rankTracker->submit_dt)
                ->value('ctrlno');

            $rankTracker201 = RankTracker201::find($ctrlno);

            if ($rankTracker201) 
            {
                $rankTracker201->delete();
                $rankTracker->delete();
            }        
        } 
        else 
        {
            return back()->with('error', 'Data Not Found');
        }

       return back()->with('message', 'Deleted Sucessfully');        
    }

    public function recentlyDeleted($acno)
    {
        //parent model
        $erisTblMainData = EradTblMain::withTrashed()->find($acno);
        $cesno = $erisTblMainData->cesno;

        // Access the soft deleted rankTracker of the parent model
        $rankTrackerTrashedRecord = $erisTblMainData->rankTracker()->onlyTrashed()->paginate(20);
 
        return view('admin.eris.partials.rank_tracker.trashbin', compact('rankTrackerTrashedRecord', 'acno', 'cesno'));
    }

    public function restore($ctrlno, $cesno)
    {
        $rankTrackerTrashedRecord = RankTracker::onlyTrashed()->find($ctrlno);

        if ($rankTrackerTrashedRecord) 
        {
            $controlNo = RankTracker201::onlyTrashed()
                ->where('cesno', $cesno)
                ->where('r_catid', $rankTrackerTrashedRecord->r_catid)
                ->where('r_ctrlno', $rankTrackerTrashedRecord->r_ctrlno)
                ->where('description', $rankTrackerTrashedRecord->description)
                ->where('remarks', $rankTrackerTrashedRecord->remarks)
                ->where('submit_dt', $rankTrackerTrashedRecord->submit_dt)
                ->value('ctrlno');
        
            if ($controlNo) 
            {
                $rankTracker201TrashedRecord = RankTracker201::onlyTrashed()->find($controlNo);

                if ($rankTracker201TrashedRecord) 
                {
                    $rankTracker201TrashedRecord->restore();
                    $rankTrackerTrashedRecord->restore();

                    return back()->with('info', 'Data Restored Successfully');
                }
            }
        }
        
        return back()->with('error', 'Data Not Found or Could Not Be Restored');        
    }

    public function forceDelete($ctrlno, $cesno)
    {
        $rankTrackerTrashedRecord = RankTracker::onlyTrashed()->find($ctrlno);

        if ($rankTrackerTrashedRecord) 
        {
            $controlNo = RankTracker201::onlyTrashed()
                ->where('cesno', $cesno)
                ->where('r_catid', $rankTrackerTrashedRecord->r_catid)
                ->where('r_ctrlno', $rankTrackerTrashedRecord->r_ctrlno)
                ->where('description', $rankTrackerTrashedRecord->description)
                ->where('remarks', $rankTrackerTrashedRecord->remarks)
                ->where('submit_dt', $rankTrackerTrashedRecord->submit_dt)
                ->value('ctrlno');
        
            if ($controlNo) 
            {
                $rankTracker201TrashedRecord = RankTracker201::onlyTrashed()->find($controlNo);

                if ($rankTracker201TrashedRecord) 
                {
                    $rankTracker201TrashedRecord->forceDelete();
                    $rankTrackerTrashedRecord->forceDelete();

                    return back()->with('info', 'Data Permanently Deleted');
                }
            }
        }
        
        return back()->with('error', 'Data Not Found or Could Not Be Deleted');          
    }
}
