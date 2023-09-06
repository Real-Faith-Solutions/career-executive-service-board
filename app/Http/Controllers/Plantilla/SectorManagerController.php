<?php

namespace App\Http\Controllers\Plantilla;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\DepartmentAgencyType;
use App\Models\Plantilla\SectorManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectorManagerController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $datas = SectorManager::orderBy('title', 'ASC')

            ->where('title', 'LIKE', "%$query%")
            ->orWhere('description', 'LIKE', "%$query%")
            ->orWhere('encoder', 'LIKE', "%$query%")
            ->paginate(25);
        return view('admin.plantilla.sector_manager.index', compact('datas', 'query'));
    }

    public function show($sectorid)
    {
        $datas = DepartmentAgency::where('plantilla_tblSector_id', $sectorid)
            ->orderBy('title', 'ASC')
            ->paginate(15);
        return view('admin.plantilla.department_agency_manager.index', compact('datas'));
    }

    public function create()
    {
        return view('admin.plantilla.sector_manager.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:plantilla_tblSector'],
            'description' => ['required', 'max:255', 'min:2', 'regex:/^[a-zA-Z ]*$/',],
        ]);
        SectorManager::create($request->all());
        return redirect()->route('sector-manager.index')->with('message', 'The item has been successfully added!');
    }
    // ui for edit
    public function edit(Request $request, $sectorid)
    {
        $query = $request->input('search');
        $datas = SectorManager::withTrashed()->findOrFail($sectorid);
        $agencyType = DepartmentAgencyType::orderBy('title', 'ASC')->get();

        $subDatas = DepartmentAgency::query()
            ->where('plantilla_tblSector_id', $sectorid)
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('title', 'LIKE', "%$query")
                    ->orWhere('acronym', 'LIKE', "%$query");
            })
            ->orderBy('title', 'ASC')
            ->paginate(10);

        return view('admin.plantilla.sector_manager.edit', compact(
            'datas',
            'subDatas',
            'agencyType',
            'query',
        ));
    }

    public function update(Request $request, $sectorid)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $request->validate([
            'title' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:plantilla_tblSector'],
            'description' => ['required', 'max:255', 'min:2', 'regex:/^[a-zA-Z ]*$/',],
        ]);

        $datas = SectorManager::withTrashed()->findOrFail($sectorid);
        $datas->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'encoder' => $encoder,
        ]);

        return redirect()->back()->with('message', 'The item has been successfully updated!');
    }

    // recently deleted
    public function recentlyDeleted()
    {
        $datas = SectorManager::onlyTrashed()
            ->orderByDesc('deleted_at')
            ->paginate(15);
        return view('admin.plantilla.sector_manager.recently_deleted', compact('datas'));
    }

    // restore
    public function restore($sectorid)
    {
        $datas = SectorManager::onlyTrashed()->findOrFail($sectorid);
        $datas->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    // soft delete
    public function destroy($sectorid)
    {
        $datas = SectorManager::findOrFail($sectorid);
        $datas->delete();

        return redirect()->route('sector-manager.index')->with('message', 'The item has been successfully deleted!');
    }

    // force delete
    public function forceDelete($sectorid)
    {
        $datas = SectorManager::onlyTrashed()->findOrFail($sectorid);
        $datas->forceDelete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }
}
