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

    public function index($cesno)
    {
        $personalData = PersonalData::find($cesno);
        $examinationTaken = $personalData->examinationTakens;

        return view('admin.201_profiling.view_profile.partials.examinations_taken.table', compact('examinationTaken', 'cesno'));
    }

    public function create($cesno)
    {
        $profileLibTblExamRef = ProfileLibTblExamRef::all(['CODE', 'TITLE']);

        return view('admin.201_profiling.view_profile.partials.examinations_taken.form', compact('profileLibTblExamRef', 'cesno'));
    }

    public function store(Request $request, $cesno)
    {
        $request->validate([

            'exam_code' => ['required', Rule::unique('profile_tblExaminations')->where('cesno', $cesno)],
            'rating' => ['nullable', 'max:40'],
            'date_of_examination' => ['required'],
            'place_of_examination' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'license_number' => ['nullable', 'min:2', 'max:40'],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $examinationTaken = new ExaminationsTaken([

            'exam_code' => $request->exam_code,
            'rate' => $request->rating,
            'exam_date' => $request->date_of_examination,
            'exam_place' => $request->place_of_examination,
            'license_number' => $request->license_number,
            'date_acquired' => $request->date_acquired,
            'date_validity' => $request->date_validity,
            'encoder' => $encoder,

        ]);

        $examinationTakenPersonalDataId = PersonalData::find($cesno);

        $examinationTakenPersonalDataId->examinationTakens()->save($examinationTaken);

        return to_route('examination-taken.index', ['cesno' => $cesno])->with('message', 'Successfuly Saved');
    }

    public function edit($ctrlno, $cesno)
    {
        $profileLibTblExamRef = ProfileLibTblExamRef::all();
        $examinationTaken = ExaminationsTaken::find($ctrlno);

        return view('admin.201_profiling.view_profile.partials.examinations_taken.edit',
        compact('examinationTaken', 'profileLibTblExamRef', 'cesno'));
    }

    public function update(Request $request, $ctrlno, $cesno)
    {
        $request->validate([

            'exam_code' => ['required', Rule::unique('profile_tblExaminations')->where('cesno', $cesno)->ignore($ctrlno, 'ctrlno')],
            'rating' => ['nullable', 'min:2', 'max:40'],
            'date_of_examination' => ['required', 'date', 'date_format:m/d/Y'],
            'place_of_examination' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'license_number' => ['nullable', 'min:2', 'max:40'],
            'date_acquired' => ['required'],
            'date_validity' => ['required'],

        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $examinationTaken = ExaminationsTaken::find($ctrlno);
        $examinationTaken->exam_code = $request->exam_code;
        $examinationTaken->rate = $request->rating;
        $examinationTaken->exam_date = $request->date_of_examination;
        $examinationTaken->exam_place = $request->place_of_examination;
        $examinationTaken->license_number = $request->license_number;
        $examinationTaken->date_acquired = $request->date_acquired;
        $examinationTaken->date_validity = $request->date_validity;
        $examinationTaken->lastupd_enc = $encoder;
        $examinationTaken->save();

        return to_route('examination-taken.index', ['cesno' => $cesno])->with('info', 'Successfuly Saved');
    }

    public function destroy($ctrlno)
    {
        $examinationTaken = ExaminationsTaken::find($ctrlno);
        $examinationTaken->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');
    }

    public function recentlyDeleted($cesno)
    {
        //parent model
        $personalData = PersonalData::withTrashed()->find($cesno);

        // Access the soft deleted scholarships of the parent model
        $examinationTakensTrashedRecord = $personalData->examinationTakens()->onlyTrashed()->get();

        return view('admin.201_profiling.view_profile.partials.examinations_taken.trashbin', compact('examinationTakensTrashedRecord', 'cesno'));
    }

    public function restore($ctrlno)
    {
        $examinationTaken = ExaminationsTaken::withTrashed()->find($ctrlno);
        $examinationTaken->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }

    public function forceDelete($ctrlno)
    {
        $examinationTaken = ExaminationsTaken::withTrashed()->find($ctrlno);
        $examinationTaken->forceDelete();

        return back()->with('info', 'Data Permanently Deleted');
    }
}
