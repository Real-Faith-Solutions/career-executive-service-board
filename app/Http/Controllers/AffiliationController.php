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
            'date_from' => ['required'],
            'date_to' => ['required'],

        ]);

        $userLastName = Auth::user()->last_name;
        $userFirstName = Auth::user()->first_name;
        $userMiddleName = Auth::user()->middle_name; 
        $userNameExtension = Auth::user()->name_extension;

        $affiliation = new Affiliations([
    
            'organization' => $request->organization,
            'position' => $request->position,
            'from_dt' => $request->date_from,
            'to_dt' => $request->date_to,
            'encoder' => $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension,
             
        ]);
    
        $affiliationPersonalDataId = PersonalData::find($cesno);
    
        $affiliationPersonalDataId->affiliations()->save($affiliation);
            
        return redirect()->back()->with('message', 'Successfuly Saved');

    }

    public function edit($ctrlno){

        $affiliation = Affiliations::find($ctrlno);

        return view('admin.201_profiling.view_profile.partials.major_civic_and_professional_affiliations.edit', ['affiliation'=>$affiliation]);

    }

    public function update(Request $request, $ctrlno){

        $request->validate([

            'organization' => ['required','max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'position' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'date_from' => ['required'],
            'date_to' => ['required'],

        ]);

        $userLastName = Auth::user()->last_name;
        $userFirstName = Auth::user()->first_name;
        $userMiddleName = Auth::user()->middle_name; 
        $userNameExtension = Auth::user()->name_extension;

        $affiliation = Affiliations::find($ctrlno);
        $affiliation->organization = $request->organization;
        $affiliation->position = $request->position;
        $affiliation->from_dt = $request->date_from;
        $affiliation->to_dt = $request->date_to;
        $affiliation->updated_by = $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension;
        $affiliation->save();

        return back()->with('message', 'Updated Sucessfully');

    }

    public function destroy($ctrlno){
        
        $affiliation = Affiliations::find($ctrlno);
        $affiliation->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

        // $spouse->restore(); -> to restore soft deleted data

    }

}
