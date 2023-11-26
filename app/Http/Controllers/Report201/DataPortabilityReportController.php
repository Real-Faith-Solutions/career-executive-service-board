<?php

namespace App\Http\Controllers\Report201;

use App\Http\Controllers\ContactInfoController;
use App\Http\Controllers\Controller;
use App\Models\Contacts;
use App\Models\PersonalData;
use App\Models\ProfileAddress;
use App\Models\ProfileLibTblCesStatus;
use App\Models\ProfileTblCesStatus;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DataPortabilityReportController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $sortBy = $request->input('sort_by', 'cesno'); // Default sorting by Ces No.
        $sortOrder = $request->input('sort_order', 'asc'); // Default sorting order

        $personalData = PersonalData::query()
            ->where('lastname', "LIKE", "%$query%")
            ->orWhere('firstname',  "LIKE", "%$query%")
            ->orWhere('middlename',  "LIKE", "%$query%")
            ->orWhere('name_extension',  "LIKE", "%$query%")
            ->orWhere('cesno',  "LIKE", "%$query%")
            ->orderBy($sortBy, $sortOrder)
            ->paginate(25);

        return view('admin/201_profiling/reports/data_portability/personal_data', 
        compact(
            'personalData', 
            'query', 
            'sortBy', 
            'sortOrder'
        ));
    }

    public function generateReport($cesno)
    {
        $personalData = PersonalData::find($cesno);
        
        $address = ProfileAddress::where('personal_data_cesno', $cesno)
                    ->where('type', 'Permanent')
                    ->get();
        
        $contactNumber = Contacts::where('personal_data_cesno', $cesno)
                        ->value('official_mobile_number1');

        $cesStatus = ProfileLibTblCesStatus::where('code', $personalData->CESStat_code)->value('description');

        $pdf = Pdf::loadView('admin.201_profiling.reports.data_portability.personal_data_pdf', [
            'personalData' => $personalData,
            'contactNumber' => $contactNumber,
            'address' => $address,
            'cesStatus' => $cesStatus,
        ]);
        // ->setPaper('a4', 'portrait');

        return $pdf->stream('data-portability-report.pdf');
    }
}
