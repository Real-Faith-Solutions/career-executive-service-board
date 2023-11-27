<?php

namespace App\Http\Controllers\Report201;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticalReportController extends Controller
{
    
    public function index(Request $request)
    {

        return view('admin.201_profiling.reports.statistical_reports.statistical_report');

    }

}
