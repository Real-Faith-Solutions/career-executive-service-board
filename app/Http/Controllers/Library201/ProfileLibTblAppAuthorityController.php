<?php

namespace App\Http\Controllers\Library201;

use App\Http\Controllers\Controller;
use App\Models\ProfileLibTblAppAuthority;
use Illuminate\Http\Request;

class ProfileLibTblAppAuthorityController extends Controller
{
    public function index()
    {
        $profileLibTblAppAuthority = ProfileLibTblAppAuthority::paginate(25);

        return view('admin.201_library.appointing_authority.index', [
            'profileLibTblAppAuthority' => $profileLibTblAppAuthority,
        ]);
    }
}
