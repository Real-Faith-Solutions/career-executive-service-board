<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use App\Models\ProfileLibTblCesStatus;
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
        $cesstat_code = $request->input('cesstat_code', '');

        $profileLibTblCesStatus = ProfileLibTblCesStatus::all();

        // $personalData = PersonalData::with('cesstatus')
        //     ->when($filter_active == "true", function ($query) use ($request) {
        //         $query->where('status', 'Active');
        //     })
        //     ->when($filter_inactive == "true", function ($query) use ($request) {
        //         $query->where('status', 'Inactive');
        //     })
        //     ->when($filter_retired == "true", function ($query) use ($request) {
        //         $query->where('status', 'Retired');
        //     })
        //     ->orderBy($sortBy, $sortOrder)
        //     ->paginate(25);

        $personalData = PersonalData::query();

        $personalData->with('cesStatus', 'caseRecords');

        $personalData->when($request->has('filter_active'), function ($query) {
            return $query->orWhere('status', 'Active');
        });
    
        $personalData->when($request->has('filter_inactive'), function ($query) {
            return $query->orWhere('status', 'Inactive');
        });
    
        $personalData->when($request->has('filter_retired'), function ($query) {
            return $query->orWhere('status', 'Retired');
        });

        $personalData->when($request->has('filter_deceased'), function ($query) {
            return $query->orWhere('status', 'Deceased');
        });

        // $personalData->when($request->has('with_pending_case'), function ($query) {
        //     // here i want to get all personal data that has a pending case.
        //     // the CaseRecords model is child of PersonalData model, 
        //     // on CaseRecords it has a child caseStatusCode
        //     // on caseStatusCode theres a column named TITLE
        //     // now i want to get all personal data that has a Pending TITLE
        // });

        $personalData->when($request->has('with_pending_case'), function ($query) {
            // Use a subquery to get personal data with pending cases
            $query->orWhereHas('caseRecords.caseStatusCode', function ($subquery) {
                $subquery->where('TITLE', 'Pending');
            });
        });

        $personalData->when($request->has('without_pending_case'), function ($query) {
            // Use a subquery to get personal data without pending cases
            $query->orWhereDoesntHave('caseRecords.caseStatusCode', function ($subquery) {
                $subquery->where('TITLE', 'Pending');
            });
        });
        
        $personalData->orderBy($sortBy, $sortOrder);

        $personalData = $personalData->paginate(25);

        // dd($personalData);

        return view('admin\201_profiling\reports\general_report', compact('personalData', 'query', 'sortBy', 'sortOrder',
                        'filter_active', 'filter_inactive', 'filter_retired', 'filter_deceased', 'filter_retirement',
                        'with_pending_case', 'without_pending_case', 'profileLibTblCesStatus', 'cesstat_code'));
    }
}
