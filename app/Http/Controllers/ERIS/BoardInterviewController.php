<?php

namespace App\Http\Controllers\ERIS;

use App\Http\Controllers\Controller;
use App\Models\Eris\BoardInterView;
use App\Models\Eris\ErisTblMain;
use Illuminate\Http\Request;

class BoardInterviewController extends Controller
{
    public function index($acno)
    {
        $erisTblMain = ErisTblMain::find($acno);
        $boardInterview = $erisTblMain->boardInterview()->paginate(20);

        return view('admin.eris.partials.board_interview.table', compact('acno', 'boardInterview'));
    }
}
