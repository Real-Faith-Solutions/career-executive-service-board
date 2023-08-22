<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrainingCategoryController extends Controller
{
    public function index()
    {
        return view('admin.competency.partials.training_type_library.training_category.table');
    }
}
