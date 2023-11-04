<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\PersonalData;

use App\Definitions\AppDefinitions;

class DashboardController extends Controller
{

    public function getAllData(Request $request)
    {
        $totalCESO = PersonalData::count();
        $totalCESOActive = PersonalData::query()
            ->where('status', 'Active')
            ->count();
        $totalCESODeceased = PersonalData::query()
            ->where('status', 'Deceased')
            ->count();
        $totalCESORetired = PersonalData::query()
            ->where('status', 'Retired')
            ->count();
        $totalCESOInactive = PersonalData::query()
            ->where('status', 'Inactive')
            ->count();

        // $allCookies = $request->header('cookie');

        $user = auth()->user();
        $personalData = PersonalData::where('cesno', $user->personal_data_cesno)->first();

        $examinationsTaken = $personalData->examinationTakens()->count();
        $scholarships = $personalData->scholarships()->count();
        $research = $personalData->researchAndStudies()->count();
        $cesTraining = $personalData->competencyCesTraining->where('status', 'Completed')->count();

        $otherTraining = $personalData->otherTraining()->count();
        $competencyNonCesAccreditedTraining = $personalData->competencyNonCesAccreditedTraining()->count();
        $nonCesTraining = $otherTraining + $competencyNonCesAccreditedTraining;

        $awardsAndCitations = $personalData->awardsAndCitations()->count();

        $pendingCase = 0;

        if($personalData->caseRecords->isNotEmpty()){
            foreach($personalData->caseRecords as $caseRecord){
                if($caseRecord->caseStatusCode->TITLE === 'Pending'){
                    $pendingCase++;
                }
            }
        }

        return view('admin.dashboard.index', compact(
            'totalCESO',
            'totalCESOActive',
            'totalCESODeceased',
            'totalCESORetired',
            'totalCESOInactive',
            'examinationsTaken',
            'scholarships',
            'research',
            'cesTraining',
            'nonCesTraining',
            'awardsAndCitations',
            'pendingCase',
        ));
    }
}
