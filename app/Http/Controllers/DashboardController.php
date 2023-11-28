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

        // Calculate the date 25 years ago
        $twentyFiveYearsAgo = Carbon::today()->subYears(26)->addDay()->format('Y-m-d');

        // Count the users with age 25 and below
        $age25below = PersonalData::query()
        ->where('status', 'Active')
        ->whereDate('birthdate', '>=', $twentyFiveYearsAgo)
        ->whereHas('cesStatus', function ($query) {
            $query->where('description', 'LIKE', '%Eli%')
                ->orWhere('description', 'LIKE', '%CES%');
        })
        ->count();

        // Calculate the date 35 and 26 years ago
        $from = Carbon::today()->subYears(36)->addDay()->format('Y-m-d');
        $to = Carbon::today()->subYears(26);

        // Count the users with age 26-35
        $age26to35 = PersonalData::query()
            ->where('status', 'Active')
            ->whereBetween('birthdate',[$from, $to])
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%')
                    ->orWhere('description', 'LIKE', '%CES%');
            })
            ->count();

        // Calculate the date 45 and 36 years ago
        $from = Carbon::today()->subYears(46)->addDay()->format('Y-m-d');
        $to = Carbon::today()->subYears(36);

        // Count the users with age 36-45
        $age36to45 = PersonalData::query()
            ->where('status', 'Active')
            ->whereBetween('birthdate',[$from, $to])
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%')
                    ->orWhere('description', 'LIKE', '%CES%');
            })
            ->count();

        // Calculate the date 55 and 46 years ago
        $from = Carbon::today()->subYears(56)->addDay()->format('Y-m-d');
        $to = Carbon::today()->subYears(46);

        // Count the users with age 46-55
        $age46to55 = PersonalData::query()
            ->where('status', 'Active')
            ->whereBetween('birthdate',[$from, $to])
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%')
                    ->orWhere('description', 'LIKE', '%CES%');
            })
            ->count();

        // Calculate the date 65 and 56 years ago
        $from = Carbon::today()->subYears(66)->addDay()->format('Y-m-d');
        $to = Carbon::today()->subYears(56);

        // Count the users with age 56-65
        $age56to65 = PersonalData::query()
            ->where('status', 'Active')
            ->whereBetween('birthdate',[$from, $to])
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%')
                    ->orWhere('description', 'LIKE', '%CES%');
            })
            ->count();

        // Calculate the date 66 years ago
        $sixtySixYearsAgo = Carbon::today()->subYears(66)->startOfYear()->format('Y-m-d');

        // Count the users with age 66 and above
        $age66above = PersonalData::query()
        ->where('status', 'Active')
        ->whereDate('birthdate', '<=', $sixtySixYearsAgo)
        ->whereHas('cesStatus', function ($query) {
            $query->where('description', 'LIKE', '%Eli%')
                ->orWhere('description', 'LIKE', '%CES%');
        })
        ->count();

        // $totalAge = $age25below+$age26to35+$age36to45+$age46to55+$age56to65+$age66above;

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
            // 'totalAge',
        ));
    }
}
