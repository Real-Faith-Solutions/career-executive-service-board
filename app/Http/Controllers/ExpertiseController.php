<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use App\Models\ProfileLibTblExpertiseSpec;
use App\Models\ProfileTblExpertise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;

class ExpertiseController extends Controller
{
    public function index($cesno)
    {
        $personalData = PersonalData::find($cesno);
        $expertise = $personalData->expertise;

        return view('admin.201_profiling.view_profile.partials.field_expertise.table', compact('expertise' ,'cesno'));
    }

    public function create($cesno)
    {
        $profileLibTblExpertiseSpec = ProfileLibTblExpertiseSpec::all();

        return view('admin.201_profiling.view_profile.partials.field_expertise.form', compact('profileLibTblExpertiseSpec' ,'cesno'));
    }

    public function store(Request $request, $cesno)
    {
        $request->validate([
            'SpeExp_Code' => [Rule::unique('profile_tblExpertise')->where('cesno', $cesno), 'required'],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $profileTblExpertise = new ProfileTblExpertise([

            'SpeExp_Code' => $request->SpeExp_Code,
            'encoder' =>  $encoder,

        ]);
    
        $personalData = PersonalData::find($cesno);
        
        $personalData->expertise()->save($profileTblExpertise);
            
        return to_route('expertise.index', ['cesno'=>$cesno])->with('message', 'Expertise Successfuly Saved');
    }

    public function edit($cesno,$ctrlno)
    {
        $profileTblExpertise = ProfileTblExpertise::find($ctrlno);
        
        $profileLibTblExpertiseSpec = ProfileLibTblExpertiseSpec::all();
        
        return view('admin.201_profiling.view_profile.partials.field_expertise.edit',compact('cesno', 'profileLibTblExpertiseSpec', 'profileTblExpertise'));
    }

    public function update(Request $request, $cesno, $ctrlno)
    {
        $request->validate([
            'SpeExp_Code' => ['required', Rule::unique('profile_tblExpertise')->where('cesno', $cesno)->ignore($ctrlno, 'ctrlno')],
        ]);

        $profileTblExpertise = ProfileTblExpertise::find($ctrlno);
        $profileTblExpertise->SpeExp_Code = $request->SpeExp_Code;
        $profileTblExpertise->save();
     
        return to_route('expertise.index', ['cesno'=>$cesno])->with('message', 'Updated Sucessfully');
    }

    public function destroy($ctrlno)
    {
        $profileTblExpertise = ProfileTblExpertise::find($ctrlno);
        $profileTblExpertise->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');
    }

    public function recentlyDeleted($cesno)
    {
        //parent model
        $personalData = PersonalData::withTrashed()->find($cesno);

        // Access the soft deleted expertise of the parent model
        $profileTblExpertiseTrashedRecord = $personalData->expertise()->onlyTrashed()->get();

        return view('admin.201_profiling.view_profile.partials.field_expertise.trashbin', compact('profileTblExpertiseTrashedRecord', 'cesno'));
    }

    public function restore($ctrlno)
    {
        $profileTblExpertise = ProfileTblExpertise::onlyTrashed()->find($ctrlno);
        $profileTblExpertise->restore();

        return redirect()->back()->with('info', 'Data Restored Sucessfully');
    }

    public function forceDelete($ctrlno)
    {
        $profileTblExpertise = ProfileTblExpertise::onlyTrashed()->find($ctrlno);
        $profileTblExpertise->forceDelete();

        return redirect()->back()->with('message', 'Data Permanently Delete Sucessfully');
    }
}
