<?php

namespace App\Http\Controllers\Library201;

use App\Http\Controllers\Controller;
use App\Models\ProfileLibTblCesStatusType;
use Illuminate\Http\Request;

class ProfileLibTblCesStatusTypeController extends Controller
{
    public function index()
    {
        $profileLibTblCesStatusType = ProfileLibTblCesStatusType::paginate(25);

        return view('admin.201_library.ces_status_type.index', [
            'profileLibTblCesStatusType' => $profileLibTblCesStatusType,
        ]);
    }

    public function create()
    {
        return view('admin.201_library.ces_status_type.create');
    }
}
