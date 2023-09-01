<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    
    public function index(Request $request)
    {
        $query = $request->input('search');
        $sortBy = $request->input('sort_by', 'cesno'); // Default sorting by Ces No.
        $sortOrder = $request->input('sort_order', 'asc'); // Default sorting order

        $personalData = PersonalData::query()
            ->where('lastname', "LIKE" ,"%$query%")
            ->orWhere('firstname',  "LIKE","%$query%")
            ->orWhere('middleinitial',  "LIKE","%$query%")
            ->orWhere('name_extension',  "LIKE","%$query%")
            ->orderBy($sortBy, $sortOrder)
            ->paginate(25);

        return view('admin\rights_management\roles', compact('personalData', 'query', 'sortBy', 'sortOrder'));
    }

}
