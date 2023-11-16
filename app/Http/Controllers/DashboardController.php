<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\PersonalData;

use App\Definitions\AppDefinitions;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function getAllData(Request $request)
    {
        $totalCESO = PersonalData::query()
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%')
                    ->orWhere('description', 'LIKE', '%CES%');
            })
            ->count();
        $totalCESOActive = PersonalData::query()
            ->where('status', 'Active')
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%')
                    ->orWhere('description', 'LIKE', '%CES%');
            })
            ->count();

        $totalCESODeceased = PersonalData::query()
            ->where('status', 'Deceased')
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%')
                    ->orWhere('description', 'LIKE', '%CES%');
            })
            ->count();
        $totalCESORetired = PersonalData::query()
            ->where('status', 'Retired')
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%')
                    ->orWhere('description', 'LIKE', '%CES%');
            })
            ->count();
        $totalCESOInactive = PersonalData::query()
            ->where('status', 'Inactive')
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%')
                    ->orWhere('description', 'LIKE', '%CES%');
            })
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

        $pendingFiles = $personalData->requestFile()->count();
        $approvedFiles = $personalData->pdfFile()->count();
        $declinedFiles = $personalData->requestFile()->onlyTrashed()->count();

        // Get the current date
        $currentDate = Carbon::now();

        // Calculate the date 25 years ago
        $twentyFiveYearsAgo = $currentDate->subYears(25);

        // Count the users with age 25 and below
        $age25below = PersonalData::query()
        ->where('status', 'Active')
        ->whereDate('birthdate', '>=', $twentyFiveYearsAgo)
        ->count();

        // Get the current date
        $currentDate = Carbon::now();

        // Calculate the date 35 years ago
        $thirtyFiveYearsAgo = $currentDate->subYears(35);

        // Calculate the date 26 years ago
        $twentySixYearsAgo = $currentDate->addYears(9); // 35 - 26 = 9

        $age26to35 = PersonalData::query()
            ->where('status', 'Active')
            ->whereDate('birthdate', '>=', $thirtyFiveYearsAgo)
            ->whereDate('birthdate', '<=', $twentySixYearsAgo)
            ->count();

        $age36to45 = 30;
        $age46to55 = 40;
        $age56to65 = 50;
        $age66above = 60;

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
            'pendingFiles',
            'approvedFiles',
            'declinedFiles',
            'age25below',
            'age26to35',
            'age36to45',
            'age46to55',
            'age56to65',
            'age66above',
        ));
    }
}
