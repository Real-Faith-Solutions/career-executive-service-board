<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use Illuminate\Http\Request;

class Reports201Controller extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $sortBy = $request->input('sort_by', 'cesno'); // Default sorting by Ces No.
        $sortOrder = $request->input('sort_order', 'asc'); // Default sorting order

        $personalData = PersonalData::with('cesstatus')
            ->where('lastname', "LIKE" ,"%$query%")
            ->orWhere('firstname',  "LIKE","%$query%")
            ->orWhere('middlename',  "LIKE","%$query%")
            ->orWhere('name_extension',  "LIKE","%$query%")
            ->orWhere('cesno',  "LIKE","%$query%")
            ->orderBy($sortBy, $sortOrder)
            ->paginate(25);

        return view('admin\201_profiling\reports\general_report', compact('personalData', 'query', 'sortBy', 'sortOrder'));
    }
}
