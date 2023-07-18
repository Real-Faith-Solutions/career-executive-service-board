<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use App\Models\ProfileLibTblExpertiseSpec;
use App\Models\ProfileTblExpertise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ExpertiseController extends Controller
{

    public function store(Request $request, $cesno){

        $request->validate([

            'expertise_specialization' => ['required', Rule::unique('profile_tblExpertise')->where('personal_data_cesno', $cesno)],
           
        ]);

        $userLastName = Auth::user()->last_name;
        $userFirstName = Auth::user()->first_name;
        $userMiddleName = Auth::user()->middle_name; 
        $userNameExtension = Auth::user()->name_extension;

        $expertise = new ProfileTblExpertise([

            'expertise_specialization' => $request->expertise_specialization,
            'encoder' => $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension,
         
        ]);

        $expertisePersonalDataId = PersonalData::find($cesno);

        $expertisePersonalDataId->expertise()->save($expertise);
            
        return redirect()->back()->with('message', 'Successfuly Saved');

    }

    public function edit($ctrlno){
        
        $expertise = ProfileTblExpertise::find($ctrlno);
        $profileLibTblExpertiseSpec = ProfileLibTblExpertiseSpec::all();
        
        return view('admin.201_profiling.view_profile.partials.field_expertise.edit', 
        ['expertise'=>$expertise, 'profileLibTblExpertiseSpec'=>$profileLibTblExpertiseSpec]);

    }

    public function update(Request $request, $ctrlno){

        $expertiseId = ProfileTblExpertise::find($ctrlno);

        $request->validate([

            'expertise_specialization' => ['required'],
           
        ]);

        $expertise = ProfileTblExpertise::find($ctrlno);
        $expertise->expertise_specialization = $request->expertise_specialization;
        $expertise->save();

        return back()->with('message', 'Updated Sucessfully');

    }

    public function destroy($ctrlno){
        
        $expertise = ProfileTblExpertise::find($ctrlno);
        $expertise->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

        // $spouse->restore(); -> to restore soft deleted data

    }

}
