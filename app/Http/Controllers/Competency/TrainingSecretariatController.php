<?php

namespace App\Http\Controllers\Competency;

use App\Http\Controllers\Controller;
use App\Models\TrainingSecretariat;
use Illuminate\Http\Request;

class TrainingSecretariatController extends Controller
{
    public function index()
    {
        $trainingSecretariat = TrainingSecretariat::paginate(10);

        return view('admin.competency.partials.training_type_library.training_secretariat.table', compact('trainingSecretariat'));
    }

    public function create()
    {
        return view('admin.competency.partials.training_type_library.training_secretariat.form');
    }

    public function store(Request $request)
    {
        TrainingSecretariat::create([
            'description' => $request->description,
            'encoder' => 'sample ni manuel',
        ]);

        return to_route('training-secretariat.index')->with('message', 'Save Sucessfully');
    }

    public function edit($ctrlno)
    {
        $trainingSecretariat = TrainingSecretariat::find($ctrlno);

        return view('admin.competency.partials.training_type_library.training_secretariat.edit', compact('trainingSecretariat'));
    }

    public function update(Request $request, $ctrlno)
    {
        $trainingSecretariat = TrainingSecretariat::find($ctrlno);
        $trainingSecretariat->description = $request->description;
        $trainingSecretariat->save();

        return to_route('training-secretariat.index')->with('info', 'Data Update Sucessfully');
    }

    public function destroy($ctrlno)
    {
        $trainingSecretariat = TrainingSecretariat::find($ctrlno);
        $trainingSecretariat->delete();

        return back()->with('message', 'Deleted Sucessfully');
    }

    public function recentlyDeleted()
    {
        $trainingSecretariatTrashedRecord = TrainingSecretariat::onlyTrashed()->paginate(20);

        return view('admin.competency.partials.training_type_library.training_secretariat.trashbin', compact('trainingSecretariatTrashedRecord'));
    }

    public function restore($ctrlno)
    {
        $trainingSecretariat = TrainingSecretariat::onlyTrashed()->find($ctrlno);
        $trainingSecretariat->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }
 
    // public function forceDelete($ctrlno)
    // {
    //     $trainingSecretariat = TrainingSecretariat::onlyTrashed()->find($ctrlno);
    //     $trainingSecretariat->forceDelete();
  
    //     return back()->with('info', 'Data Permanently Deleted');
    // }
}
