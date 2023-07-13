<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use App\Models\ProfileTblTrainingMngt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtherTrainingController extends Controller
{
    
    public function store(Request $request, $cesno){

        $request->validate([ 

            'training_title' => ['required'],
            'training_category' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'sponsor_training_provider' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'venue' => ['required', 'min:2', 'max:40'],
            'no_of_training_hours' => ['required', 'numeric'],
            'inclusive_date_from' => ['required'],
            'inclusive_date_to' => ['required'],
            'expertise_field_of_specialization' => ['required'],
            
        ]);

        $userLastName = Auth::user()->last_name;
        $userFirstName = Auth::user()->first_name;
        $userMiddleName = Auth::user()->middle_name; 
        $userNameExtension = Auth::user()->name_extension;

        $otherTraining = new ProfileTblTrainingMngt([

            'training' => $request->training_title,
            'training_category' => $request->training_category,
            'sponsor' => $request->sponsor_training_provider,
            'venue' => $request->venue,
            'no_training_hours' => $request->no_of_training_hours,
            'from_date' => $request->inclusive_date_from,
            'to_date' => $request->inclusive_date_to,
            'field_specialization' => $request->expertise_field_of_specialization,
            'encoder' => $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension,
         
        ]);

        $otherTrainingPersonalDataId = PersonalData::find($cesno);

        $otherTrainingPersonalDataId->otherTraining()->save($otherTraining);
            
        return redirect()->back()->with('message', 'Successfuly Saved');

    }

    public function destroy($ctrlno){
        
        $otherTraining = ProfileTblTrainingMngt::find($ctrlno);
        $otherTraining->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

        // $spouse->restore(); -> to restore soft deleted data

    }

}
