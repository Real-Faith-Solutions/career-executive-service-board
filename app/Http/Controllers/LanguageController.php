<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use App\Models\ProfileTblLanguages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    
    public function store(Request $request, $cesno){

        $request->validate([

            'language_dialect' => ['required'],

        ]);

        $userLastName = Auth::user()->last_name; 
        $userFirstName = Auth::user()->first_name;
        $userMiddleName = Auth::user()->middle_name; 
        $userNameExtension = Auth::user()->name_extension;

        $language = new ProfileTblLanguages([

            'language_description' => $request->language_dialect,
            'encoder' => $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension,
         
        ]);

        $languagePersonalDataId = PersonalData::find($cesno);

        $languagePersonalDataId->languages()->save($language);
            
        return redirect()->back()->with('message', 'Successfuly Saved');

    }

    public function destroy($ctrlno){
        
        $language = ProfileTblLanguages::find($ctrlno);
        $language->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

        // $spouse->restore(); -> to restore soft deleted data

    }

}
