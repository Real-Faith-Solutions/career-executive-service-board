<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\TrainingLibCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TrainingCategoryController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->input('sortBy', 'ctrlno'); // Default sorting GenExp_Code.
        $sortOrder = $request->input('sortOrder', 'desc'); // Default sorting order

        $trainingCategory = TrainingLibCategory::orderBy($sortBy, $sortOrder)->paginate(25);

        return view('admin.competency.partials.training_type_library.training_category.table', compact('trainingCategory', 'sortBy', 'sortOrder'));
    }

    public function create()
    {
        return view('admin.competency.partials.training_type_library.training_category.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'training_category' => ['required','unique:traininglib_tblcategory,description'],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();
        
        TrainingLibCategory::create([
            'description' => $request->training_category,
            'encoder' => $encoder,  
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

    public function update(Request $request, $ctrlno)
    {
        $request->validate([
            'description' => ['required', Rule::unique('traininglib_tblcategory')->ignore($ctrlno, 'ctrlno')],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $trainingCategory = TrainingLibCategory::find($ctrlno);
        $trainingCategory->description = $request->description;
        $trainingCategory->updated_by = $encoder;
        $trainingCategory->save();

        return to_route('training-category.index')->with('info', 'Data Update Sucessfully');
    }

    public function destroy($ctrlno)
    {
        $trainingCategory = TrainingLibCategory::find($ctrlno);
        $trainingCategory->delete();

        return back()->with('message', 'Deleted Sucessfully');
    }

    public function recentlyDeleted()
    {
        $trainingCategoryTrashedRecord = TrainingLibCategory::onlyTrashed()->paginate(25);
 
        return view('admin.competency.partials.training_type_library.training_category.trashbin', compact('trainingCategoryTrashedRecord'));
    }

    public function restore($ctrlno)
    {
        $trainingCategory = TrainingLibCategory::onlyTrashed()->find($ctrlno);
        $trainingCategory->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }
 
    public function forceDelete($ctrlno)
    {
        $trainingCategory = TrainingLibCategory::onlyTrashed()->find($ctrlno);
        $trainingCategory->forceDelete();
  
        return back()->with('info', 'Data Permanently Deleted');
    }
}
