<?php

namespace App\Http\Controllers;

use App\Models\ProfileLibTblLanguageRef;
use Illuminate\Http\Request;

class ProfileLibTblLanguageRefController extends Controller
{
    public function index()
    {
        $profileLibTblLanguageRef =  ProfileLibTblLanguageRef::select('title', 'code')
        ->paginate(25);

        return view('admin.201_library.langauge.index', compact('profileLibTblLanguageRef'));
    }

    public function create()
    {
        return view('admin.201_library.langauge.create');
    }
}
