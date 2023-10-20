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

        // status filter group 

        $personalData->where(function ($query) use ($request) {
            $query->when($request->has('filter_active'), function ($query) {
                return $query->orWhere('status', 'Active');
            });
        
            $query->when($request->has('filter_inactive'), function ($query) {
                return $query->orWhere('status', 'Inactive');
            });
        
            $query->when($request->has('filter_retired'), function ($query) {
                return $query->orWhere('status', 'Retired');
            });
    
            $query->when($request->has('filter_deceased'), function ($query) {
                return $query->orWhere('status', 'Deceased');
            });
        });

        // pending cases group

        $personalData->where(function ($query) use ($request) {
            $query->when($request->has('with_pending_case'), function ($query) {
                // Use a subquery to get personal data with pending cases
                $query->whereHas('caseRecords.caseStatusCode', function ($subquery) {
                    $subquery->where('TITLE', 'Pending');
                });
            });
    
            $query->when($request->has('without_pending_case'), function ($query) {
                // Use a subquery to get personal data without pending cases
                $query->orWhereDoesntHave('caseRecords.caseStatusCode', function ($subquery) {
                    $subquery->where('TITLE', 'Pending');
                });
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
