<?php

namespace App\Http\Controllers;

use App\Models\HealthRecords;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HealthRecordController extends Controller
{
    
    public function store(Request $request, $cesno){

        $userLastName = Auth::user()->last_name;
        $userFirstName = Auth::user()->first_name;
        $userMiddleName = Auth::user()->middle_name; 
        $userNameExtension = Auth::user()->name_extension;

        $healthRecordPersonalDataId = PersonalData::findOrFail($cesno);

        $healthRecords = $healthRecordPersonalDataId->healthRecords()->updateOrCreate(
            ['personal_data_cesno' => $cesno],
            [
                'blood_type' => $request->input('blood_type'),
                'identifying_marks' => $request->input('identifying_marks'),
                'person_with_disability' => $request->input('person_with_disability'),
                'encoder' => $userLastName . ' ' . $userFirstName . ' ' . $userMiddleName . ' ' . $userNameExtension,
            ]
        );
            
        return redirect()->back()->with('message', 'Successfuly Saved');

    }

    public function destroy($ctrlno){
        
        $healthRecord = HealthRecords::find($ctrlno);
        $healthRecord->delete();

        return redirect()->back();

    }

}
