<?php

namespace App\Http\Controllers;

use App\Models\CaseRecords;
use App\Models\PersonalData;
use App\Models\ProfileLibTblCaseNature;
use App\Models\ProfileLibTblCaseStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Services\ConvertDateTimeToDate;

class CaseRecordController extends Controller
{
    // App\Services
    private ConvertDateTimeToDate $convertDateTimeToDate;
 
    public function __construct(ConvertDateTimeToDate $convertDateTimeToDate)
    {
        $this->convertDateTimeToDate = $convertDateTimeToDate;
    }

    public function caseNatureLibrary()
    {
       $profileLibTblCaseNature = new ProfileLibTblCaseNature;
       $caseNature = $profileLibTblCaseNature->caseNature();

       return $caseNature;
    }

    public function caseStatusLibrary()
    {
       $profileLibTblCaseStatus = new ProfileLibTblCaseStatus;
       $caseStatus = $profileLibTblCaseStatus->caseStatus();

       return $caseStatus;
    }

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
        $caseRecord = $personalData->caseRecords()
        ->orderBy('encdate', 'desc')
        ->paginate(25);

        return view('admin.201_profiling.view_profile.partials.case_records.table', compact('caseRecord' ,'cesno'));
    }

    public function create($cesno)
    {        
        return view('admin.201_profiling.view_profile.partials.case_records.form', [
            'cesno' => $cesno,
            'profileLibTblCaseNature' => $this->caseNatureLibrary(), 
            'profileLibTblCaseStatus' => $this->caseStatusLibrary(),
        ]);
    }
    
    public function store(Request $request, $cesno)
    {
        $request->validate([

            'parties' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z0-9\s]*$/'],
            'offense' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z0-9\s]*$/'],
            'nature_of_offense' => ['required'],
            'case_no' => ['required', 'min:2', 'max:40', Rule::unique('profile_tblCaseRecord')->where('cesno', $cesno)],
            'date_filed' => ['required'],
            'venue' => ['required', 'min:2', 'max:40'],
            'case_status' => ['required'],
            'date_finality' => ['required'],
            'decision' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z0-9\s]*$/'],
            'remarks' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z0-9\s]*$/'],
            
        ]);

        $caseRecord = new CaseRecords([

            'parties' => $request->parties,
            'offence' => $request->offense,
            'nature_code' => $request->nature_of_offense,
            'case_no' => $request->case_no,
            'filed_dt' => $request->date_filed,
            'venue' => $request->venue,
            'status_code' => $request->case_status,
            'finality' => $request->date_finality,
            'decision' => $request->decision,
            'remarks' => $request->remarks,
            'encoder' =>  $this->getFullNameAttribute(),
         
        ]);

        $caseRecordPersonalDataId = PersonalData::find($cesno);

        $caseRecordPersonalDataId->caseRecords()->save($caseRecord);

        return to_route('case-record.index', ['cesno'=>$cesno])->with('message', 'Successfuly Saved');
    }

    public function edit($ctrlno, $cesno)
    {
        $caseRecord = CaseRecords::find($ctrlno);
  
        return view('admin.201_profiling.view_profile.partials.case_records.edit', [
            'cesno' => $cesno,
            'caseRecord' => $caseRecord , 
            'profileLibTblCaseNature' => $this->caseNatureLibrary(), 
            'profileLibTblCaseStatus' => $this->caseStatusLibrary(),
            'dateFiled' => $this->convertDateTimeToDate->convertDateFrom($caseRecord->filed_dt),
            'dateFinality' => $this->convertDateTimeToDate->convertDateTo($caseRecord->finality),
        ]);
    }

    public function update(Request $request, $ctrlno, $cesno)
    {
        $request->validate([

            'parties' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z0-9\s]*$/'],
            'offense' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z0-9\s]*$/'],
            'nature_of_offense' => ['required'],
            'case_no' => ['required', 'min:2', 'max:40', Rule::unique('profile_tblCaseRecord')->where('cesno', $cesno)->ignore($ctrlno, 'ctrlno')],
            'date_filed' => ['required'],
            'venue' => ['required', 'min:2', 'max:40'],
            'case_status' => ['required'],
            'date_finality' => ['required'],
            'decision' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z0-9\s]*$/'],
            'remarks' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z0-9\s]*$/'],
            
        ]);

        $caseRecord = CaseRecords::find($ctrlno);
        $caseRecord->parties = $request->parties;
        $caseRecord->offence = $request->offense;
        $caseRecord->nature_code = $request->nature_of_offense;
        $caseRecord->case_no = $request->case_no;
        $caseRecord->filed_dt = $request->date_filed;
        $caseRecord->venue = $request->venue;
        $caseRecord->status_code = $request->case_status;
        $caseRecord->finality = $request->date_finality;
        $caseRecord->decision = $request->decision;
        $caseRecord->remarks = $request->remarks;
        $caseRecord->lastupd_enc = $this->getFullNameAttribute();
        $caseRecord->save();

        return to_route('case-record.index', ['cesno'=>$cesno])->with('info', 'Updated Sucessfully');
    }

    public function destroy($ctrlno)
    {
        $caseRecord = CaseRecords::find($ctrlno);
        $caseRecord->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');
    }

    public function recentlyDeleted($cesno)
    {
        //parent model
        $personalData = PersonalData::withTrashed()->find($cesno);

        // Access the soft deleted scholarships of the parent model
        $caseRecordTrashedRecord = $personalData->caseRecords()
        ->onlyTrashed()
        ->orderBy('deleted_at', 'desc')
        ->paginate(25);
 
        return view('admin.201_profiling.view_profile.partials.case_records.trashbin', compact('caseRecordTrashedRecord' ,'cesno'));
    }

    public function restore($ctrlno)
    {
        $caseRecord = CaseRecords::onlyTrashed()->find($ctrlno);
        $caseRecord->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }
 
    public function forceDelete($ctrlno)
    {
        $caseRecord = CaseRecords::onlyTrashed()->find($ctrlno);
        $caseRecord->forceDelete();
  
        return back()->with('info', 'Data Permanently Deleted');
    }
}
