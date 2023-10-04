<?php

namespace App\Http\Controllers;

use App\Models\HealthRecords;
use App\Models\MedicalHistory;
use App\Models\PersonalData;
use App\Models\PWD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HealthRecordController extends Controller
{
    public function index($cesno)
    {
        $personalData = PersonalData::find($cesno);
        $healthRecord = $personalData->healthRecords;
        $pwds = PWD::all();
        $medicalHistory = MedicalHistory::where('personal_data_cesno', $cesno)->get();

        return view('admin.201_profiling.view_profile.partials.health_records.form', compact('healthRecord' ,'cesno', 'pwds', 'medicalHistory'));
    }
    
    public function store(Request $request, $cesno)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName(); 

        $healthRecordPersonalDataId = PersonalData::findOrFail($cesno);

        $healthRecords = $healthRecordPersonalDataId->healthRecords()->updateOrCreate(
            ['cesno' => $cesno],
            [
                'blood_type' => $request->input('blood_type'),
                'marks' => $request->input('identifying_marks'),
                'handicap' => $request->input('person_with_disability'),
                'encoder' =>  $encoder,
            ]
        );
            
        return redirect()->back()->with('info', 'Successfuly Saved');
    }

    public function destroy($ctrlno)
    {
        $healthRecord = HealthRecords::find($ctrlno);
        $healthRecord->delete();

        return redirect()->back();
    }
}
