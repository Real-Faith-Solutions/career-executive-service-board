<?php

namespace App\Http\Controllers\Plantilla\Library;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\ClassBasis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassBasisController extends Controller
{
    public function index()
    {
        $datas = ClassBasis::all();
        return view('admin.plantilla.library.classification_basis.index', compact('datas'));
    }

    public function create()
    {
        return view('admin.plantilla.library.classification_basis.create');
    }

    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();
        $request->validate([
            'basis' => ['required', 'max:40', 'min:2', 'unique:plantillalib_tblclassbasis'],
            'title' => ['required', 'max:40', 'min:2'],
            'classdate' => ['required'],
        ]);
        $data = $request->all();
        $data['encoder'] = $encoder;
        $data['updated_by'] = $encoder;
        ClassBasis::create($data);
        return redirect()->back()->with('message', 'The item has been successfully added!');
    }

    public function edit($cbasis_code)
    {
        $datas = ClassBasis::withTrashed()->findOrFail($cbasis_code);
        return view('admin.plantilla.library.classification_basis.edit', compact(
            'datas',
        ));
    }

    public function update(Request $request, $cbasis_code)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $request->validate([
            'basis' => ['required', 'max:40', 'min:2'],
            'title' => ['required', 'max:40', 'min:2'],
            'classdate' => ['required'],
        ]);

        $datas = ClassBasis::withTrashed()->findOrFail($cbasis_code);
        $datas->update([
            'basis' => $request->input('basis'),
            'title' => $request->input('title'),
            'classdate' => $request->input('classdate'),
            'updated_by' => $encoder,
        ]);

        return redirect()->back()->with('message', 'The item has been successfully updated!');
    }

    public function trash()
    {
        $datas = ClassBasis::onlyTrashed()
            ->get();
        return view('admin.plantilla.library.classification_basis.trash', compact('datas'));
    }

    public function restore($cbasis_code)
    {
        $datas = ClassBasis::onlyTrashed()->findOrFail($cbasis_code);
        $datas->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    public function destroy($cbasis_code)
    {
        $data = ClassBasis::findOrFail($cbasis_code);

        if ($data->planPosition()->exists()) {
            return redirect()->back()->with('error', 'Cannot delete this item because it has related records.');
        }

        try {
            $data->delete();

            if ($data->trashed()) {
                return redirect()->back()->with('message', 'The item has been successfully deleted!');
            } else {
                return redirect()->back()->with('error', 'Something went wrong!');
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'Record not found!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function forceDelete($cbasis_code)
    {
        try {
            // Find the soft-deleted record by its ID
            $data = ClassBasis::onlyTrashed()->findOrFail($cbasis_code);

            // Permanently delete the record
            $data->forceDelete();

            // Check if the delete operation was successful
            if ($data) {
                return redirect()->back()->with('message', 'The item has been successfully deleted!');
            } else {
                return redirect()->back()->with('error', 'Something went wrong!');
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            // Handle the case where the record is not found
            return redirect()->back()->with('error', 'Record not found!');
        } catch (\Exception $exception) {
            // Handle other exceptions if they occur
            return redirect()->back()->with('error', 'An error occurred!');
        }
    }
}
