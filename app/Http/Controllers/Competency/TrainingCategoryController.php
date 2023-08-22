<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\TrainingLibCategory;
use Illuminate\Http\Request;

class TrainingCategoryController extends Controller
{
    public function index()
    {
        return view('admin.competency.partials.training_type_library.training_category.table');
    }

    public function create()
    {
        return view('admin.competency.partials.training_type_library.training_category.form');
    }

    public function store(Request $request)
    {
        $request->validate([

            'training_category' => ['unique:traininglib_tblcategory,description'],
            
        ]);

        TrainingLibCategory::create([

            'description' => $request->training_category,
            'encoder' => 'sample encoder',  

        ]);

        return to_route('training-category.index')->with('message', 'Save Sucessfully');
    }
}
