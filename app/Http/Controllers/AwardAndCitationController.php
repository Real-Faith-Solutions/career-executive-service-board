<?php

namespace App\Http\Controllers;

use App\Models\AwardAndCitations;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AwardAndCitationController extends Controller
{

    public function index($cesno){

        $personalData = PersonalData::find($cesno);
        $awardsAndCitation = $personalData->awardsAndCitations;

        return view('admin.201_profiling.view_profile.partials.award_and_citations.table', compact('awardsAndCitation' ,'cesno'));

    }

    public function create($cesno){

        return view('admin.201_profiling.view_profile.partials.award_and_citations.form', compact('cesno'));

    }
    
    public function store(Request $request, $cesno){

        $request->validate([

            'title_of_award' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z0-9\s]*$/'],
            'sponsor' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z0-9\s]*$/'],
            'date' => ['required'],
            
        ]);

        $userFullName = Auth::user();
        $userLastName = $userFullName ->last_name;
        $userFirstName = $userFullName ->first_name;
        $userMiddleName = $userFullName ->middle_name;
        $userNameExtension = $userFullName ->name_extension;

        $awardAndCitations = new AwardAndCitations([

            'awards' => $request->title_of_award,
            'sponsor' => $request->sponsor,
            'date' => $request->date,
            'encoder' => $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension,
         
        ]);

        $awardAndCitationsPersonalDataId = PersonalData::find($cesno);
            
        $awardAndCitationsPersonalDataId->awardsAndCitations()->save($awardAndCitations);
            
        return to_route('award-citation.index', ['cesno'=>$cesno])->with('message', 'Successfuly Saved');

    }

    public function edit($ctrlno, $cesno){

        $awardAndCitation = AwardAndCitations::find($ctrlno);

        return view('admin.201_profiling.view_profile.partials.award_and_citations.edit', compact('awardAndCitation' ,'cesno'));

    }

    public function update(Request $request, $ctrlno, $cesno){

        $request->validate([

            'title_of_award' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z0-9\s]*$/'],
            'sponsor' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z0-9\s]*$/'],
            'date' => ['required'],
            
        ]);

        $userFullName = Auth::user();
        $userLastName = $userFullName ->last_name;
        $userFirstName = $userFullName ->first_name;
        $userMiddleName = $userFullName ->middle_name;
        $userNameExtension = $userFullName ->name_extension;

        $awardAndCitation = AwardAndCitations::find($ctrlno);
        $awardAndCitation->awards = $request->title_of_award;
        $awardAndCitation->sponsor = $request->sponsor;
        $awardAndCitation->date = $request->date;
        $awardAndCitation->updated_by = $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension;
        $awardAndCitation->save();

        return to_route('award-citation.index', ['cesno'=>$cesno])->with('message', 'Updated Sucessfully');

    }

    public function destroy($ctrlno){
        
        $awardAndCitations = AwardAndCitations::find($ctrlno);
        $awardAndCitations->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

    }

    public function recentlyDeleted($cesno){

        //parent model
        $personalData = PersonalData::withTrashed()->find($cesno);

        // Access the soft deleted scholarships of the parent model
        $awardAndCitationsTrashedRecord = $personalData->awardsAndCitations()->onlyTrashed()->get();
 
        return view('admin.201_profiling.view_profile.partials.award_and_citations.trashbin', compact('awardAndCitationsTrashedRecord', 'cesno'));

    }

    public function restore($ctrlno){

        $awardAndCitations = AwardAndCitations::withTrashed()->find($ctrlno);
        $awardAndCitations->restore();

        return back()->with('message', 'Data Restored Sucessfully');

    }
 
    public function forceDelete($ctrlno){

        $awardAndCitations = AwardAndCitations::withTrashed()->find($ctrlno);
        $awardAndCitations->forceDelete();
  
        return back()->with('message', 'Data Permanently Deleted');

    }

}
