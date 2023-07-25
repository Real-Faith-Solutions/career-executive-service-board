<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use App\Models\ProfileLibTblExpertiseSpec;
use App\Models\ProfileTblExpertise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;

class ExpertiseController extends Controller
{

    public function store(Request $request, $cesno){

        $request->validate([

            'specialization_code' => [Rule::unique('profile_tblExpertise')->where('personal_data_cesno', $cesno), 'required'],
           
        ]);

        $userFullName = Auth::user();
        $userLastName = $userFullName ->last_name;
        $userFirstName = $userFullName ->first_name;
        $userMiddleName = $userFullName ->middle_name;
        $userNameExtension = $userFullName ->name_extension;

        $speXpCode = $request->specialization_code;
            
        $expertise = PersonalData::find($cesno);

        $expertiseLibrary = ProfileLibTblExpertiseSpec::find($speXpCode);
 
        $expertise->expertise()->attach($expertiseLibrary,['encoder'=>$userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension]);
            
        return redirect()->back()->with('message', 'Expertise Successfuly Saved');

    }

    public function edit($cesno, $speXpCode){
    
        $personalDataId = PersonalData::find($cesno);
        $speXpCodes = $personalDataId->expertise()->where('specialization_code', $speXpCode)->value('specialization_code');
        // dd($speXpCodes);

        $profileLibTblExpertiseSpec = ProfileLibTblExpertiseSpec::all();
        return view('admin.201_profiling.view_profile.partials.field_expertise.edit',compact('cesno', 'profileLibTblExpertiseSpec', 'speXpCodes'));

    }

    public function update(Request $request, $cesno, $speXpCodes){

        $personalDataId = PersonalData::find($cesno);

        $speXpCode = ProfileLibTblExpertiseSpec::find($speXpCodes);
 
        $personalDataId->expertise()->updateExistingPivot($speXpCode, 
        ['specialization_code' => $request->specialization_code,]);
     
        return redirect()->route('viewProfile', ['cesno' => $personalDataId])->with('message', 'Updated Sucessfully');

    }

    public function destroy($cesno, $speXpCode){
        
        $personalData = PersonalData::find($cesno);
 
        $personalData->expertise()->detach($speXpCode);

        return redirect()->back()->with('message', 'Deleted Sucessfully');

        // $spouse->restore(); -> to restore soft deleted data

    }

}
