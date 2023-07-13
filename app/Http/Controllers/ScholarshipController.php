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

        $userName = Auth::user()->last_name;

        $scholarship = new Scholarships([

            'type' => $request->type,
            'title' => $request->title,
            'sponsor' => $request->sponsor,
            'inclusive_date_from' => $request->inclusive_date_from,
            'inclusive_date_to' => $request->inclusive_date_to,
            'encoder' => $userName,
         
        ]);

        $scholarshipPersonalDataId = PersonalData::find($cesno);

        $scholarshipPersonalDataId->scholarships()->save($scholarship);

        return redirect()->back()->with('message', 'Successfuly Saved');

    }

    public function destroy($ctrlno){
        
        $scholarship = Scholarships::find($ctrlno);
        $scholarship->delete();

        return redirect()->back();

        // $spouse->restore(); -> to restore soft deleted data

    }
    
}
