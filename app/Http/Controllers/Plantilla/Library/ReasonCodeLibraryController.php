<?php

namespace App\Http\Controllers\Plantilla\Library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plantilla\ReasonCode;
use Illuminate\Support\Facades\Auth;


class ReasonCodeLibraryController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        $datas = ReasonCode::query()
            ->where('title', 'LIKE', "%$query%")
            ->orWhere('module', 'LIKE', "%$query%")
            ->paginate(25);
        return view('admin.plantilla.library.reason_code.index', compact(
            'datas',
            'query',
        ));
    }

    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $request->validate([
            'module' => ['required', 'max:50', 'min:2'],
            'title' => ['required', 'max:50', 'min:2'],
        ]);
        $data = $request->all();
        $data['encoder'] = $encoder;
        $data['updated_by'] = $encoder;
        ReasonCode::create($data);
        return redirect()->back()->with('message', 'The item has been successfully added!');
    }

    public function create()
    {
        return view('admin.plantilla.library.reason_code.create');
    }
    
    public function edit($reason_code)
    {
        $datas = ReasonCode::withTrashed()->findOrFail($reason_code);
        return view('admin.plantilla.library.reason_code.edit', compact(
            'datas',
        ));
    }

    public function update(Request $request, $reason_code)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $request->validate([
            'module' => ['required', 'max:50', 'min:2'],
            'title' => ['required', 'max:50', 'min:2'],
        ]);

        $datas = ReasonCode::withTrashed()->findOrFail($reason_code);
        $datas->update([
            'title' => $request->input('title'),
            'module' => $request->input('module'),
            'updated_by' => $encoder,
        ]);

        return redirect()->back()->with('message', 'The item has been successfully updated!');
    }

    public function trash()
    {
        $datas = ReasonCode::onlyTrashed()
            ->get();
        return view('admin.plantilla.library.reason_code.trash', compact('datas'));
    }

    public function restore($reason_code)
    {
        $datas = ReasonCode::onlyTrashed()->findOrFail($reason_code);
        $datas->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    public function destroy($reason_code)
    {
        $data = ReasonCode::findOrFail($reason_code);

        // if ($data->apptStatus()->exists()) {
        //     return redirect()->back()->with('error', 'Cannot delete this item because it has related records.');
        // }

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

    public function forceDelete($reason_code)
    {
        try {
            // Find the soft-deleted record by its ID
            $data = ReasonCode::onlyTrashed()->findOrFail($reason_code);

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
