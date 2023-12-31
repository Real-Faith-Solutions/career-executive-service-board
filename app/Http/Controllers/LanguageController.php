<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use App\Models\ProfileLibTblLanguageRef;
use App\Models\ProfileTblLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class LanguageController extends Controller
{
    public function index($cesno)
    {
        $personalDataId = PersonalData::find($cesno);
        $language = $personalDataId->languages()
        ->select('ctrlno', 'lang_code')
        ->orderBy('encdate', 'desc')
        ->paginate(25);

        $profileLibTblLanguageRef = ProfileLibTblLanguageRef::all();

        return view('admin.201_profiling.view_profile.partials.languages_dialects.table', compact('profileLibTblLanguageRef', 'language', 'cesno'));
    }
    
    public function store(Request $request, $cesno)
    {
        $request->validate([
            'lang_code' => [Rule::unique('profile_tblLanguages')->where('cesno', $cesno), 'required'],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName(); 

        $profileTblLanguages = new ProfileTblLanguage([

            'lang_code' => $request->lang_code,
            'encoder' =>  $encoder,

        ]);
    
        $personalData = PersonalData::find($cesno);
        
        $personalData->languages()->save($profileTblLanguages);
            
        return redirect()->back()->with('message', 'Successfuly Saved');
    }

    public function edit($ctrlno, $cesno)
    {
        $profileTblLanguages = ProfileTblLanguage::find($ctrlno);

        $profileLibTblLanguageRef = ProfileLibTblLanguageRef::all();

        return view('admin.201_profiling.view_profile.partials.languages_dialects.edit', compact('profileLibTblLanguageRef', 'profileTblLanguages', 'cesno'));
    }

    public function update(Request $request, $cesno, $ctrlno)
    {
        $request->validate([
            'lang_code' => ['required', Rule::unique('profile_tblLanguages')->where('cesno', $cesno)->ignore($ctrlno, 'ctrlno')],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName(); 

        $profileTblLanguages = ProfileTblLanguage::find($ctrlno);
        $profileTblLanguages->lang_code = $request->lang_code;
        $profileTblLanguages->lastupd_enc = $encoder;
        $profileTblLanguages->save();
     
        return redirect()->route('language.index', ['cesno'=>$cesno])->with('info', 'Updated Sucessfully');
    }

    public function destroy($ctrlno)
    {
        $profileTblLanguages = ProfileTblLanguage::find($ctrlno); 
        $profileTblLanguages->delete();

        return redirect()->back()->with('info', 'Deleted Sucessfully');
    }

    public function recentlyDeleted($cesno)
    {
        //parent model
        $personalData = PersonalData::withTrashed()->find($cesno);

        // Access the soft deleted scholarships of the parent model
        $profileTblLanguagesTrashedRecord = $personalData->languages()
        ->onlyTrashed()
        ->select('ctrlno', 'lang_code', 'deleted_at')
        ->orderBy('deleted_at', 'desc')
        ->paginate(25);

        return view('admin.201_profiling.view_profile.partials.languages_dialects.trashbin', compact('profileTblLanguagesTrashedRecord','cesno'));
    }

    public function restore($ctrlno)
    {
        $profileTblLanguages = ProfileTblLanguage::onlyTrashed()->find($ctrlno); 
        $profileTblLanguages->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }

    public function forceDelete($ctrlno)
    {
        $profileTblLanguages = ProfileTblLanguage::onlyTrashed()->find($ctrlno);
        $profileTblLanguages->forceDelete();
  
        return back()->with('info', 'Data Permanently Deleted');
    }
}
