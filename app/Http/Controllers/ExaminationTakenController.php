<?php

namespace App\Http\Controllers;

use App\Models\ExaminationsTaken;
use App\Models\PersonalData;
use App\Models\ProfileLibTblExamRef;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ExaminationTakenController extends Controller
{
    
    public function store(Request $request, $cesno){

        $request->validate([

            'type' => ['required', Rule::unique('profile_tblExaminations')->where('personal_data_cesno', $cesno)],
            'rating' => ['required', 'min:2', 'max:40'],
            'date_of_examination' => ['required'],
            'place_of_examination' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'license_number' => ['nullable', 'min:2', 'max:40'],
            'date_acquired' => ['required'],
            'date_validity' => ['required'],
            
        ]);

        $userLastName = Auth::user()->last_name;
        $userFirstName = Auth::user()->first_name;
        $userMiddleName = Auth::user()->middle_name; 
        $userNameExtension = Auth::user()->name_extension;

        $examinationTaken = new ExaminationsTaken([

            'type' => $request->type,
            'rating' => $request->rating,
            'date_of_examination' => $request->date_of_examination,
            'place_of_examination' => $request->place_of_examination,
            'license_number' => $request->license_number,
            'date_acquired' => $request->date_acquired,
            'date_validity' => $request->date_validity,
            'encoder' => $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension,
            
        ]);

        $examinationTakenPersonalDataId = PersonalData::find($cesno);

        $examinationTakenPersonalDataId->examinationTakens()->save($examinationTaken);

        return redirect()->back()->with('message', 'Successfuly Saved');

    }

    public function edit($ctrlno){

        $profileLibTblExamRef = ProfileLibTblExamRef::all();
        $examinationTaken = ExaminationsTaken::find($ctrlno);

        return view('admin.201_profiling.view_profile.partials.examinations_taken.edit', 
        ['examinationTaken'=>$examinationTaken, 'profileLibTblExamRef'=>$profileLibTblExamRef]);

    }

    public function update(Request $request, $ctrlno){

        $request->validate([

            'type' => ['required'],
            'rating' => ['required', 'min:2', 'max:40'],
            'date_of_examination' => ['required'],
            'place_of_examination' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'license_number' => ['nullable', 'min:2', 'max:40'],
            'date_acquired' => ['required'],
            'date_validity' => ['required'],
            
        ]);

        $examinationTaken = ExaminationsTaken::find($ctrlno);
        $examinationTaken->type = $request->type;
        $examinationTaken->rating = $request->rating;
        $examinationTaken->date_of_examination = $request->date_of_examination;
        $examinationTaken->place_of_examination = $request->place_of_examination;
        $examinationTaken->license_number = $request->license_number;
        $examinationTaken->date_validity = $request->date_validity;
        $examinationTaken->save();

        return back()->with('message', 'Updated Sucessfully');

    }

    public function destroy($ctrlno){
        
        $examinationTaken = ExaminationsTaken::find($ctrlno);
        $examinationTaken->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

    }


}
