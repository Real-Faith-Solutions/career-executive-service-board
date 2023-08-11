<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use Illuminate\Http\Request;

class ViewProfile201Controller extends Controller
{
    public function index(){

       $personalData = PersonalData::paginate(25);

       return view('admin\201_profiling\view_profile\table', compact('personalData'));

    }
}
