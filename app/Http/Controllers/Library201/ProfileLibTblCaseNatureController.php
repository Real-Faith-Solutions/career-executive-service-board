<?php

namespace App\Http\Controllers\Library201;

use App\Http\Controllers\Controller;
use App\Models\ProfileLibTblCaseNature;
use Illuminate\Http\Request;

class ProfileLibTblCaseNatureController extends Controller
{
    public function index()
    {
        $profileLibTblCaseNature = ProfileLibTblCaseNature::paginate(25);

        return view('admin.201_library.case_nature.index', [
            'profileLibTblCaseNature' => $profileLibTblCaseNature,
        ]);
    }
}
