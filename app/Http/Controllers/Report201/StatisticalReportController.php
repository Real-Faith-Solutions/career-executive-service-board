<?php

namespace App\Http\Controllers\Report201;

use App\Http\Controllers\Controller;
use App\Models\PersonalData;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticalReportController extends Controller
{
    
    public function index(Request $request)
    {

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

        $totalActiveCES = PersonalData::query()
            ->where('status', 'Active')
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%CES%');
            })->count();

        $totalActiveEligibles = PersonalData::query()
            ->where('status', 'Active')
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%');
            })->count();

        $totalRetiredCES = PersonalData::query()
            ->where('status', 'Retired')
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%CES%');
            })->count();

        $totalRetiredEligibles = PersonalData::query()
            ->where('status', 'Retired')
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%');
            })->count();

        $totalDeceasedCES = PersonalData::query()
            ->where('status', 'Deceased')
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%CES%');
            })->count();

        $totalDeceasedEligibles = PersonalData::query()
            ->where('status', 'Deceased')
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%');
            })->count();

        $totalInactiveCES = PersonalData::query()
            ->where('status', 'Inactive')
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%CES%');
            })->count();

        $totalInactiveEligibles = PersonalData::query()
            ->where('status', 'Inactive')
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%');
            })->count();

        $totalCESO = $totalCESOActive + $totalCESORetired;
        $totalActiveRetiredCES = $totalActiveCES + $totalRetiredCES;
        $totalActiveRetiredEligibles = $totalActiveEligibles + $totalRetiredEligibles;

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

        return view('admin.201_profiling.reports.statistical_reports.statistical_report', compact(
            'totalActiveRetiredEligibles',
            'totalActiveRetiredCES',
            'totalInactiveEligibles',
            'totalInactiveCES',
            'totalDeceasedEligibles',
            'totalDeceasedCES',
            'totalRetiredEligibles',
            'totalRetiredCES',
            'totalActiveCES',
            'totalActiveEligibles',
            'totalCESO',
            'totalCESOActive',
            'totalCESODeceased',
            'totalCESORetired',
            'totalCESOInactive',
            'age25below',
            'age26to35',
            'age36to45',
            'age46to55',
            'age56to65',
            'age66above',
            // 'totalAge',
        ));

    }

    public function generatePdf(Request $request)
    {

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

        $totalActiveCES = PersonalData::query()
            ->where('status', 'Active')
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%CES%');
            })->count();

        $totalActiveEligibles = PersonalData::query()
            ->where('status', 'Active')
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%');
            })->count();

        $totalRetiredCES = PersonalData::query()
            ->where('status', 'Retired')
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%CES%');
            })->count();

        $totalRetiredEligibles = PersonalData::query()
            ->where('status', 'Retired')
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%');
            })->count();

        $totalDeceasedCES = PersonalData::query()
            ->where('status', 'Deceased')
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%CES%');
            })->count();

        $totalDeceasedEligibles = PersonalData::query()
            ->where('status', 'Deceased')
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%');
            })->count();

        $totalInactiveCES = PersonalData::query()
            ->where('status', 'Inactive')
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%CES%');
            })->count();

        $totalInactiveEligibles = PersonalData::query()
            ->where('status', 'Inactive')
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%');
            })->count();

        $totalCESO = $totalCESOActive + $totalCESORetired;
        $totalActiveRetiredCES = $totalActiveCES + $totalRetiredCES;
        $totalActiveRetiredEligibles = $totalActiveEligibles + $totalRetiredEligibles;

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

        // CES Status Summary

        // Count the users who's currently active and CESO I
        $ceso1 = PersonalData::query()
        ->where('status', 'Active')
        ->whereHas('cesStatus', function ($query) {
            $query->where('description', '=', 'CESO I');
        })
        ->count();

        // Count the users who's currently active and CESO II
        $ceso2 = PersonalData::query()
        ->where('status', 'Active')
        ->whereHas('cesStatus', function ($query) {
            $query->where('description', '=', 'CESO II');
        })
        ->count();

        // Count the users who's currently active and CESO III
        $ceso3 = PersonalData::query()
        ->where('status', 'Active')
        ->whereHas('cesStatus', function ($query) {
            $query->where('description', '=', 'CESO III');
        })
        ->count();

        // Count the users who's currently active and CESO IV
        $ceso4 = PersonalData::query()
        ->where('status', 'Active')
        ->whereHas('cesStatus', function ($query) {
            $query->where('description', '=', 'CESO IV');
        })
        ->count();

        // Count the users who's currently active and CESO V
        $ceso5 = PersonalData::query()
        ->where('status', 'Active')
        ->whereHas('cesStatus', function ($query) {
            $query->where('description', '=', 'CESO V');
        })
        ->count();

        // Count the users who's currently active and CESO VI
        $ceso6 = PersonalData::query()
        ->where('status', 'Active')
        ->whereHas('cesStatus', function ($query) {
            $query->where('description', '=', 'CESO VI');
        })
        ->count();

        // Count the users who's currently active and CESO Eligible
        $eligible = PersonalData::query()
        ->where('status', 'Active')
        ->whereHas('cesStatus', function ($query) {
            $query->where('description', '=', 'Eligible');
        })
        ->count();

        // Count the users who's currently active and CESO CSEE
        $csee = PersonalData::query()
        ->where('status', 'Active')
        ->whereHas('cesStatus', function ($query) {
            $query->where('description', '=', 'CSEE');
        })
        ->count();

        // Count the users who's currently active and CESO CSEE
        $noStatus = PersonalData::query()
        ->where('status', 'Active')
        ->whereHas('cesStatus', function ($query) {
            $query->where('description', '=', '-');
        })
        ->count();

        $male = PersonalData::query()
            ->where('status', 'Active')
            ->where('gender', 'Male')
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%')
                    ->orWhere('description', 'LIKE', '%CES%');
            })
            ->count();

        $female = PersonalData::query()
            ->where('status', 'Active')
            ->where('gender', 'Female')
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%')
                    ->orWhere('description', 'LIKE', '%CES%');
            })
            ->count();

        $preferNotToSay = PersonalData::query()
            ->where('status', 'Active')
            ->where('gender', 'Prefer Not to Say')
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%')
                    ->orWhere('description', 'LIKE', '%CES%');
            })
            ->count();

        $nonGender = PersonalData::query()
            ->where('status', 'Active')
            ->where('gender', '')
            ->whereHas('cesStatus', function ($query) {
                $query->where('description', 'LIKE', '%Eli%')
                    ->orWhere('description', 'LIKE', '%CES%');
            })
            ->count();

        $pdf = Pdf::loadView('admin.201_profiling.reports.statistical_reports.statistical_report_pdf', compact(
            'totalActiveRetiredEligibles',
            'totalActiveRetiredCES',
            'totalInactiveEligibles',
            'totalInactiveCES',
            'totalDeceasedEligibles',
            'totalDeceasedCES',
            'totalRetiredEligibles',
            'totalRetiredCES',
            'totalActiveCES',
            'totalActiveEligibles',
            'totalCESO',
            'totalCESOActive',
            'totalCESODeceased',
            'totalCESORetired',
            'totalCESOInactive',
            'age25below',
            'age26to35',
            'age36to45',
            'age46to55',
            'age56to65',
            'age66above',
            'ceso1',
            'ceso2',
            'ceso3',
            'ceso4',
            'ceso5',
            'ceso6',
            'eligible',
            'csee',
            'noStatus',
            'male',
            'female',
            'preferNotToSay',
            'nonGender',
        ))
        ->setPaper('a4', 'portrait');
        return $pdf->stream('201-profiling-general-reports.pdf');

    }

}
