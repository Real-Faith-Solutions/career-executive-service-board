<?php

namespace App\Http\Controllers\ERIS;

use App\Http\Controllers\Controller;
use App\Models\Eris\AssessmentCenter;
use App\Models\Eris\EradTblMain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ConvertDateTimeToDate;

class AssessmentCenterController extends Controller
{
    private ConvertDateTimeToDate $convertDateTimeToDate;
 
    public function __construct(ConvertDateTimeToDate $convertDateTimeToDate)
    {
        $this->convertDateTimeToDate = $convertDateTimeToDate;
    }

    public function getFullNameAttribute()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        return $encoder;
    }

    public function index($acno)
    {
        $erisTblMain = EradTblMain::find($acno);
        $assessmentCenter = $erisTblMain->assessmentCenter()->paginate(20);

        return view('admin.eris.partials.assessment_center.table', compact('acno', 'assessmentCenter'));
    }

    public function create($acno)
    {
        $erisTblMainProfileData = EradTblMain::find($acno);

        return view('admin.eris.partials.assessment_center.form', compact('acno','erisTblMainProfileData'));
    }

    public function store(Request $request, $acno)
    {
        $request->validate([

            'acdate' => ['required'],
            'numtakes' => ['nullable', 'numeric', 'digits_between:1,4'],
            'remarks' => ['nullable', 'max:60', 'min:2', 'regex:/^[a-zA-Z0-9\s]*$/'],

        ]);
            
        $assessmentCenter = new AssessmentCenter([

            'acno' => $request->acno, // assessment center date
            'acdate' => $request->acdate, // assessment center date
            'numtakes' => $request->numtakes, //  number of takes
            'docdate' => $request->docdate, //  document date
            'competencies_d_o' => $request->competencies_d_o,
            'remarks' => $request->remarks, 
            'encoder' =>  $this->getFullNameAttribute(),

        ]);

        $erisTblMain = EradTblMain::find($request->acno);
        
        $erisTblMain->assessmentCenter()->save($assessmentCenter);
        
        return to_route('eris-assessment-center.index', ['acno'=>$acno])->with('message', 'Save Sucessfully');
    }

    public function edit($acno, $ctrlno)
    {
        $erisTblMainProfileData = EradTblMain::find($acno);
        $assessmentCenterProfileData = AssessmentCenter::find($ctrlno);

        return view('admin.eris.partials.assessment_center.edit', [
            'acno' => $acno, 
            'ctrlno' => $ctrlno,
            'erisTblMainProfileData' => $erisTblMainProfileData, 
            'assessmentCenterProfileData' => $assessmentCenterProfileData,
            'assessmentCenterDate' =>  $this->convertDateTimeToDate->convertDateFrom($assessmentCenterProfileData->acdate),
            'documentDate' =>  $this->convertDateTimeToDate->convertDateTo($assessmentCenterProfileData->docdate),
        ]);
    }

    public function update(Request $request, $acno, $ctrlno)
    {
        $request->validate([
            
            'acdate' => ['required'],
            'numtakes' => ['nullable', 'numeric', 'digits_between:1,4'],
            'remarks' => ['nullable', 'max:60', 'min:2', 'regex:/^[a-zA-Z0-9\s]*$/'],

        ]);
        
        $assessmentCenter = AssessmentCenter::find($ctrlno);
        $assessmentCenter->acdate = $request->acdate;
        $assessmentCenter->numtakes = $request->numtakes;
        $assessmentCenter->docdate = $request->docdate;
        $assessmentCenter->competencies_d_o = $request->competencies_d_o;
        $assessmentCenter->remarks = $request->remarks;
        $assessmentCenter->save();

        return to_route('eris-assessment-center.index', ['acno'=>$acno])->with('info', 'Update Sucessfully');
    }

    public function destroy($ctrlno)
    {
       $assessmentCenter =  AssessmentCenter::find($ctrlno);
       $assessmentCenter->delete();

       return back()->with('message', 'Deleted Sucessfully');        
    }

    public function recentlyDeleted($acno)
    {
        //parent model
        $erisTblMainData = EradTblMain::withTrashed()->find($acno);

        // Access the soft deleted assessmentCenter of the parent model
        $assessmentCenterTrashedRecord = $erisTblMainData->assessmentCenter()->onlyTrashed()->paginate(20);
 
        return view('admin.eris.partials.assessment_center.trashbin', compact('assessmentCenterTrashedRecord', 'acno'));
    }

    public function restore($ctrlno)
    {
        $assessmentCenterTrashedRecord = AssessmentCenter::onlyTrashed()->find($ctrlno);
        $assessmentCenterTrashedRecord->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }

    public function forceDelete($ctrlno)
    {
        $assessmentCenterTrashedRecord = AssessmentCenter::onlyTrashed()->find($ctrlno);
        $assessmentCenterTrashedRecord->forceDelete();
  
        return back()->with('info', 'Data Permanently Deleted');
    }
}
