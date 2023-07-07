<?php

namespace App\Http\Controllers;

use App\Models\Identification;
use App\Models\PersonalData;
use Illuminate\Http\Request;

class IdentificationController extends Controller
{

    public function store(Request $request, $cesno){

        $identification = new Identification([

            'type' => $request->type,
            'id_number' => $request->identification_id,
            'encoder' => 'sample encoder',
         
        ]);

        $identificationsPersonalDataId = PersonalData::find($cesno);

        $identificationsPersonalDataId->identifications()->save($identification);

        return redirect()->back();

    }

    public function destroyIdentification($ctrlno){
        
        $spouse = Identification::find($ctrlno);
        $spouse->delete();

        return redirect()->back();

        // $spouse->restore(); -> to restore soft deleted data

    }

}
