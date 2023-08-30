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
    public function index($cesno)
    {
        $personalData = PersonalData::find($cesno);
        $expertise = $personalData->expertise;

        return view('admin.201_profiling.view_profile.partials.field_expertise.table', compact('expertise' ,'cesno'));
    }

    public function create($cesno)
    {
        $profileLibTblExpertiseSpec = ProfileLibTblExpertiseSpec::all();

        return view('admin.201_profiling.view_profile.partials.field_expertise.form', compact('profileLibTblExpertiseSpec' ,'cesno'));
    }

    public function store(Request $request, $cesno)
    {
        $request->validate([
            'specialization_code' => [Rule::unique('profile_tblExpertise')->where('personal_data_cesno', $cesno), 'required'],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $profileTblExpertise = new ProfileTblExpertise([

            'specialization_code' => $request->specialization_code,
            'encoder' =>  $encoder,

        ]);
    
        $personalData = PersonalData::find($cesno);
        
        $personalData->expertise()->save($profileTblExpertise);
            
        return to_route('expertise.index', ['cesno'=>$cesno])->with('message', 'Expertise Successfuly Saved');
    }

    public function edit($cesno,$ctrlno)
    {
        $profileTblExpertise = ProfileTblExpertise::find($ctrlno);
        
        $profileLibTblExpertiseSpec = ProfileLibTblExpertiseSpec::all();
        
        return view('admin.201_profiling.view_profile.partials.field_expertise.edit',compact('cesno', 'profileLibTblExpertiseSpec', 'profileTblExpertise'));
    }

    public function update(Request $request, $cesno, $speXpCodes, $ctrlno)
    {
        $request->validate([
            'specialization_code' => [Rule::unique('profile_tblExpertise')->where('personal_data_cesno', $cesno)->ignore($ctrlno, 'ctrlno'), 'required'],
        ]);

        $personalDataId = PersonalData::find($cesno);

        $speXpCode = ProfileLibTblExpertiseSpec::find($speXpCodes);

        $personalDataId->expertise()->updateExistingPivot($speXpCode,['specialization_code' => $request->specialization_code,]);
     
        return to_route('expertise.index', ['cesno'=>$cesno])->with('message', 'Updated Sucessfully');
    }

    public function destroy($cesno, $ctrlno, $speXpCode)
    {
        $personalData = PersonalData::find($cesno);
 
        $personalData->expertise()->detach($speXpCode);

        return redirect()->back()->with('message', 'Deleted Sucessfully');
    }
}
