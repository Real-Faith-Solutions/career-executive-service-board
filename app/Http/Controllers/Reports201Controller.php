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

        $filter_active = $request->input('filter_active', 'false');
        $filter_inactive = $request->input('filter_inactive', 'false');
        $filter_retired = $request->input('filter_retired', 'false');
        $filter_deceased = $request->input('filter_deceased', 'false');
        $filter_retirement = $request->input('filter_retirement', 'false');
        $with_pending_case = $request->input('with_pending_case', 'false');
        $without_pending_case = $request->input('without_pending_case', 'false');

        $personalData = PersonalData::with('cesstatus')
            ->where('lastname', "LIKE" ,"%$query%")
            ->orWhere('firstname',  "LIKE","%$query%")
            ->orWhere('middlename',  "LIKE","%$query%")
            ->orWhere('name_extension',  "LIKE","%$query%")
            ->orWhere('cesno',  "LIKE","%$query%")
            ->orderBy($sortBy, $sortOrder)
            ->paginate(25);

        return view('admin\201_profiling\reports\general_report', compact('personalData', 'query', 'sortBy', 'sortOrder',
                        'filter_active', 'filter_inactive', 'filter_retired', 'filter_deceased', 'filter_retirement',
                        'with_pending_case', 'without_pending_case'));
    }
}
