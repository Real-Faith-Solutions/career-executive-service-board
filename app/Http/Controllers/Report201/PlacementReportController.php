<?php

namespace App\Http\Controllers\Report201;

use App\Http\Controllers\Controller;
use App\Models\PersonalData;
use Illuminate\Http\Request;

class PlacementReportController extends Controller
{
    public function index()
    {
        $personalData = PersonalData::query()
                        ->whereIn('status', ['Active', 'Retired'])
                        ->whereHas('cesStatus', function ($query) {
                            $query->where('description', 'LIKE', '%Eli%')
                                ->orWhere('description', 'LIKE', '%CES%');
                        })
                        ->paginate(25);

        return view('admin.201_profiling.reports.report_for_placement.index', [
            'personalData' => $personalData,
        ]);
    }
}
