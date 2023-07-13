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

            'title_of_award' => ['required','max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'sponsor' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'date_from' => ['required'],
            'date_to' => ['required'],

        ]);

        $userLastName = Auth::user()->last_name;
        $userFirstName = Auth::user()->first_name;
        $userMiddleName = Auth::user()->middle_name; 
        $userNameExtension = Auth::user()->name_extension;

        $affiliation = new Affiliations([
    
            'organization' => $request->title_of_award,
            'position' => $request->sponsor,
            'from_dt' => $request->date_from,
            'to_dt' => $request->date_to,
            'encoder' => $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension,
             
        ]);
    
        $affiliationPersonalDataId = PersonalData::find($cesno);
    
        $affiliationPersonalDataId->affiliations()->save($affiliation);
            
        return redirect()->back()->with('message', 'Successfuly Saved');

    }

    public function destroy($ctrlno){
        
        $affiliation = Affiliations::find($ctrlno);
        $affiliation->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

        // $spouse->restore(); -> to restore soft deleted data

    }

}
