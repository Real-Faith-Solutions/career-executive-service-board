<?php

namespace App\Http\Controllers;

use App\Models\Identification;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdentificationController extends Controller
{

    public function store(Request $request, $cesno){

        $request->validate([

            'type' => ['required'],
            'identification_id' => ['required', 'min:2', 'max:40'],
            
        ]);

        $userLastName = Auth::user()->last_name;
        $userFirstName = Auth::user()->first_name;
        $userMiddleName = Auth::user()->middle_name; 
        $userNameExtension = Auth::user()->name_extension;

        $identification = new Identification([

            'type' => $request->type,
            'id_number' => $request->identification_id,
            'encoder' => $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension,
         
        ]);

        $identificationsPersonalDataId = PersonalData::find($cesno);

        $identificationsPersonalDataId->identifications()->save($identification);

        return redirect()->back()->with('message', 'Successfuly Saved');

    }

    public function destroyIdentification($ctrlno){
        
        $spouse = Identification::find($ctrlno);
        $spouse->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

        // $spouse->restore(); -> to restore soft deleted data

    }

}
