<?php

namespace App\Http\Controllers;

use App\Models\Affiliations;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AffiliationController extends Controller
{
    public function getFullNameAttribute()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        return $encoder;
    }

    public function index($cesno)
    {
        $personalData = PersonalData::find($cesno);
        $affiliation = $personalData->affiliations()
        ->select('ctrlno', 'organization', 'position', 'from_dt', 'to_dt')
        ->paginate(25);

        return view('admin.201_profiling.view_profile.partials.major_civic_and_professional_affiliations.table', compact('affiliation' ,'cesno'));
    }

    public function create($cesno)
    {
        return view('admin.201_profiling.view_profile.partials.major_civic_and_professional_affiliations.form', compact('cesno'));
    }
    
    public function store(Request $request, $cesno)
    {
        $request->validate([

            'organization' => ['required','max:40', 'min:2', 'regex:/^[a-zA-Z0-9\s]*$/', Rule::unique('profile_tblAffiliations')->where('cesno', $cesno)],
            'position' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z0-9\s]*$/'],
            // 'date_from' => ['required'],
            // 'date_to' => ['required'],

        ]);

        $affiliation = new Affiliations([
    
            'organization' => $request->organization,
            'position' => $request->position,
            'from_dt' => $request->date_from,
            'to_dt' => $request->date_to,
            'encoder' => $this->getFullNameAttribute(),
             
        ]);
    
        $affiliationPersonalDataId = PersonalData::find($cesno);
    
        $affiliationPersonalDataId->affiliations()->save($affiliation);
            
        return to_route('affiliation.index', ['cesno'=>$cesno])->with('message', 'Successfuly Saved');
    }

    public function edit($ctrlno, $cesno)
    {
        $affiliation = Affiliations::find($ctrlno);

        return view('admin.201_profiling.view_profile.partials.major_civic_and_professional_affiliations.edit', compact('affiliation' ,'cesno'));
    }

    public function update(Request $request, $ctrlno, $cesno)
    {
        $request->validate([

            'organization' => ['required','max:40', 'min:2', 'regex:/^[a-zA-Z0-9\s]*$/', Rule::unique('profile_tblAffiliations')->where('cesno', $cesno)->ignore($ctrlno, 'ctrlno')],
            'position' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z0-9\s]*$/'],
            // 'date_from' => ['required'],
            // 'date_to' => ['required'],

        ]);

        $affiliation = Affiliations::find($ctrlno); 
        $affiliation->organization = $request->organization;
        $affiliation->position = $request->position;
        $affiliation->from_dt = $request->date_from;
        $affiliation->to_dt = $request->date_to;
        $affiliation->lastupd_enc = $this->getFullNameAttribute();
        $affiliation->save();

        return to_route('affiliation.index', ['cesno'=>$cesno])->with('info', 'Updated Sucessfully');
    }

    public function destroy($ctrlno)
    {
        $affiliation = Affiliations::find($ctrlno);
        $affiliation->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');
    }

    public function recycleBin($cesno)
    {
        //parent model
        $personalData = PersonalData::withTrashed()->find($cesno);

        // Access the soft deleted scholarships of the parent model
        $affiliationsTrashedRecord = $personalData->affiliations()
        ->onlyTrashed()
        ->select('ctrlno', 'organization', 'position', 'from_dt', 'to_dt', 'deleted_at')
        ->paginate(25);;
 
        return view('admin.201_profiling.view_profile.partials.major_civic_and_professional_affiliations.trashbin', compact('affiliationsTrashedRecord', 'cesno'));
    }

    public function restore($ctrlno)
    {
        $affiliation = Affiliations::withTrashed()->find($ctrlno);
        $affiliation->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }

    
    public function forceDelete($ctrlno)
    {
        $affiliation = Affiliations::withTrashed()->find($ctrlno);
        $affiliation->forceDelete();
  
        return back()->with('info', 'Data Permanently Deleted');
    }
}
