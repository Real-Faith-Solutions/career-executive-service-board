<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\PersonalData;

use App\Definitions\AppDefinitions;

class DashboardController extends Controller
{

    public function getAllData(){
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


        return view('admin.dashboard', compact(
            'totalCESO',
            'totalCESOActive',
            'totalCESODeceased',
            'totalCESORetired',
        ));
    }
    
}