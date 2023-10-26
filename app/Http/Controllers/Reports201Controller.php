<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use App\Models\ProfileLibTblAppAuthority;
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
        $authority_code = $request->input('authority_code', '');

        $profileLibTblCesStatus = ProfileLibTblCesStatus::all();
        $profileLibTblAppAuthority = ProfileLibTblAppAuthority::all();

        $personalData = PersonalData::query();

        $personalData->with(['cesStatus', 'profileTblCesStatus']);

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
                    // here i want to also get all values on offence column on caseRecords
                })->with('caseRecords');
            });
    
            $query->when($request->has('without_pending_case'), function ($query) {
                // Use a subquery to get personal data without pending cases
                $query->orWhereDoesntHave('caseRecords.caseStatusCode', function ($subquery) {
                    $subquery->where('TITLE', 'Pending');
                });
            });
        });

        // candidate for retirement 

        $personalData->where(function ($query) use ($request) {

            $query->when($request->has('filter_retirement'), function ($query) {
                $query->whereHas('planAppointee.apptStatus', function ($subquery) {
                    $subquery->where('appt_stat_code', 13);
                });
            });
        
        });

        // ces status filter 

        $personalData->where(function ($query) use ($request, $cesstat_code) {

            $query->when($request->has('cesstat_code'), function ($query) use ($cesstat_code)  {
                if($cesstat_code == "all"){
                }else{
                    return $query->where('CESStat_code', $cesstat_code);
                }
            });
        
        });

        // appointing authority filter 

        $personalData->where(function ($query) use ($request, $authority_code) {

            $query->when($request->has('authority_code'), function ($query) use ($authority_code) {

                if($authority_code == "all"){
                    
                }else{
                    $query->whereHas('profileTblCesStatus', function ($subquery) use ($authority_code) {
                        $subquery->where('official_code', $authority_code);
                    });
                }
                
            });
        
        });
        
        $personalData->orderBy($sortBy, $sortOrder);

        $personalData = $personalData->paginate(25);

        // dd($personalData);

        return view('admin\201_profiling\reports\general_report', compact('personalData', 'query', 'sortBy', 'sortOrder',
                        'filter_active', 'filter_inactive', 'filter_retired', 'filter_deceased', 'filter_retirement',
                        'with_pending_case', 'without_pending_case', 'profileLibTblCesStatus', 'cesstat_code', 
                        'profileLibTblAppAuthority', 'authority_code'));
    }

    public function generatePdf($sortBy, $sortOrder, $filter_active, $filter_inactive, $filter_retired,
                        $filter_deceased, $filter_retirement, $with_pending_case, $without_pending_case,
                        $cesstat_code, $authority_code,)
    {

        $sortBy = $sortBy ?? 'cesno';
        $sortOrder = $sortOrder ?? 'asc';

        $filter_active = $filter_active ?? 'false';
        $filter_inactive = $filter_inactive ?? 'false';
        $filter_retired = $filter_retired ?? 'false';
        $filter_deceased = $filter_deceased ?? 'false';
        $filter_retirement = $filter_retirement ?? 'false';
        $with_pending_case = $with_pending_case ?? 'false';
        $without_pending_case = $without_pending_case ?? 'false';
        $cesstat_code = $cesstat_code ?? 'false';
        $authority_code = $authority_code ?? 'false';

        $search = $request->input('search');

        $profileLibCitiesSearchResult = ProfileLibCities::where('name', $search)->first();

        if($profileLibCitiesSearchResult != null)
        {
            $trainingVenueManagerByCity = CompetencyTrainingVenueManager::where('city_code', $profileLibCitiesSearchResult->city_code)
            ->get(['name', 'no_street', 'brgy', 'city_code', 'contactno', 'emailadd', 'contactperson']);
        }
        else
        {
            // get all venues
            $trainingVenueManagerByCity = CompetencyTrainingVenueManager::get(['name', 'no_street', 'brgy', 'city_code', 'contactno', 'emailadd', 'contactperson']);
        }
               
        $pdf = Pdf::loadView('admin.competency.reports.training_venue_manager.report_pdf_city', compact('trainingVenueManagerByCity', 'search'))->setPaper('a4', 'landscape');
        return $pdf->stream('training-venue-manager-report-by-city.pdf');
    }

}
