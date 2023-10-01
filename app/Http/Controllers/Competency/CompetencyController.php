<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\Contacts;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CompetencyController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'cesno'); // Default sorting by cesno
        $sortOrder = $request->input('sort_order', 'asc'); // Default sorting order ascending

        $competencyData = PersonalData::query()
            ->where('lastname', "LIKE" ,"%$search%")
            ->orWhere('firstname',  "LIKE","%$search%")
            ->orWhere('middlename',  "LIKE","%$search%")
            ->orWhere('name_extension',  "LIKE","%$search%")
            ->orWhere('cesno',  "LIKE","%$search%")
            ->orderBy($sortBy, $sortOrder)
            ->paginate(25);

        return view('admin.competency.view_profile.table', compact('competencyData', 'search', 'sortBy', 'sortOrder'));
    }
}
