<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CompetencyReportController extends Controller
{
    public function sampleReport()
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->download();
    }
}
