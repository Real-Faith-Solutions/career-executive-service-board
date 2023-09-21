<?php

namespace App\Http\Controllers\ERIS;

use App\Http\Controllers\Controller;
use App\Models\Eris\AssessmentCenter;
use App\Models\Eris\ErisTblMain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssessmentCenterController extends Controller
{
    public function index($acno)
    {
        $erisTblMain = ErisTblMain::find($acno);
        $assessmentCenter = $erisTblMain->assessmentCenter()->paginate(20);

        return view('admin.eris.partials.assessment_center.table', compact('acno', 'assessmentCenter'));
    }

    public function create($acno)
    {
        $erisTblMainProfileData = ErisTblMain::find($acno);

        return view('admin.eris.partials.assessment_center.form', compact('acno','erisTblMainProfileData'));
    }

    public function store(Request $request, $acno)
    {
        
        $request->validate([
            'acdate' => ['required'],
            'numtakes' => ['nullable', 'numeric', 'digits_between:1,4'],
            'remarks' => ['nullable', 'max:60', 'min:2', 'regex:/^[a-zA-Z0-9\s]*$/'],
        ]);
            
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $assessmentCenter = new AssessmentCenter([

            'acno' => $request->acno, // assessment center date
            'acdate' => $request->acdate, // assessment center date
            'numtakes' => $request->numtakes, //  number of takes
            'docdate' => $request->docdate, //  document date
            'remarks' => $request->remarks, 
            'encoder' =>  $encoder,

        ]);

        $erisTblMain = ErisTblMain::find($request->acno);
        
        $erisTblMain->assessmentCenter()->save($assessmentCenter);
        
        return to_route('eris-assessment-center.index', ['acno'=>$acno])->with('message', 'Save Sucessfully');
    }

    public function edit($acno, $ctrlno)
    {
        $erisTblMainProfileData = ErisTblMain::find($acno);
        $assessmentCenterProfileData = AssessmentCenter::find($ctrlno);

        return view('admin.eris.partials.assessment_center.edit', compact('acno', 'erisTblMainProfileData', 'assessmentCenterProfileData'));
    }
}
