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

    public function index($cesno){

        $personalDataId = PersonalData::find($cesno);
        $language = $personalDataId->languages;
        $profileLibTblLanguageRef = ProfileLibTblLanguageRef::all();

        return view('admin.201_profiling.view_profile.partials.languages_dialects.table', compact('profileLibTblLanguageRef', 'language', 'cesno'));

    }
    
    public function store(Request $request, $cesno){

        $request->validate([

            'language_code' => [Rule::unique('profile_tblLanguages')->where('personal_data_cesno', $cesno), 'required'],

        ]);

        $userFullName = Auth::user();
        $userLastName = $userFullName ->last_name;
        $userFirstName = $userFullName ->first_name;
        $userMiddleName = $userFullName ->middle_name;
        $userNameExtension = $userFullName ->name_extension;

        $language_codes = $request->language_code;
            
        $languagePersonalDataId = PersonalData::find($cesno);

        $languageCode = ProfileLibTblLanguageRef::find($language_codes);
 
        $languagePersonalDataId->languages()->attach($languageCode,['encoder'=>$userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension]);
            
        return redirect()->back()->with('message', 'Successfuly Saved');

    }

    public function edit($cesno, $language_code, $ctrlno){

        $personalDataId = PersonalData::find($cesno);
        $languageId = $personalDataId->languages()->where('code', $language_code)->value('code');

        $profileLibTblLanguageRef = ProfileLibTblLanguageRef::all();

        return view('admin.201_profiling.view_profile.partials.languages_dialects.edit', compact('profileLibTblLanguageRef', 'languageId', 'cesno', 'ctrlno'));

    }

    public function update(Request $request, $cesno, $language_code, $ctrlno){

        $request->validate([

            'language_code' => ['required', Rule::unique('profile_tblLanguages')->where('personal_data_cesno', $cesno)->ignore($ctrlno, 'ctrlno')],

        ]);

        $personalDataId = PersonalData::find($cesno);

        $languageId = ProfileLibTblLanguageRef::find($language_code);
 
        $personalDataId->languages()->updateExistingPivot($languageId,['language_code' => $request->language_code,]);
     
        return redirect()->route('language.index', ['cesno'=>$cesno])->with('info', 'Updated Sucessfully');
 
    }

    public function destroy($cesno, $languageCode){
        
        $personalData = PersonalData::find($cesno);

        $languageId = ProfileLibTblLanguageRef::find($languageCode);
 
        $personalData->languages()->detach($languageId);

        return redirect()->back()->with('info', 'Deleted Sucessfully');

        // $spouse->restore(); -> to restore soft deleted data

    }

}
