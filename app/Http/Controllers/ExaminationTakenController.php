<?php

namespace App\Http\Controllers;

use App\Models\ExaminationsTaken;
use App\Models\PersonalData;
use Illuminate\Http\Request;

class ExaminationTakenController extends Controller
{
    
    public function store(Request $request, $cesno){

        $examinationTaken = new ExaminationsTaken([

            'type' => $request->type,
            'rating' => $request->rating,
            'date_of_examination' => $request->date_of_examination,
            'place_of_examination' => $request->place_of_examination,
            'license_number' => $request->license_number,
            'date_acquired' => $request->date_acquired,
            'date_validity' => $request->date_validity,
            'encoder' => 'sample encoder',
            
        ]);

        $examinationTakenPersonalDataId = PersonalData::find($cesno);

        $examinationTakenPersonalDataId->examinationTakens()->save($examinationTaken);

        return redirect()->back();

    }

    public function destroy($ctrlno){
        
        $examinationTaken = ExaminationsTaken::find($ctrlno);
        $examinationTaken->delete();

        return redirect()->back();

    }


}
