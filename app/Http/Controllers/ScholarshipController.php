<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScholarshipStoreRequest;
use App\Models\PersonalData;
use App\Models\Scholarships;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScholarshipController extends Controller
{

    public function store(ScholarshipStoreRequest $request, $cesno){

        $userLastName = Auth::user()->last_name;
        $userFirstName = Auth::user()->first_name;
        $userMiddleName = Auth::user()->middle_name; 
        $userNameExtension = Auth::user()->name_extension;

        $scholarship = new Scholarships([

            'type' => $request->type,
            'title' => $request->title,
            'sponsor' => $request->sponsor,
            'inclusive_date_from' => $request->inclusive_date_from,
            'inclusive_date_to' => $request->inclusive_date_to,
            'encoder' => $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension,
         
        ]);

        $scholarshipPersonalDataId = PersonalData::find($cesno);

        $scholarshipPersonalDataId->scholarships()->save($scholarship);

        return redirect()->back()->with('message', 'Successfuly Saved');

    }

    public function destroy($ctrlno){
        
        $scholarship = Scholarships::find($ctrlno);
        $scholarship->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

        // $spouse->restore(); -> to restore soft deleted data

    }
    
}
