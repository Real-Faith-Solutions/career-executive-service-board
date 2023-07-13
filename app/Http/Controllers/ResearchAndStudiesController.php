<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResearchAndStudiesStoreRequest;
use App\Models\PersonalData;
use App\Models\ResearchAndStudies;
use Illuminate\Support\Facades\Auth;

class ResearchAndStudiesController extends Controller
{
    
    public function store(ResearchAndStudiesStoreRequest $request, $cesno){

        $userLastName = Auth::user()->last_name;

        $researchAndStudies = new ResearchAndStudies([

            'title' => $request->title,
            'publisher' => $request->publisher,
            'inclusive_date_from' => $request->inclusive_date_from,
            'inclusive_date_to' => $request->inclusive_date_to,
            'encoder' => $userLastName,
         
        ]);

        $researchAndStudiesPersonalDataId = PersonalData::find($cesno);

        $researchAndStudiesPersonalDataId->researchAndStudies()->save($researchAndStudies);

        return redirect()->back()->with('message', 'Successfuly Saved');

    }

    public function destroy($ctrlno){
        
        $researchAndStudies = ResearchAndStudies::find($ctrlno);
        $researchAndStudies->delete();

        return redirect()->back();

        // $spouse->restore(); -> to restore soft deleted data

    }

}
