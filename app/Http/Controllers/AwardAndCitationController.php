<?php

namespace App\Http\Controllers;

use App\Models\AwardAndCitations;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AwardAndCitationController extends Controller
{
    
    public function store(Request $request, $cesno){

        $request->validate([

            'title_of_award' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'sponsor' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'date' => ['required'],
            
        ]);

        $userLastName = Auth::user()->last_name;
        $userFirstName = Auth::user()->first_name;
        $userMiddleName = Auth::user()->middle_name; 
        $userNameExtension = Auth::user()->name_extension;

        $awardAndCitations = new AwardAndCitations([

            'awards' => $request->title_of_award,
            'sponsor' => $request->sponsor,
            'date' => $request->date,
            'encoder' => $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension,
         
        ]);

        $awardAndCitationsPersonalDataId = PersonalData::find($cesno);
            
        $awardAndCitationsPersonalDataId->awardsAndCitations()->save($awardAndCitations);
            
        return redirect()->back()->with('message', 'Successfuly Saved');

    }

    public function destroy($ctrlno){
        
        $awardAndCitations = AwardAndCitations::find($ctrlno);
        $awardAndCitations->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

        // $spouse->restore(); -> to restore soft deleted data

    }

}
