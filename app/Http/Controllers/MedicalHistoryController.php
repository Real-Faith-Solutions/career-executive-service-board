<?php

namespace App\Http\Controllers;

use App\Models\MedicalHistory;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicalHistoryController extends Controller
{
    public function store(Request $request, $cesno)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName(); 

        $healthRecordPersonalDataId = PersonalData::findOrFail($cesno);

        $healthRecords = $healthRecordPersonalDataId->medicalHistoryRecords()->Create(
            [
                'illness' => $request->input('medical_condition_illness'),
                'illness_date' => $request->input('medical_date'),
                'encoder' => $encoder,
            ]
        );
            
        return redirect()->back()->with('message', 'Successfuly Saved');
    }

    public function destroy($ctrlno)
    {
        $healthRecord = MedicalHistory::find($ctrlno);
        $healthRecord->delete();

        return redirect()->back()->with('info', 'Record Deleted');
    }
}
