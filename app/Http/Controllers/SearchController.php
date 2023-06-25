<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function postSearch(Request $request){
        $search = $request->input('search');
        $searched = PersonalData::where('lastname', 'like', "%$search%")->get();
    }
}
