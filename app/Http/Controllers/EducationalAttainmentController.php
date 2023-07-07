<?php

namespace App\Http\Controllers;

use App\Models\EducationalAttainment;
use App\Models\PersonalData;
use Illuminate\Http\Request;

class EducationalAttainmentController extends Controller
{

    public function storeEducationAttainment(Request $request, $cesno){

        $educationalAttainment = new EducationalAttainment([
    
            'level' => $request->level,
            'school' => $request->school,
            'degree' => $request->degree,
            'school_type' => $request->school_type,
            'period_of_attendance_from' => $request->period_of_attendance_from,
            'period_of_attendance_to' => $request->period_of_attendance_to,
            'highest_level' => $request->highest_level,
            'year_graduate' => $request->year_graduate,
            'academics_honor_received' => $request->academics_honor_received,
            'encoder' => 'sample encoder',
                
        ]);
    
        $educationalAttainmentPersonalDataId = PersonalData::find($cesno);
    
        $educationalAttainmentPersonalDataId->educations()->save($educationalAttainment);
    
        return redirect()->back();
    
    }
    
    public function destroyEducationalAttainment($ctrlno){
        
        $educationalAttainment = EducationalAttainment::find($ctrlno);
        $educationalAttainment->delete();

        return redirect()->back();

        // $spouse->restore(); -> to restore soft deleted data

    }

}
