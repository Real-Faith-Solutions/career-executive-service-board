<?php

namespace App\Http\Controllers;

use App\Models\GenderByChoice;
use Illuminate\Http\Request;

class GenderByChoiceController extends Controller
{
    public function index(){
        $datas = GenderByChoice::paginate(10);
        return view('admin.201_library.gender_by_choice.index', compact('datas'));
    }
}
