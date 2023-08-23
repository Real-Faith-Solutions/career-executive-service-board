<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use App\Models\ProfileLibTblAppAuthority;
use App\Models\ProfileLibTblCesStatus;
use App\Models\ProfileLibTblCesStatusAcc;
use App\Models\ProfileLibTblCesStatusType;
use App\Models\ProfileTblCesStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EligibilityAndRankTrackerController extends Controller
{
    // const MODULE_201_PROFILING = 'admin.201_profiling';

    public function index($cesno)
    {
        $personalData = PersonalData::find($cesno);
        $profileTblCesStatus = $personalData->ProfileTblCesStatus;

        return view('admin.201_profiling.view_profile.partials.eligibility_and_rank_tracker.table', compact('profileTblCesStatus' ,'cesno'));
    }

    public function create($cesno)
    {
        $profileLibTblCesStatus = ProfileLibTblCesStatus::all();
        $profileLibTblCesStatusAcc = ProfileLibTblCesStatusAcc::all();
        $profileLibTblCesStatusType = ProfileLibTblCesStatusType::all();
        $profileLibTblAppAuthority = ProfileLibTblAppAuthority::all();

        return view('admin.201_profiling.view_profile.partials.eligibility_and_rank_tracker.form', 
        compact('profileLibTblCesStatus' ,'profileLibTblCesStatusAcc' ,'profileLibTblCesStatusType' ,'profileLibTblAppAuthority' ,'cesno'));
    }

    public function store(Request $request, $cesno)
    {
        $request->validate([

            'cesstat_code' => [Rule::unique('profile_tblCESstatus')->where('cesno', $cesno)],
            'acc_code' => ['required'],
            'type_code' => ['required'],
            'official_code' => ['nullable'],
            'resolution_no' => ['required'],
            'appointed_dt' => ['required'],
            
        ]);
            
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $profileTblCesStatus = new ProfileTblCesStatus([

            'cesstat_code' => $request->cesstat_code,
            'acc_code' => $request->acc_code,
            'type_code' => $request->type_code,
            'official_code' => $request->official_code,
            'resolution_no' => $request->resolution_no,
            'appointed_dt' => $request->appointed_dt,
            'encoder' =>  $encoder,

        ]);
    
        $personalData = PersonalData::find($cesno);
        
        $personalData->ProfileTblCesStatus()->save($profileTblCesStatus);

        return to_route('eligibility-rank-tracker.index', ['cesno'=>$cesno])->with('message', 'Save Sucessfully');
    }

    public function edit($ctrlno, $cesno)
    {
       $profileTblCesStatus = ProfileTblCesStatus::find($ctrlno);
       $profileLibTblCesStatus = ProfileLibTblCesStatus::all();
       $profileLibTblCesStatusAcc =  ProfileLibTblCesStatusAcc::all();
       $profileLibTblCesStatusType = ProfileLibTblCesStatusType::all();
       $profileLibTblAppAuthority = ProfileLibTblAppAuthority::all();

       return view('admin.201_profiling.view_profile.partials.eligibility_and_rank_tracker.edit', 
       compact('profileLibTblCesStatus', 'profileLibTblCesStatusAcc', 'profileLibTblCesStatusType', 
       'profileLibTblAppAuthority', 'profileTblCesStatus', 'cesno'));
    }

    public function update(Request $request, $ctrlno, $cesno)
    {
        $request->validate([

            'cesstat_code' => [Rule::unique('profile_tblCESstatus')->where('cesno', $cesno)->ignore($ctrlno, 'ctrlno')],
            'acc_code' => ['required'],
            'type_code' => ['required'],
            'official_code' => ['nullable'],
            'resolution_no' => ['required'],
            'appointed_dt' => ['required'],
            
        ]);

        $profileTblCesStatus = ProfileTblCesStatus::find($ctrlno);
        $profileTblCesStatus->cesstat_code = $request->cesstat_code;
        $profileTblCesStatus->acc_code = $request->acc_code;
        $profileTblCesStatus->type_code = $request->type_code;
        $profileTblCesStatus->official_code = $request->official_code;
        $profileTblCesStatus->resolution_no = $request->resolution_no;
        $profileTblCesStatus->appointed_dt = $request->appointed_dt;
        $profileTblCesStatus->save();

        return to_route('eligibility-rank-tracker.index', ['cesno'=>$cesno])->with('message', 'Update Sucessfully');
    }

    public function destroy($ctrlno)
    {
        $profileTblCesStatus = ProfileTblCesStatus::find($ctrlno);
        $profileTblCesStatus->delete();

        return back()->with('message', 'Deleted Sucessfully');
    }

    public function recentlyDeleted($cesno)
    {
        //parent model
        $personalData = PersonalData::withTrashed()->find($cesno);

        // Access the soft deleted scholarships of the parent model
        $profileTblCesStatusTrashedRecord = $personalData->profileTblCesStatus()->onlyTrashed()->get();
 
        return view('admin.201_profiling.view_profile.partials.eligibility_and_rank_tracker.trashbin', compact('profileTblCesStatusTrashedRecord', 'cesno'));
    }

    public function restore($ctrlno)
    {
        $profileTblCesStatus = ProfileTblCesStatus::withTrashed()->find($ctrlno);
        $profileTblCesStatus->restore();

        return back()->with('message', 'Data Restored Sucessfully');
    }
 
    public function forceDelete($ctrlno)
    {
        $profileTblCesStatus = ProfileTblCesStatus::withTrashed()->find($ctrlno);
        $profileTblCesStatus->forceDelete();
  
        return back()->with('message', 'Data Permanently Deleted');
    }
}
