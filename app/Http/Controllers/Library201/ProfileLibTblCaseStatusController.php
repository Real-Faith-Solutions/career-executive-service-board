<?php

namespace App\Http\Controllers\Library201;

use App\Http\Controllers\Controller;
use App\Models\ProfileLibTblCaseStatus;
use Illuminate\Http\Request;

class ProfileLibTblCaseStatusController extends Controller
{
    public function index()
    {
        $profileLibTblCaseStatus = ProfileLibTblCaseStatus::paginate(25);

        return view('admin.201_library.case_status/index', [
            'profileLibTblCaseStatus' => $profileLibTblCaseStatus
        ]);
    }
}
