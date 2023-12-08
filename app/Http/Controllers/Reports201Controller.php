<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use App\Models\ProfileLibTblAppAuthority;
use App\Models\ProfileLibTblCesStatus;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class Reports201Controller extends Controller
{
    public function index(Request $request)
    {

        $sortBy = $request->input('sort_by', 'cesno'); // Default sorting by Ces No.
        $sortOrder = $request->input('sort_order', 'asc'); // Default sorting order

        $filter_active = $request->input('filter_active', 'false');
        $filter_inactive = $request->input('filter_inactive', 'false');
        $filter_retired = $request->input('filter_retired', 'false');
        $filter_deceased = $request->input('filter_deceased', 'false');
        $filter_retirement = $request->input('filter_retirement', 'false');
        $with_pending_case = $request->input('with_pending_case', 'false');
        $without_pending_case = $request->input('without_pending_case', 'false');
        $cesstat_code = $request->input('cesstat_code', 'false');
        $authority_code = $request->input('authority_code', 'false');

        $profileLibTblCesStatus = ProfileLibTblCesStatus::all();
        $profileLibTblAppAuthority = ProfileLibTblAppAuthority::all();

        $personalData = PersonalData::query();

        $personalData->with(['cesStatus', 'profileTblCesStatus']);

        // status filter group 

        $personalData->where(function ($query) use ($request, $filter_active, $filter_inactive, $filter_retired, $filter_deceased) {
            $query->when($request->has('filter_active') && $filter_active !== 'false', function ($query) {
                return $query->orWhere('status', 'Active');
            });
        
            $query->when($request->has('filter_inactive') && $filter_inactive !== 'false', function ($query) {
                return $query->orWhere('status', 'Inactive');
            });
        
            $query->when($request->has('filter_retired') && $filter_retired !== 'false', function ($query) {
                return $query->orWhere('status', 'Retired');
            });
    
            $query->when($request->has('filter_deceased') && $filter_deceased !== 'false', function ($query) {
                return $query->orWhere('status', 'Deceased');
            });
        });

        // pending cases group

        $personalData->where(function ($query) use ($request, $with_pending_case, $without_pending_case) {
            $query->when($request->has('with_pending_case') && $with_pending_case !== 'false', function ($query) {
                // Use a subquery to get personal data with pending cases
                $query->whereHas('caseRecords.caseStatusCode', function ($subquery) {
                    $subquery->where('TITLE', 'Pending');
                })->with('caseRecords');
            });
    
            $query->when($request->has('without_pending_case') && $without_pending_case !== 'false', function ($query) {
                // Use a subquery to get personal data without pending cases
                $query->orWhereDoesntHave('caseRecords.caseStatusCode', function ($subquery) {
                    $subquery->where('TITLE', 'Pending');
                });
            });
        });

        // candidate for retirement 

        $personalData->where(function ($query) use ($request, $filter_retirement) {

            $query->when($request->has('filter_retirement') && $filter_retirement !== 'false', function ($query) {
                $query->whereHas('planAppointee.apptStatus', function ($subquery) {
                    $subquery->where('appt_stat_code', 13);
                });
            });
        
        });

        // ces status filter 

        $personalData->where(function ($query) use ($request, $cesstat_code) {

            $query->when($request->has('cesstat_code') && $cesstat_code !== 'false', function ($query) use ($cesstat_code)  {
                if($cesstat_code == "all"){
                }elseif($cesstat_code == "cesos"){
                    $cesstat_code = [1, 2, 3, 4, 5, 6];
                    return $query->whereIn('CESStat_code', $cesstat_code);
                }elseif($cesstat_code == "cesoseli"){
                    $cesstat_code = [1, 2, 3, 4, 5, 6, 7];
                    return $query->whereIn('CESStat_code', $cesstat_code);
                }else{
                    return $query->where('CESStat_code', $cesstat_code);
                }
            });
        
        });

        // appointing authority filter 
        // there is a bug when the user have multiple ces status
        $personalData->where(function ($query) use ($request, $authority_code) {

            $query->when($request->has('authority_code') && $authority_code !== 'false', function ($query) use ($authority_code) {

                if ($authority_code !== "all") {
                    $query->whereHas('latestProfileTblCesStatus', function ($subquery) use ($authority_code) {
                        $subquery->where('official_code', $authority_code);
                    });
                }
        
            });
        
        });
        
        $personalData->orderBy($sortBy, $sortOrder);

        $personalData = $personalData->paginate(25);

        // dd($personalData);

        return view('admin.201_profiling.reports.general_report', compact('personalData', 'sortBy', 'sortOrder',
                        'filter_active', 'filter_inactive', 'filter_retired', 'filter_deceased', 'filter_retirement',
                        'with_pending_case', 'without_pending_case', 'profileLibTblCesStatus', 'cesstat_code', 
                        'profileLibTblAppAuthority', 'authority_code'));
    }

    public function generatePdf(Request $request, $recordsPerPartition, $partitionNumber, $skippedData, $filename,
                        $sortBy, $sortOrder, $filter_active, $filter_inactive, $filter_retired,
                        $filter_deceased, $filter_retirement, $with_pending_case, $without_pending_case,
                        $cesstat_code, $authority_code)
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

        $profileLibTblCesStatus = ProfileLibTblCesStatus::all();
        $profileLibTblAppAuthority = ProfileLibTblAppAuthority::all();

        // *
        // start of filters, conditions, operations, sortings
        // *

        $personalData = PersonalData::query();

        $personalData->with(['cesStatus', 'profileTblCesStatus']);

        // status filter group 

        $personalData->where(function ($query) use ($filter_active, $filter_inactive, $filter_retired, $filter_deceased) {
            $query->when($filter_active !== 'false', function ($query) {
                return $query->orWhere('status', 'Active');
            });
        
            $query->when($filter_inactive !== 'false', function ($query) {
                return $query->orWhere('status', 'Inactive');
            });
        
            $query->when($filter_retired !== 'false', function ($query) {
                return $query->orWhere('status', 'Retired');
            });
    
            $query->when($filter_deceased !== 'false', function ($query) {
                return $query->orWhere('status', 'Deceased');
            });
        });

        // pending cases group

        $personalData->where(function ($query) use ($with_pending_case, $without_pending_case) {
            $query->when($with_pending_case !== 'false', function ($query) {
                // Use a subquery to get personal data with pending cases
                $query->whereHas('caseRecords.caseStatusCode', function ($subquery) {
                    $subquery->where('TITLE', 'Pending');
                    // here i want to also get all values on offence column on caseRecords
                })->with('caseRecords');
            });
    
            $query->when($without_pending_case !== 'false', function ($query) {
                // Use a subquery to get personal data without pending cases
                $query->orWhereDoesntHave('caseRecords.caseStatusCode', function ($subquery) {
                    $subquery->where('TITLE', 'Pending');
                });
            });
        });

        // candidate for retirement 

        $personalData->where(function ($query) use ($filter_retirement) {

            $query->when($filter_retirement !== 'false', function ($query) {
                $query->whereHas('planAppointee.apptStatus', function ($subquery) {
                    $subquery->where('appt_stat_code', 13);
                });
            });
        
        });

        // ces status filter 

        $personalData->where(function ($query) use ($cesstat_code) {

            $query->when($cesstat_code !== 'false', function ($query) use ($cesstat_code)  {
                if($cesstat_code == "all"){
                }elseif($cesstat_code == "cesos"){
                    $cesstat_code = [1, 2, 3, 4, 5, 6];
                    return $query->whereIn('CESStat_code', $cesstat_code);
                }elseif($cesstat_code == "cesoseli"){
                    $cesstat_code = [1, 2, 3, 4, 5, 6, 7];
                    return $query->whereIn('CESStat_code', $cesstat_code);
                }else{
                    return $query->where('CESStat_code', $cesstat_code);
                }
            });
        
        });

        // appointing authority filter 

        $personalData->where(function ($query) use ($authority_code) {

            $query->when($authority_code !== 'false', function ($query) use ($authority_code) {

                if($authority_code == "all"){
                    
                }else{
                    $query->whereHas('profileTblCesStatus', function ($subquery) use ($authority_code) {
                        $subquery->where('official_code', $authority_code);
                    });
                }
                
            });
        
        });
        
        $personalData->orderBy($sortBy, $sortOrder);

        // *
        // end of filters, conditions, operations, sortings
        // *

        // getting the data and applying the skipped data and records per partition to get the correct part of the report
        $personalData = $personalData->skip($skippedData)->take($recordsPerPartition)->get();

        $pdf = Pdf::loadView('admin.201_profiling.reports.general_report_pdf', 
        compact('personalData', 'sortBy', 'sortOrder', 'filter_active', 
            'filter_inactive', 'filter_retired', 'filter_deceased', 'filter_retirement',
            'with_pending_case', 'without_pending_case', 'profileLibTblCesStatus', 'cesstat_code', 
            'profileLibTblAppAuthority', 'authority_code', 'skippedData'
        ))
        ->setPaper('a4', 'portrait');
        return $pdf->stream($filename);
    }

    public function generateDownloadLinks(Request $request, $sortBy, $sortOrder, $filter_active, $filter_inactive, $filter_retired,
                        $filter_deceased, $filter_retirement, $with_pending_case, $without_pending_case,
                        $cesstat_code, $authority_code)
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

        // *
        // start of filters, conditions, operations, sortings
        // *

        $personalData = PersonalData::query();

        $personalData->with(['cesStatus', 'profileTblCesStatus']);
        
        // status filter group 

        $personalData->where(function ($query) use ($filter_active, $filter_inactive, $filter_retired, $filter_deceased) {
            $query->when($filter_active !== 'false', function ($query) {
                return $query->orWhere('status', 'Active');
            });
        
            $query->when($filter_inactive !== 'false', function ($query) {
                return $query->orWhere('status', 'Inactive');
            });
        
            $query->when($filter_retired !== 'false', function ($query) {
                return $query->orWhere('status', 'Retired');
            });
    
            $query->when($filter_deceased !== 'false', function ($query) {
                return $query->orWhere('status', 'Deceased');
            });
        });

        // pending cases group

        $personalData->where(function ($query) use ($with_pending_case, $without_pending_case) {
            $query->when($with_pending_case !== 'false', function ($query) {
                // Use a subquery to get personal data with pending cases
                $query->whereHas('caseRecords.caseStatusCode', function ($subquery) {
                    $subquery->where('TITLE', 'Pending');
                    // here i want to also get all values on offence column on caseRecords
                })->with('caseRecords');
            });
    
            $query->when($without_pending_case !== 'false', function ($query) {
                // Use a subquery to get personal data without pending cases
                $query->orWhereDoesntHave('caseRecords.caseStatusCode', function ($subquery) {
                    $subquery->where('TITLE', 'Pending');
                });
            });
        });

        // candidate for retirement 

        $personalData->where(function ($query) use ($filter_retirement) {

            $query->when($filter_retirement !== 'false', function ($query) {
                $query->whereHas('planAppointee.apptStatus', function ($subquery) {
                    $subquery->where('appt_stat_code', 13);
                });
            });
        
        });

        // ces status filter 

        $personalData->where(function ($query) use ($cesstat_code) {

            $query->when($cesstat_code !== 'false', function ($query) use ($cesstat_code)  {
                if($cesstat_code == "all"){
                }elseif($cesstat_code == "cesos"){
                    $cesstat_code = [1, 2, 3, 4, 5, 6];
                    return $query->whereIn('CESStat_code', $cesstat_code);
                }elseif($cesstat_code == "cesoseli"){
                    $cesstat_code = [1, 2, 3, 4, 5, 6, 7];
                    return $query->whereIn('CESStat_code', $cesstat_code);
                }else{
                    return $query->where('CESStat_code', $cesstat_code);
                }
            });
        
        });

        // appointing authority filter 

        $personalData->where(function ($query) use ($authority_code) {

            $query->when($authority_code !== 'false', function ($query) use ($authority_code) {

                if($authority_code == "all"){
                    
                }else{
                    $query->whereHas('profileTblCesStatus', function ($subquery) use ($authority_code) {
                        $subquery->where('official_code', $authority_code);
                    });
                }
                
            });
        
        });
        
        $personalData->orderBy($sortBy, $sortOrder);

        // *
        // end of filters, conditions, operations, sortings
        // *


        // Set the maximum number of records per partition
        $recordsPerPartition = 500;

        // number of partitions
        $partitionNumber = 0;

        // number of data that will be skipped
        $skippedData = 0;

        // Initialize an array to store download links
        $downloadLinks = [];

        // Chunk the results based on the defined limit (don't remove the &$downloadLinks, $recordsPerPartition, $partitionNumber, $skippedData; 
        // the other parameter here is based on your applied filters change it according to your needs)
        $personalData->chunk($recordsPerPartition, function ($partition) use (&$downloadLinks, $recordsPerPartition, &$partitionNumber, &$skippedData, $sortBy, $sortOrder, $filter_active, $filter_inactive, $filter_retired, $filter_deceased, $filter_retirement, $with_pending_case, $without_pending_case, $cesstat_code, $authority_code) {

            // calculating how many data should be skipped for this partition
            $skippedData = $recordsPerPartition * $partitionNumber;

            // incrementing the partition number
            $partitionNumber++;

            // filename for this partition (concatinate the partition number as part number)
            $filename = '201-profiling-general-reports-part'.$partitionNumber.'.pdf';

            // Create a route to handle the download action for each partition
            // don't remove the $recordsPerPartition, $partitionNumber, $skippedData, $filename
            $downloadRoute = route('general-reports.pdf', 
                                ['recordsPerPartition' => $recordsPerPartition, 'partitionNumber' => $partitionNumber, 'skippedData' => $skippedData, 'filename' => $filename, 
                                'sortBy' => $sortBy, 'sortOrder' => $sortOrder, 'filter_active' => $filter_active, 'filter_inactive' => $filter_inactive, 
                                'filter_retired' => $filter_retired, 'filter_deceased' => $filter_deceased, 'filter_retirement' => $filter_retirement, 
                                'with_pending_case' => $with_pending_case, 'without_pending_case' => $without_pending_case, 
                                'cesstat_code' => $cesstat_code, 'authority_code' => $authority_code]);

            // Store the download link in the array
            $downloadLinks[] = [
                'url' => $downloadRoute,
                'label' => '201 Profiling General Reports Part '.$partitionNumber,
            ];

        });

        // Pass the download links to the next download page
        return view('admin.201_profiling.reports.download_general_reports', compact('downloadLinks'));

    }

}
