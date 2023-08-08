<?php

namespace App\Http\Controllers;

use App\Http\Requests\EducationalAttainmentStoreRequest;
use App\Models\EducationalAttainment;
use App\Models\PersonalData;
use App\Models\ProfileLibTblEducDegree;
use App\Models\ProfileLibTblEducMajor;
use App\Models\ProfileLibTblEducSchool;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class EducationalAttainmentController extends Controller
{

    public function index($cesno){

        $personalData = PersonalData::find($cesno);
        $educationalAttainment = $personalData->educations;

        return view('admin.201_profiling.view_profile.partials.educational_attainment.table', compact('educationalAttainment', 'cesno'));

    }

    public function showForm($cesno){

        $profileLibTblEducDegree = ProfileLibTblEducDegree::orderBy('DEGREE', 'ASC')
        ->get();
        $profileLibTblEducSchool = ProfileLibTblEducSchool::orderBy('SCHOOL', 'ASC')
        ->get();
        $profileLibTblEducMajor = ProfileLibTblEducMajor::orderBy('COURSE', 'ASC')
        ->get();

        return view('admin.201_profiling.view_profile.partials.educational_attainment.form',
        compact('profileLibTblEducSchool', 'profileLibTblEducMajor', 'profileLibTblEducDegree', 'cesno'));

    }

    public function storeEducationAttainment(EducationalAttainmentStoreRequest $request, $cesno){

        $userFullName = Auth::user();
        $userLastName = $userFullName ->last_name;
        $userFirstName = $userFullName ->first_name;
        $userMiddleName = $userFullName ->middle_name;
        $userNameExtension = $userFullName ->name_extension;

        $educationalAttainment = new EducationalAttainment([

            'level' => $request->level,
            'school_code' => $request->school_code,
            'major_code' => $request->major_code,
            'degree_code' => $request->degree_code,
            'school_type' => $request->school_type,
            'period_of_attendance_from' => $request->period_of_attendance_from,
            'period_of_attendance_to' => $request->period_of_attendance_to,
            'highest_level' => $request->highest_level,
            'academics_honor_received' => $request->academics_honor_received,
            'encoder' => $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension,

        ]);

        $educationalAttainmentPersonalDataId = PersonalData::find($cesno);

        $educationalAttainmentPersonalDataId->educations()->save($educationalAttainment);

        return to_route('educational-attainment.index', ['cesno'=>$cesno])->with('message', 'Updated Sucessfully');

    }

    public function edit($ctrlno, $cesno){

        $educationalAttainment = EducationalAttainment::find($ctrlno);
        $profileLibTblEducMajor = ProfileLibTblEducMajor::all();
        $profileLibTblEducSchool = ProfileLibTblEducSchool::all();
        $profileLibTblEducDegree = ProfileLibTblEducDegree::all();

        return view('admin.201_profiling.view_profile.partials.educational_attainment.edit',
        compact('educationalAttainment','profileLibTblEducMajor','profileLibTblEducSchool','profileLibTblEducDegree','cesno'));

    }

    public function update(EducationalAttainmentStoreRequest $request, $ctrlno){

        $educationalAttainment = EducationalAttainment::find($ctrlno);
        $educationalAttainment->level = $request->level;
        $educationalAttainment->school_code = $request->school_code;
        $educationalAttainment->major_code = $request->major_code;
        $educationalAttainment->degree_code = $request->degree_code;
        $educationalAttainment->school_type = $request->school_type;
        $educationalAttainment->period_of_attendance_from = $request->period_of_attendance_from;
        $educationalAttainment->period_of_attendance_to = $request->period_of_attendance_to;
        $educationalAttainment->highest_level = $request->highest_level;
        $educationalAttainment->academics_honor_received = $request->academics_honor_received;
        $educationalAttainment->save();

        return redirect()->back()->with('message', 'Updated Sucessfully');

    }

    public function destroyEducationalAttainment($ctrlno){

        $educationalAttainment = EducationalAttainment::find($ctrlno);
        $educationalAttainment->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

    }

    public function recycleBin($cesno){

        //parent model
        $personalData = PersonalData::withTrashed()->find($cesno);

        // Access the soft deleted educations of the parent model
        $educationAttainmentTrashedRecord = $personalData->educations()->onlyTrashed()->get();

        return view('admin.201_profiling.view_profile.partials.educational_attainment.trashbin', compact('educationAttainmentTrashedRecord', 'cesno'));

    }

    public function restore($ctrlno){

        $educationalAttainment = EducationalAttainment::withTrashed()->find($ctrlno);
        $educationalAttainment->restore();

        return back()->with('message', 'Data Restored Sucessfully');

    }


    public function forceDelete($ctrlno){

        $educationalAttainment = EducationalAttainment::withTrashed()->find($ctrlno);
        $educationalAttainment->forceDelete();

        return back()->with('message', 'Data Permanently Deleted');

    }

}
