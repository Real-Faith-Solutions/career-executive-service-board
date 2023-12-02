<?php

namespace App\Http\Controllers\Report201;

use App\Http\Controllers\Controller;
use App\Models\PersonalData;
use App\Models\ProfileLibTblEducDegree;
use App\Models\ProfileLibTblExpertiseSpec;
use Illuminate\Http\Request;

class PlacementReportController extends Controller
{
    // App\Models
    private ProfileLibTblExpertiseSpec $profileLibTblExpertiseSpec;
    private ProfileLibTblEducDegree $profileLibTblEducDegree;

    public function __construct()
    {
        $this->profileLibTblExpertiseSpec = new ProfileLibTblExpertiseSpec();
        $this->profileLibTblEducDegree = new ProfileLibTblEducDegree();
    }

    public function index(Request $request)
    {
        $sortBy = $request->input('sortBy', 'cesno'); // Default sorting we_date.
        $sortOrder = $request->input('sortOrder', 'asc'); // Default sorting order

        $expertise = $request->input('expertise');
        $degree = $request->input('degree');
    
        $personalData = PersonalData::query()
        ->whereIn('status', ['Active', 'Retired'])
        ->whereHas('cesStatus', function ($query) {
            $query->where('description', 'LIKE', '%Eli%')
            ->orWhere('description', 'LIKE', '%CES%');
        })
        ->when($expertise, function ($query) use ($expertise) {
            return $query->whereHas('expertise', function ($q) use($expertise) {
                $q->where('SpeExp_Code', $expertise);
            });
        })
        ->when($degree, function ($query) use ($degree) {
            return $query->whereHas('educations', function ($q) use($degree) {
                $q->where('degree_code', $degree);
            });
        })
        ->when(!$expertise || !$degree, function ($query) {
            return $query->with('expertise','educations');
        })
        ->orderBy($sortBy, $sortOrder)
        ->paginate(25);

        return view('admin.201_profiling.reports.report_for_placement.index', [
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
            'expertised' => $expertise,
            'degree' => $degree,
            'personalData' => $personalData,
            'profileTblExpertise' => $this->profileLibTblExpertiseSpec->expertiseLibrary(),
            'profileLibTblEducDegree' => $this->profileLibTblEducDegree->educationDegreeLibrary(),
        ]);
    }
}
