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

    public function index($cesno){

        $personalData = PersonalData::find($cesno);
        $researchAndStudies = $personalData->researchAndStudies;

        return view('admin.201_profiling.view_profile.partials.research_and_studies.table', compact('researchAndStudies' ,'cesno'));

    }

    public function create($cesno){

        return view('admin.201_profiling.view_profile.partials.research_and_studies.form', compact('cesno'));

    }
    
    public function store(Request $request, $cesno){

        $request->validate([

            'title' => ['required','max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', Rule::unique('profile_tblResearch')->where('personal_data_cesno', $cesno)],
            'publisher' => ['required','max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'inclusive_date_from' => ['required'],
            'inclusive_date_to' => ['required'],

        ]);

        $userFullName = Auth::user();
        $userLastName = $userFullName ->last_name;
        $userFirstName = $userFullName ->first_name;
        $userMiddleName = $userFullName ->middle_name;
        $userNameExtension = $userFullName ->name_extension;

        $researchAndStudies = new ResearchAndStudies([

            'title' => $request->title,
            'publisher' => $request->publisher,
            'inclusive_date_from' => $request->inclusive_date_from,
            'inclusive_date_to' => $request->inclusive_date_to,
            'encoder' => $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension,
         
        ]);

        $researchAndStudiesPersonalDataId = PersonalData::find($cesno);

        $researchAndStudiesPersonalDataId->researchAndStudies()->save($researchAndStudies);

        return to_route('research-studies.index', ['cesno'=>$cesno])->with('message', 'Successfuly Saved');

    }

    public function edit($ctrlno, $cesno){

        $researchAndStudies = ResearchAndStudies::find($ctrlno);
        return view('admin.201_profiling.view_profile.partials.research_and_studies.edit', compact('researchAndStudies' ,'cesno'));

    }

    public function update(Request $request, $ctrlno, $cesno){

        $request->validate([

            'title' => ['required','max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/',  Rule::unique('profile_tblResearch')->where('personal_data_cesno', $cesno)->ignore($ctrlno, 'ctrlno')],
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

        return to_route('research-studies.index', ['cesno'=>$cesno])->with('message', 'Updated Sucessfully');

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

        return view('admin.201_profiling.view_profile.partials.research_and_studies.trashbin', compact('researchAndStudiesTrashedRecord', 'cesno'));

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
