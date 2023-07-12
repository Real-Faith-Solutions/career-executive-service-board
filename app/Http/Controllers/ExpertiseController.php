<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use App\Models\ProfileTblExpertise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpertiseController extends Controller
{

    public function store(Request $request, $cesno){

        $request->validate([

            'expertise_specialization' => ['required'],
           
        ]);

        $userLastName = Auth::user()->last_name;

        $expertise = new ProfileTblExpertise([

            'expertise_specialization' => $request->expertise_specialization,
            'encoder' => $userLastName,
         
        ]);

        $expertisePersonalDataId = PersonalData::find($cesno);

        $expertisePersonalDataId->expertise()->save($expertise);
            
        return redirect()->back()->with('message-expertise', 'Sucessfully Saved');

    }

    public function destroy($ctrlno){
        
        $expertise = ProfileTblExpertise::find($ctrlno);
        $expertise->delete();

        return redirect()->back();

        // $spouse->restore(); -> to restore soft deleted data

    }

}
