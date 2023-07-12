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
            'offence' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'nature_code' => ['required'],
            'case_no' => ['required', '^[a-zA-Z0-9\s\p{P}]*$'],
            'filed_date' => ['required'],
            'venue' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'status_code' => ['required'],
            'finality' => ['required'],
            'decision' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            'remarks' => ['required', 'min:2', 'max:40', 'regex:/^[a-zA-Z ]*$/'],
            
        ]);


        $userLastName = Auth::user()->last_name;

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
            'encoder' => $userLastName,
         
        ]);

        $caseRecordPersonalDataId = PersonalData::find($cesno);

        $caseRecordPersonalDataId->caseRecords()->save($caseRecord);

        return redirect()->back();

    }

    public function destroy($ctrlno){
        
        $caseRecord = CaseRecords::find($ctrlno);
        $caseRecord->delete();

        return redirect()->back();

        // $spouse->restore(); -> to restore soft deleted data

    }

}
