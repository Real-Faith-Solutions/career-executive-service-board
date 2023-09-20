<?php

namespace App\Http\Controllers\Eris;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WrittenExamController extends Controller
{
    public function index($acno)
    {
        return view('admin.eris.partials.written_exam.table', compact('acno'));
    }

    public function create($acno)
    {
        return view('admin.eris.partials.written_exam.form', compact('acno'));
    }
}
