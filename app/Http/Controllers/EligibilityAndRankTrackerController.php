<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use App\Models\ProfileLibTblAppAuthority;
use App\Models\ProfileLibTblCesStatus;
use App\Models\ProfileLibTblCesStatusAcc;
use App\Models\ProfileLibTblCesStatusType;
use Illuminate\Http\Request;

class EligibilityAndRankTrackerController extends Controller
{
    public function store(Request $request, $cesno){

    //any personal data we want to find
    $personalData = PersonalData::find($cesno);  

    //any ProfileLibTblCesStatus we want to find
    $profileLibTblCesStatus = $request->ces_status_code;
    $cesstat_code = ProfileLibTblCesStatus::find($profileLibTblCesStatus);
    
    //any ProfileLibTblCesStatusAcc we want to find
    $profileLibTblCesStatusAcc = $request->acc_code;
    $acc_code = ProfileLibTblCesStatusAcc::find($profileLibTblCesStatusAcc);

    //any ProfileLibTblCesStatusType we want to find
    $profileLibTblCesStatusType = $request->type_code;
    $type_code = ProfileLibTblCesStatusType::find($profileLibTblCesStatusType);

    //any ProfileLibTblAppAuthority we want to find
    $profileLibTblAppAuthority = $request->official_code;
    $official_code = ProfileLibTblAppAuthority::find($profileLibTblAppAuthority);
    
    $personalData->cesStatusCode()->attach($cesstat_code, ['acc_code'=>$acc_code->code,
    'type_code'=>$type_code->code, 'official_code'=>$official_code->code, 
    'resolution_no'=>$request->resolution_no, 'appointed_dt'=>$request->appointed_dt]); 

    return back()->with('message', 'Save Sucessfully');

    }

    public function detach($cesno,$cesstat_code,$acc_code,$type_code,$official_code){

        $personalDataId = PersonalData::find($cesno);
        $profileLibTblCesStatusId = ProfileLibTblCesStatus::find($cesstat_code);
        $profileLibTblCesStatusAccId = ProfileLibTblCesStatusAcc::find($acc_code);
        $profileLibTblCesStatusTypeId = ProfileLibTblCesStatusType::find($type_code);
        $profileLibTblAppAuthorityId = ProfileLibTblAppAuthority::find($official_code);
   
        $personalDataId->cesStatusCode()->detach($profileLibTblCesStatusId);
        $personalDataId->cesStatusAccCode()->detach($profileLibTblCesStatusAccId);
        $personalDataId->cesStatusTypeCode()->detach($profileLibTblCesStatusTypeId);
        $personalDataId->appointingAuthority()->detach($profileLibTblAppAuthorityId);

        return back()->with('message', 'Deleted Sucessfully');

    }

}
