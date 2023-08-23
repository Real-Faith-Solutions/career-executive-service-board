<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use Illuminate\Http\Request;

class ViewProfile201Controller extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $personalData = PersonalData::query()
            ->where('lastname', "LIKE" ,"%$query%")
            ->orWhere('firstname',  "LIKE","%$query%")
            ->orWhere('middleinitial',  "LIKE","%$query%")
            ->orWhere('name_extension',  "LIKE","%$query%")
            ->paginate(25);

       return view('admin\201_profiling\view_profile\table', compact('personalData', 'query'));
    }
}