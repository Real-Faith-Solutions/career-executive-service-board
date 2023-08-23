<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use Illuminate\Http\Request;

class PersonalDataController extends Controller
{
    public function show($cesno)
    {
        $mainProfile = PersonalData::find($cesno);

        return view('admin.201_profiling.view_profile.partials.personal_data.form', 
        compact('mainProfile', 'cesno'));   
    }
}
