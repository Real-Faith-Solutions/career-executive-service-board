<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\TrainingLibCategory;
use Illuminate\Http\Request;

class TrainingCategoryController extends Controller
{
    public function index()
    {
        $trainingCategory = TrainingLibCategory::paginate(10);

        return view('admin.competency.partials.training_type_library.training_category.table', compact('trainingCategory'));
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
    
    public function edit($ctrlno)
    {
        $trainingCategory = TrainingLibCategory::find($ctrlno);

        if(!$trainingCategory){
            return redirect()->back()->with('error', 'Something went wrong');
        }

        return view('admin.competency.partials.training_type_library.training_category.edit', compact('trainingCategory'));
    }
}
