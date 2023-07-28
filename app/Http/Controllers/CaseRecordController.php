<?php

namespace App\Http\Controllers;

use App\Models\CaseRecords;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaseRecordController extends Controller
{
    
    public function store(Request $request, $cesno){

        $request->validate([

            'parties' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'offense' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'nature_of_offense' => ['required'],
            'case_number' => ['required'],
            'date_filed' => ['required'],
            'venue' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'case_status' => ['required'],
            'date_finality' => ['required'],
            'decision' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'remarks' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            
        ]);

        $userLastName = Auth::user()->last_name;
        $userFirstName = Auth::user()->first_name;
        $userMiddleName = Auth::user()->middle_name; 
        $userNameExtension = Auth::user()->name_extension;

        $caseRecord = new CaseRecords([

            'parties' => $request->parties,
            'offence' => $request->offense,
            'nature_code' => $request->nature_of_offense,
            'case_no' => $request->case_number,
            'filed_date' => $request->date_filed,
            'venue' => $request->venue,
            'status_code' => $request->case_status,
            'finality' => $request->date_finality,
            'decision' => $request->decision,
            'remarks' => $request->remarks,
            'encoder' => $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension,
         
        ]);

        $caseRecordPersonalDataId = PersonalData::find($cesno);

        $caseRecordPersonalDataId->caseRecords()->save($caseRecord);

        return redirect()->back()->with('message', 'Successfuly Saved');

    }

    public function edit($ctrlno){

        $caseRecord = CaseRecords::find($ctrlno);

        return view('admin.201_profiling.view_profile.partials.case_records.edit', ['caseRecord'=>$caseRecord]);

    }

    public function update(Request $request, $ctrlno){

        $request->validate([

            'parties' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'offense' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'nature_of_offense' => ['required'],
            'case_number' => ['required'],
            'date_filed' => ['required'],
            'venue' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'case_status' => ['required'],
            'date_finality' => ['required'],
            'decision' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'remarks' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            
        ]);

        $caseRecord = CaseRecords::find($ctrlno);
        $caseRecord->parties = $request->parties;
        $caseRecord->offence = $request->offense;
        $caseRecord->nature_code = $request->nature_of_offense;
        $caseRecord->case_no = $request->case_number;
        $caseRecord->filed_date = $request->date_filed;
        $caseRecord->venue = $request->venue;
        $caseRecord->status_code = $request->case_status;
        $caseRecord->finality = $request->date_finality;
        $caseRecord->decision = $request->decision;
        $caseRecord->remarks = $request->remarks;
        $caseRecord->save();

        return back()->with('message', 'Updated Sucessfully');

    }

    public function destroy($ctrlno){
        
        $caseRecord = CaseRecords::find($ctrlno);
        $caseRecord->delete();

        return redirect()->back()->with('message', 'Deleted Sucessfully');

    }

    public function recentlyDeleted($cesno){

        //parent model
        $personalData = PersonalData::withTrashed()->find($cesno);

        // Access the soft deleted scholarships of the parent model
        $caseRecordTrashedRecord = $personalData->caseRecords()->onlyTrashed()->get();
 
        return view('admin.201_profiling.view_profile.partials.case_records.trashbin', compact('caseRecordTrashedRecord'));

    }

    public function restore($ctrlno){

        $caseRecord = CaseRecords::withTrashed()->find($ctrlno);
        $caseRecord->restore();

        return back()->with('message', 'Data Restored Sucessfully');

    }
 
    public function forceDelete($ctrlno){

        $caseRecord = CaseRecords::withTrashed()->find($ctrlno);
        $caseRecord->forceDelete();
  
        return back()->with('message', 'Data Permanently Deleted');

    }

}
