<?php

namespace App\Http\Controllers;

use App\Models\ProfileLibTblExamRef;
use Illuminate\Http\Request;

class ProfileLibTblExamRefController extends Controller
{
    public function index()
    {
        $profileLibTblExamRef = ProfileLibTblExamRef::select('CODE' ,'TITLE')->paginate(25);

        return view('admin.201_library.examination.index', compact('profileLibTblExamRef'));
    }

    public function create()
    {
        return view('admin.201_library.examination.create');
    }

    public function destroy($code)
    {
        $profileLibTblExamRef = ProfileLibTblExamRef::find($code);
        $profileLibTblExamRef->delete();

        return back()->with('message', 'Deleted Sucessfully');
    }
}
