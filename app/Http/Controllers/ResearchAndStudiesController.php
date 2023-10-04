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
    public function index($cesno)
    {
        $personalData = PersonalData::find($cesno);
        $researchAndStudies = $personalData->researchAndStudies;

        return view('admin.201_profiling.view_profile.partials.research_and_studies.table', compact('researchAndStudies' ,'cesno'));
    }

    public function create($cesno)
    {
        return view('admin.201_profiling.view_profile.partials.research_and_studies.form', compact('cesno'));
    }
    
    public function store(Request $request, $cesno)
    {
        $request->validate([

            'title' => ['required','max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', Rule::unique('profile_tblResearch')->where('cesno', $cesno)],
            'publisher' => ['required','max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'inclusive_date_from' => ['required'],
            'inclusive_date_to' => ['required'],

        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName(); 

        $researchAndStudies = new ResearchAndStudies([

            'title' => $request->title,
            'sponsor' => $request->publisher,
            'from_dt' => $request->inclusive_date_from,
            'to_dt' => $request->inclusive_date_to,
            'encoder' =>  $encoder,
         
        ]);

        $researchAndStudiesPersonalDataId = PersonalData::find($cesno);

        $researchAndStudiesPersonalDataId->researchAndStudies()->save($researchAndStudies);

        return to_route('research-studies.index', ['cesno'=>$cesno])->with('message', 'Successfuly Saved');
    }

    public function edit($ctrlno, $cesno)
    {
        $researchAndStudies = ResearchAndStudies::find($ctrlno);

        return view('admin.201_profiling.view_profile.partials.research_and_studies.edit', compact('researchAndStudies' ,'cesno'));
    }

    public function update(Request $request, $ctrlno, $cesno)
    {
        $request->validate([

            'title' => ['required','max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/',  Rule::unique('profile_tblResearch')->where('cesno', $cesno)->ignore($ctrlno, 'ctrlno')],
            'publisher' => ['required','max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'inclusive_date_from' => ['required'],
            'inclusive_date_to' => ['required'],

        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName(); 

        $researchAndStudies = ResearchAndStudies::find($ctrlno);
        $researchAndStudies->title = $request->title;
        $researchAndStudies->sponsor = $request->publisher;
        $researchAndStudies->from_dt = $request->inclusive_date_from;
        $researchAndStudies->to_dt = $request->inclusive_date_to;
        $researchAndStudies->lastupd_enc = $encoder;
        $researchAndStudies->save();

        return to_route('research-studies.index', ['cesno'=>$cesno])->with('info', 'Updated Sucessfully');
    }

    public function destroy($ctrlno)
    {    
        $researchAndStudies = ResearchAndStudies::find($ctrlno);
        $researchAndStudies->delete();

        return redirect()->back()->with('message', 'Successfuly Saved');
    }

    public function recycleBin($cesno)
    {
        //parent model
        $personalData = PersonalData::withTrashed()->find($cesno);

        // Access the soft deleted scholarships of the parent model
        $researchAndStudiesTrashedRecord = $personalData->researchAndStudies()->onlyTrashed()->get();

        return view('admin.201_profiling.view_profile.partials.research_and_studies.trashbin', compact('researchAndStudiesTrashedRecord', 'cesno'));
    }

    public function restore($ctrlno)
    {
        $researchAndStudies = ResearchAndStudies::withTrashed()->find($ctrlno);
        $researchAndStudies->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }

    public function forceDelete($ctrlno)
    {
        $researchAndStudies = ResearchAndStudies::withTrashed()->find($ctrlno);
        $researchAndStudies->forceDelete();

        return back()->with('info', 'Data Permanently Deleted');
    }
}
