<?php

namespace App\Http\Controllers;

use App\Models\HealthRecords;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HealthRecordController extends Controller
{
    
    public function store(Request $request, $cesno){

        $userlastName = Auth::user()->last_name;

        $healthRecord = new HealthRecords([

            'blood_type' => $request->blood_type,
            'marks' => $request->identifying_marks,
            'handicap' => $request->disability_handicap_defects, 
            'disability_handicap_defects_specify' => $request->disability_handicap_defects_specify,
            'illness' => $request->medical_condition_illness,
            'illness_date' => $request->date,
            'encoder' => $userlastName,
         
        ]);

        $healthRecordPersonalDataId = PersonalData::find($cesno);
        
        $healthRecordPersonalDataId->healthRecords()->save($healthRecord);
            
        return redirect()->back();

    }

    public function destroy($ctrlno){
        
        $healthRecord = HealthRecords::find($ctrlno);
        $healthRecord->delete();

        return redirect()->back();

        // $spouse->restore(); -> to restore soft deleted data

    }

}
