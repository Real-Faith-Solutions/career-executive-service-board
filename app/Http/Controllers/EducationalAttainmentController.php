<?php

namespace App\Http\Controllers;

use App\Http\Requests\EducationalAttainmentStoreRequest;
use App\Models\EducationalAttainment;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationalAttainmentController extends Controller
{

    public function storeEducationAttainment(EducationalAttainmentStoreRequest $request, $cesno){

        $userLastName = Auth::user()->last_name;
        $userFirstName = Auth::user()->first_name;
        $userMiddleName = Auth::user()->middle_name; 
        $userNameExtension = Auth::user()->name_extension;
        $educationalAttainment = new EducationalAttainment([
    
            'level' => $request->level,
            'school' => $request->school,
            'specialization' => $request->specialization,
            'degree' => $request->degree,
            'school_type' => $request->school_type,
            'period_of_attendance_from' => $request->period_of_attendance_from,
            'period_of_attendance_to' => $request->period_of_attendance_to,
            'highest_level' => $request->highest_level,
            'year_graduate' => $request->year_graduate,
            'academics_honor_received' => $request->academics_honor_received,
            'encoder' => $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension,
                
        ]);
    
        $educationalAttainmentPersonalDataId = PersonalData::find($cesno);
    
        $educationalAttainmentPersonalDataId->educations()->save($educationalAttainment);
    
        return redirect()->back()->with('message', 'Successfuly Saved');
    
    }
    
    public function destroyEducationalAttainment($ctrlno){
        
        $educationalAttainment = EducationalAttainment::find($ctrlno);
        $educationalAttainment->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

        // $spouse->restore(); -> to restore soft deleted data

    }

}
