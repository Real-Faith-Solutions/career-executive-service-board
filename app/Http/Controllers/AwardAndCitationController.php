<?php

namespace App\Http\Controllers;

use App\Models\AwardAndCitations;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AwardAndCitationController extends Controller
{
    public function index($cesno)
    {
        $personalData = PersonalData::find($cesno);
        $awardsAndCitation = $personalData->awardsAndCitations;

        return view('admin.201_profiling.view_profile.partials.award_and_citations.table', compact('awardsAndCitation' ,'cesno'));
    }

    public function create($cesno)
    {
        return view('admin.201_profiling.view_profile.partials.award_and_citations.form', compact('cesno'));
    }
    
    public function store(Request $request, $cesno)
    {
        $request->validate([
            'awards' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z0-9\s]*$/'],
            'sponsor' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z0-9\s]*$/'],
            'date' => ['required'],
            
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $awardAndCitations = new AwardAndCitations([

            'awards' => $request->awards,
            'sponsor' => $request->sponsor,
            'award_dt' => $request->date,
            'encoder' => $encoder,
         
        ]);

        $awardAndCitationsPersonalDataId = PersonalData::find($cesno);

        //check if PersonalData primary key is existed
        if(!$awardAndCitationsPersonalDataId)
        {    
            return redirect()->back()->with('error', 'Data Not Found');
        }

        $awardAndCitationsIfExist = AwardAndCitations::where('awards', $request->awards)->where('award_dt', $request->date)->exists();

        //check if awards and date is existed in AwarndCitations
        if($awardAndCitationsIfExist)
        {
            return redirect()->back()->with('error', 'Already Have Details');
        }
        else
        {    
            $awardAndCitationsPersonalDataId->awardsAndCitations()->save($awardAndCitations);
        }
            
        return to_route('award-citation.index', ['cesno'=>$cesno])->with('message', 'Successfuly Saved');
    }

    public function edit($ctrlno, $cesno)
    {
        $awardAndCitation = AwardAndCitations::find($ctrlno);

        //check if AwardAndCitations primary key is existed
        if(!$awardAndCitation)
        {    
            return redirect()->back()->with('error', 'Something Went Wrong, Showing the Data');
        }

        return view('admin.201_profiling.view_profile.partials.award_and_citations.edit', compact('awardAndCitation' ,'cesno'));
    }

    public function update(Request $request, $ctrlno, $cesno)
    {
        $request->validate([

            'awards' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z0-9\s]*$/'],
            'sponsor' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z0-9\s]*$/'],
            'date' => ['required'],
            
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $awardAndCitation = AwardAndCitations::find($ctrlno);
        $awardAndCitation->awards = $request->awards;
        $awardAndCitation->sponsor = $request->sponsor;
        $awardAndCitation->award_dt = $request->date;
        $awardAndCitation->lastupd_enc = $encoder;
        $awardAndCitation->save();

        return to_route('award-citation.index', ['cesno'=>$cesno])->with('message', 'Updated Sucessfully');
    }

    public function destroy($ctrlno)
    {
        $awardAndCitations = AwardAndCitations::find($ctrlno);
        $awardAndCitations->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');
    }

    public function recentlyDeleted($cesno)
    {
        //parent model
        $personalData = PersonalData::withTrashed()->find($cesno);

        // Access the soft deleted scholarships of the parent model
        $awardAndCitationsTrashedRecord = $personalData->awardsAndCitations()->onlyTrashed()->get();
 
        return view('admin.201_profiling.view_profile.partials.award_and_citations.trashbin', compact('awardAndCitationsTrashedRecord', 'cesno'));
    }

    public function restore($ctrlno)
    {
        $awardAndCitations = AwardAndCitations::withTrashed()->find($ctrlno);
        $awardAndCitations->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }
 
    public function forceDelete($ctrlno)
    {
        $awardAndCitations = AwardAndCitations::withTrashed()->find($ctrlno);
        $awardAndCitations->forceDelete();
  
        return back()->with('info', 'Data Permanently Deleted');
    }
}
