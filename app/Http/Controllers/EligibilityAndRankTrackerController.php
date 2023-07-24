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
use App\Http\Controllers\refresh;

class EligibilityAndRankTrackerController extends Controller
{
    // const MODULE_201_PROFILING = 'admin.201_profiling';
    
    public function store(Request $request, $cesno){
        
    $userFullName = Auth::user();
    $userLastName = $userFullName ->last_name;
    $userFirstName = $userFullName ->first_name;
    $userMiddleName = $userFullName ->middle_name;
    $userNameExtension = $userFullName ->name_extension;

    $profileTblCesStatus = new ProfileTblCesStatus([

        'cesstat_code' => $request->cesstat_code,
        'acc_code' => $request->acc_code,
        'type_code' => $request->type_code,
        'official_code' => $request->official_code,
        'resolution_no' => $request->resolution_no,
        'appointed_dt' => $request->appointed_dt,
        'encoder' => $request->$userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension,

    ]);
 
    $personalData = PersonalData::find($cesno);
    
    $personalData->ProfileTblCesStatus()->save($profileTblCesStatus);

    return back()->with('message', 'Save Sucessfully');

    }

    public function edit($ctrlno){

       $profileTblCesStatus = ProfileTblCesStatus::find($ctrlno);
       $profileLibTblCesStatus = ProfileLibTblCesStatus::all();
       $profileLibTblCesStatusAcc =  ProfileLibTblCesStatusAcc::all();
       $profileLibTblCesStatusType = ProfileLibTblCesStatusType::all();
       $profileLibTblAppAuthority = ProfileLibTblAppAuthority::all();

       return view('admin.201_profiling.view_profile.partials.eligibility_and_rank_tracker.edit', 
       compact('profileLibTblCesStatus', 'profileLibTblCesStatusAcc', 'profileLibTblCesStatusType', 'profileLibTblAppAuthority', 'profileTblCesStatus'));

    }

    public function update(Request $request, $ctrlno){

        $profileTblCesStatus = ProfileTblCesStatus::find($ctrlno);
        $profileTblCesStatus->cesstat_code = $request->cesstat_code;
        $profileTblCesStatus->acc_code = $request->acc_code;
        $profileTblCesStatus->type_code = $request->type_code;
        $profileTblCesStatus->official_code = $request->official_code;
        $profileTblCesStatus->resolution_no = $request->resolution_no;
        $profileTblCesStatus->appointed_dt = $request->appointed_dt;
        $profileTblCesStatus->save();

        return back()->with('message', 'Update Sucessfully');

    }

    public function destroy($ctrlno){

        $profileTblCesStatus = ProfileTblCesStatus::find($ctrlno);
        $profileTblCesStatus->delete();

        return back()->with('message', 'Deleted Sucessfully');

    }

}
