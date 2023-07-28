<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResearchAndStudiesStoreRequest;
use App\Models\PersonalData;
use App\Models\ResearchAndStudies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ResearchAndStudiesController extends Controller
{
    
    public function store(Request $request, $cesno){

        $request->validate([

            'title' => ['required','max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', Rule::unique('profile_tblResearch')->where('personal_data_cesno', $cesno)],
            'publisher' => ['required','max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'inclusive_date_from' => ['required'],
            'inclusive_date_to' => ['required'],

        ]);

        $userLastName = Auth::user()->last_name;
        $userFirstName = Auth::user()->first_name;
        $userMiddleName = Auth::user()->middle_name; 
        $userNameExtension = Auth::user()->name_extension;

        $researchAndStudies = new ResearchAndStudies([

            'title' => $request->title,
            'publisher' => $request->publisher,
            'inclusive_date_from' => $request->inclusive_date_from,
            'inclusive_date_to' => $request->inclusive_date_to,
            'encoder' => $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension,
         
        ]);

        $researchAndStudiesPersonalDataId = PersonalData::find($cesno);

        $researchAndStudiesPersonalDataId->researchAndStudies()->save($researchAndStudies);

        return redirect()->back()->with('message', 'Successfuly Saved');

    }

    public function edit($ctrlno){

        $researchAndStudies = ResearchAndStudies::find($ctrlno);
        return view('admin.201_profiling.view_profile.partials.research_and_studies.edit', ['researchAndStudies'=>$researchAndStudies]);

    }

    public function update(Request $request, $ctrlno){

        $researchAndStudiesId = ResearchAndStudies::find($ctrlno);

        $request->validate([

            'title' => ['required','max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/',  Rule::unique('profile_tblResearch', 'title')->ignore($researchAndStudiesId)],
            'publisher' => ['required','max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'inclusive_date_from' => ['required'],
            'inclusive_date_to' => ['required'],

        ]);

        $researchAndStudies = ResearchAndStudies::find($ctrlno);
        $researchAndStudies->title = $request->title;
        $researchAndStudies->publisher = $request->publisher;
        $researchAndStudies->inclusive_date_from = $request->inclusive_date_from;
        $researchAndStudies->inclusive_date_to = $request->inclusive_date_to;
        $researchAndStudies->save();

        return back()->with('message', 'Updated Sucessfully');

    }

    public function destroy($ctrlno){
        
        $researchAndStudies = ResearchAndStudies::find($ctrlno);
        $researchAndStudies->delete();

        return redirect()->back()->with('message', 'Successfuly Saved');

    }

    public function recycleBin($cesno){

        //parent model
        $personalData = PersonalData::withTrashed()->find($cesno);

        // Access the soft deleted scholarships of the parent model
        $researchAndStudiesTrashedRecord = $personalData->researchAndStudies()->onlyTrashed()->get();

        return view('admin.201_profiling.view_profile.partials.research_and_studies.trashbin', compact('researchAndStudiesTrashedRecord'));

    }

    public function restore($ctrlno){

        $researchAndStudies = ResearchAndStudies::withTrashed()->find($ctrlno);
        $researchAndStudies->restore();

        return back()->with('message', 'Data Restored Sucessfully');

    }

    public function forceDelete($ctrlno){

        $researchAndStudies = ResearchAndStudies::withTrashed()->find($ctrlno);
        $researchAndStudies->forceDelete();

        return back()->with('message', 'Data Permanently Deleted');

    }
    

}
