<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use App\Models\ProfileLibTblLanguageRef;
use App\Models\ProfileTblLanguages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class LanguageController extends Controller
{
    public function index($cesno)
    {
        $personalDataId = PersonalData::find($cesno);
        $language = $personalDataId->languages;

        $profileLibTblLanguageRef = ProfileLibTblLanguageRef::all();

        return view('admin.201_profiling.view_profile.partials.languages_dialects.table', compact('profileLibTblLanguageRef', 'language', 'cesno'));
    }
    
    public function store(Request $request, $cesno)
    {
        $request->validate([
            'language_code' => [Rule::unique('profile_tblLanguages')->where('personal_data_cesno', $cesno), 'required'],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName(); 

        $profileTblLanguages = new ProfileTblLanguages([

            'language_code' => $request->language_code,
            'encoder' =>  $encoder,

        ]);
    
        $personalData = PersonalData::find($cesno);
        
        $personalData->languages()->save($profileTblLanguages);
            
        return redirect()->back()->with('message', 'Successfuly Saved');
    }

    public function edit($ctrlno, $cesno)
    {
        $profileTblLanguages = ProfileTblLanguages::find($ctrlno);

        $profileLibTblLanguageRef = ProfileLibTblLanguageRef::all();

        return view('admin.201_profiling.view_profile.partials.languages_dialects.edit', compact('profileLibTblLanguageRef', 'profileTblLanguages', 'cesno'));
    }

    public function update(Request $request, $cesno, $ctrlno)
    {
        $request->validate([
            'language_code' => ['required', Rule::unique('profile_tblLanguages')->where('personal_data_cesno', $cesno)->ignore($ctrlno, 'ctrlno')],
        ]);

        $profileTblLanguages = ProfileTblLanguages::find($ctrlno);
        $profileTblLanguages->language_code = $request->language_code;
        $profileTblLanguages->save();
     
        return redirect()->route('language.index', ['cesno'=>$cesno])->with('info', 'Updated Sucessfully');
    }

    public function destroy($cesno, $languageCode)
    {
        $personalData = PersonalData::find($cesno);

        $languageId = ProfileLibTblLanguageRef::find($languageCode);
 
        $personalData->languages()->detach($languageId);

        return redirect()->back()->with('info', 'Deleted Sucessfully');
    }
}
