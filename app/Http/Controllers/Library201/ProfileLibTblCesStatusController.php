<?php

namespace App\Http\Controllers\Library201;

use App\Http\Controllers\Controller;
use App\Models\ProfileLibTblCesStatus;
use Illuminate\Http\Request;

class ProfileLibTblCesStatusController extends Controller
{
    public function index()
    {
        $profileLibTblCesStatus = ProfileLibTblCesStatus::paginate(25);

        return view('admin.201_library.ces_status.index', [
            'profileLibTblCesStatus' => $profileLibTblCesStatus
        ]);

    }

    public function create()
    {

    }
}
