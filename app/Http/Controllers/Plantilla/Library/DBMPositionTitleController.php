<?php

namespace App\Http\Controllers\Plantilla\Library;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\PlanPositionLevelLibrary;
use App\Models\Plantilla\PositionMasterLibrary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DBMPositionTitleController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        $datas = PositionMasterLibrary::query()
            ->where('dbm_title', 'LIKE', "%$query%")
            ->orWhere('poslevel_code', 'LIKE', "%$query%")
            ->orWhere('sg', 'LIKE', "%$query%")
            ->orWhere('func_title', 'LIKE', "%$query%")
            ->paginate(25);
        return view('admin.plantilla.library.dbm_title.index', compact(
            'datas',
        ));
    }

    public function create()
    {
        $planPositionLevelLibrary = PlanPositionLevelLibrary::orderBy('title', 'ASC')->get();
        return view('admin.plantilla.library.dbm_title.create', compact(
            'planPositionLevelLibrary'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dbm_title' => ['required', 'max:40', 'min:2'],
            'poslevel_code' => ['required'],
            'sg' => ['required'],
            'func_title' => ['required'],
        ]);
        PositionMasterLibrary::create($request->all());
        return redirect()->back()->with('message', 'The item has been successfully added!');
    }

    public function destroy($pos_code)
    {
        $data = PositionMasterLibrary::findOrFail($pos_code);

        if ($data->planPosition()->exists()) {
            return redirect()->back()->with('error', 'Cannot delete this item because it has related records.');
        }
        if ($data->positionLevel()->exists()) {
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

    public function trash()
    {
        $datas = PositionMasterLibrary::onlyTrashed()
            ->get();
        return view('admin.plantilla.library.dbm_title.trash', compact('datas'));
    }

    public function restore($pos_code)
    {
        $datas = PositionMasterLibrary::onlyTrashed()->findOrFail($pos_code);
        $datas->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    public function forceDelete($pos_code)
    {
        try {
            // Find the soft-deleted record by its ID
            $data = PositionMasterLibrary::onlyTrashed()->findOrFail($pos_code);

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

    public function edit($pos_code)
    {
        $datas = PositionMasterLibrary::withTrashed()->findOrFail($pos_code);
        $planPositionLevelLibrary = PlanPositionLevelLibrary::orderBy('title', 'ASC')->get();

        return view('admin.plantilla.library.dbm_title.edit', compact(
            'datas',
            'planPositionLevelLibrary',
        ));
    }

    public function update(Request $request, $sectorid)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $request->validate([
            'dbm_title' => ['required', 'max:40', 'min:2'],
            'poslevel_code' => ['required'],
            'sg' => ['required'],
            'func_title' => ['required'],
        ]);

        $datas = PositionMasterLibrary::withTrashed()->findOrFail($sectorid);
        $datas->update([
            'dbm_title' => $request->input('dbm_title'),
            'poslevel_code' => $request->input('poslevel_code'),
            'sg' => $request->input('sg'),
            'func_title' => $request->input('func_title'),
            'encoder' => $encoder,
        ]);

        return redirect()->back()->with('message', 'The item has been successfully updated!');
    }
}
