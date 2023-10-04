<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use App\Models\Scholarships;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class ScholarshipController extends Controller
{
    public function index($cesno)
    {
        $personalData = PersonalData::find($cesno);
        $scholarship = $personalData->scholarships;

        return view('admin.201_profiling.view_profile.partials.scholarships.table', compact('scholarship' ,'cesno'));
    }

    public function create($cesno)
    {
        return view('admin.201_profiling.view_profile.partials.scholarships.form', compact('cesno'));
    }

    public function store(Request $request, $cesno)
    {
        $request->validate([

            'type' => ['required'],
            'title' => ['required', Rule::unique('profile_tblScholarship')->where('cesno', $cesno), 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'sponsor' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'inclusive_date_from' => ['required'],
            'inclusive_date_to' => ['required'],

        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName(); 

        $scholarship = new Scholarships([

            'type' => $request->type,
            'title' => $request->title,
            'sponsor' => $request->sponsor,
            'from_dt' => $request->inclusive_date_from,
            'to_dt' => $request->inclusive_date_to,
            'encoder' =>  $encoder ,

        ]);

        $scholarshipPersonalDataId = PersonalData::find($cesno);

        $scholarshipPersonalDataId->scholarships()->save($scholarship);

        return to_route('scholarship.index', ['cesno'=>$cesno])->with('message', 'Successfuly Saved');
    }

    public function edit($ctrlno, $cesno)
    {
        $scholarship = Scholarships::find($ctrlno);

        return view('admin.201_profiling.view_profile.partials.scholarships.edit', compact('scholarship' ,'cesno'));
    }

    public function update(Request $request, $ctrlno, $cesno)
    {
        $request->validate([

            'type' => ['required'],
            'title' => ['required', Rule::unique('profile_tblScholarship')->where('cesno', $cesno)->ignore($ctrlno, 'ctrlno'), 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'sponsor' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'inclusive_date_from' => ['required'],
            'inclusive_date_to' => ['required'],

        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $scholarship= Scholarships::find($ctrlno);
        $scholarship->type = $request->type;
        $scholarship->title = $request->title;
        $scholarship->sponsor = $request->sponsor;
        $scholarship->from_dt = $request->inclusive_date_from;
        $scholarship->to_dt = $request->inclusive_date_to;
        $scholarship->lastupd_enc = $encoder;
        $scholarship->save();

        return to_route('scholarship.index', ['cesno'=>$cesno])->with('info', 'Updated Sucessfully');
    }

    public function destroy($ctrlno)
    {
        $scholarship = Scholarships::find($ctrlno);
        $scholarship->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');
    }

    public function recycleBin($cesno)
    {
        //parent model
        $personalData = PersonalData::withTrashed()->find($cesno);

        // Access the soft deleted scholarships of the parent model
        $scholarshipTrashedRecord = $personalData->scholarships()->onlyTrashed()->get();

        return view('admin.201_profiling.view_profile.partials.scholarships.trashbin', compact('scholarshipTrashedRecord', 'cesno'));
    }

    public function restore($ctrlno)
    {
        $scholarship = Scholarships::withTrashed()->find($ctrlno);
        $scholarship->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }

    public function forceDelete($ctrlno)
    {
        $Scholarships = Scholarships::withTrashed()->find($ctrlno);
        $Scholarships->forceDelete();

        return back()->with('info', 'Data Permanently Deleted');
    }
}
