<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\PersonalData;

use App\Definitions\AppDefinitions;

class DashboardController extends Controller
{

    public function getAllData(Request $request){
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

        $allCookies = $request->header('cookie');


        return view('admin.dashboard', compact(
            'totalCESO',
            'totalCESOActive',
            'totalCESODeceased',
            'totalCESORetired',
            'totalCESOInactive',
            'allCookies',
        ));
    }

}