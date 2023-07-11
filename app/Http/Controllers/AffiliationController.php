<?php

namespace App\Http\Controllers;

use App\Models\Affiliations;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AffiliationController extends Controller
{
    
    public function store(Request $request, $cesno){

        $request->validate([

            'organization' => ['required','max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'position' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'from_dt' => ['required'],
            'to_dt' => ['required'],

        ]);

        $userLastName = Auth::user()->last_name;

        $affiliation = new Affiliations([
    
            'organization' => $request->title_of_award,
            'position' => $request->sponsor,
            'from_dt' => $request->date_from,
            'to_dt' => $request->date_to,
            'encoder' => $userLastName,
             
        ]);
    
        $affiliationPersonalDataId = PersonalData::find($cesno);
    
        $affiliationPersonalDataId->affiliations()->save($affiliation);
            
        return redirect()->back();

    }

    public function destroy($ctrlno){
        
        $affiliation = Affiliations::find($ctrlno);
        $affiliation->delete();

        return redirect()->back();

        // $spouse->restore(); -> to restore soft deleted data

    }

}
