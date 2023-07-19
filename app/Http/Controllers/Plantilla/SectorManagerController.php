<?php

namespace App\Http\Controllers\Plantilla;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\SectorManager;
use Illuminate\Http\Request;

class SectorManagerController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search');
        $datas = SectorManager::orderBy('title', 'ASC')

        ->where('title', 'LIKE', "%$search%")
        ->orWhere('description', 'LIKE', "%$search%")
        ->orWhere('encoder', 'LIKE', "%$search%")
        ->paginate(10);
        return view ('admin.plantilla.sector_manager.index', compact('datas', 'search'));
    }

    public function show(){
        $datas = SectorManager::orderBy('title', 'ASC')
        ->paginate(10);
        return view ('admin.plantilla.sector_manager.index', compact('datas'));
    }

    public function create(){
        return view ('admin.plantilla.sector_manager.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:plantilla_tblSector'],
            'description' => ['required', 'max:255', 'min:2', 'regex:/^[a-zA-Z ]*$/',],
        ]);
        SectorManager::create($request->all());
        return redirect()->route('sector-manager.index')->with('message', 'The item has been successfully added!');
    }
    // ui for edit
    public function edit($sectorid){
        $datas = SectorManager::withTrashed()->findOrFail($sectorid);
        return view('admin.plantilla.sector_manager.edit', compact('datas'));
    }

    public function update(Request $request, $sectorid){
        $request->validate([
            'title' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:plantilla_tblSector'],
            'description' => ['required', 'max:255', 'min:2', 'regex:/^[a-zA-Z ]*$/',],
        ]);

        $datas = SectorManager::withTrashed()->findOrFail($sectorid);
        $datas->update($request->all());

        return redirect()->route('sector-manager.index')->with('message', 'The item has been successfully updated!');
    }

    // recently deleted
    public function recentlyDeleted(){
        $datas = SectorManager::onlyTrashed()
        ->orderByDesc('deleted_at')
        ->paginate(10);
        return view('admin.plantilla.sector_manager.recently_deleted', compact('datas'));
    }

    // restore
    public function restore($sectorid){
        $datas = SectorManager::onlyTrashed()->findOrFail($sectorid);
        $datas->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    // soft delete
    public function destroy($sectorid){
        $datas = SectorManager::findOrFail($sectorid);
        $datas->delete();

        return redirect()->route('sector-manager.index')->with('message', 'The item has been successfully deleted!');
    }

    // force delete
    public function forceDelete($sectorid){
        $datas = SectorManager::onlyTrashed()->findOrFail($sectorid);
        $datas->forceDelete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }
}
