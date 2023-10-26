<?php

namespace App\Http\Controllers\Library201;

use App\Http\Controllers\Controller;
use App\Models\ProfileLibTblExpertiseGen;
use Illuminate\Http\Request;

class ProfileLibTblExpertiseGenController extends Controller
{
    public function index()
    {
        $profileLibTblExpertiseGen = ProfileLibTblExpertiseGen::paginate(25);

        return view('admin.201_library.expertise_general.index', [
            'profileLibTblExpertiseGen' => $profileLibTblExpertiseGen,
        ]);
    }
}
