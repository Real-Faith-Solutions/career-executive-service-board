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

        $allCookies = $request->header('cookie');


        return view('admin.dashboard.index', compact(
            'totalCESO',
            'totalCESOActive',
            'totalCESODeceased',
            'totalCESORetired',
            'totalCESOInactive',
            'allCookies',
        ));
    }
}
