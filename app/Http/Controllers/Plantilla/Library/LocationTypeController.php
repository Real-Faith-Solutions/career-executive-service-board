<?php

namespace App\Http\Controllers\Plantilla\Library;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\AgencyLocationLibrary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationTypeController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        $datas = AgencyLocationLibrary::query()
            ->where('title', 'LIKE', "%$query%")
            ->paginate(25);
        return view('admin.plantilla.library.agency_location.index', compact(
            'datas',
            'query',
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:plantillalib_tblagencylocation'],
        ]);
        AgencyLocationLibrary::create($request->all());
        return redirect()->back()->with('message', 'The item has been successfully added!');
    }

    public function create()
    {
        return view('admin.plantilla.library.agency_location.create');
    }
    public function edit($agencyloc_Id)
    {
        $datas = AgencyLocationLibrary::withTrashed()->findOrFail($agencyloc_Id);
        return view('admin.plantilla.library.agency_location.edit', compact(
            'datas',
        ));
    }

    public function update(Request $request, $agencyloc_Id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $request->validate([
            'title' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:plantillalib_tblagencylocation'],
        ]);

        $datas = AgencyLocationLibrary::withTrashed()->findOrFail($agencyloc_Id);
        $datas->update([
            'title' => $request->input('title'),
            'encoder' => $encoder,
        ]);

        return redirect()->back()->with('message', 'The item has been successfully updated!');
    }

    public function trash()
    {
        $datas = AgencyLocationLibrary::onlyTrashed()
            ->get();
        return view('admin.plantilla.library.agency_location.trash', compact('datas'));
    }

    public function restore($agencyloc_Id)
    {
        $datas = AgencyLocationLibrary::onlyTrashed()->findOrFail($agencyloc_Id);
        $datas->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    public function destroy($agencyloc_Id)
    {
        $data = AgencyLocationLibrary::findOrFail($agencyloc_Id);

        if ($data->agencyLocation()->exists()) {
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

    public function forceDelete($agencyloc_Id)
    {
        try {
            // Find the soft-deleted record by its ID
            $data = AgencyLocationLibrary::onlyTrashed()->findOrFail($agencyloc_Id);

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
