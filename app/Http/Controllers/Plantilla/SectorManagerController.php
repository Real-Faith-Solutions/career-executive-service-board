<?php

namespace App\Http\Controllers\Plantilla;

use App\Http\Controllers\Controller;
use App\Models\SectorManager;
use Illuminate\Http\Request;

class SectorManagerController extends Controller
{
    public function index(){
        $data = SectorManager::orderBy('title', 'ASC')
        ->paginate(10);
        return view ('admin.plantilla.sector_manager.index', compact('data'));
    }

    public function create(){
        return view ('admin.plantilla.sector_manager.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:plantilla_tbl_sectors'],
            'description' => ['required', 'max:255', 'min:2', 'regex:/^[a-zA-Z ]*$/',],
        ]);
        SectorManager::create($request->all());
        return redirect()->route('sector-manager.index')->with('message', 'The item has been successfully added!');
    }
    // ui for edit
    public function edit($sector_id){
        $data = SectorManager::withTrashed()->findOrFail($sector_id);
        return view('admin.plantilla.sector_manager.edit', compact('data'));
    }

    public function update(Request $request, $sector_id){
        $request->validate([
            'title' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:plantilla_tbl_sectors'],
            'description' => ['required', 'max:255', 'min:2', 'regex:/^[a-zA-Z ]*$/',],
        ]);

        $data = SectorManager::withTrashed()->findOrFail($sector_id);
        $data->update($request->all());

        return redirect()->route('sector-manager.index')->with('message', 'The item has been successfully updated!');
    }

    // recently deleted
    public function recentlyDeleted(){
        $datas = SectorManager::onlyTrashed()
        ->orderByDesc('deleted_at')
        ->paginate(10);
        return view('admin.201_library.title.recently_deleted', compact('datas'));
    }

    // restore
    public function restore($sector_id){
        $data = SectorManager::onlyTrashed()->findOrFail($sector_id);
        $data->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    // soft delete
    public function destroy($sector_id){
        $data = SectorManager::findOrFail($sector_id);
        $data->delete();

        return redirect()->route('sector-manager.index')->with('message', 'The item has been successfully deleted!');
    }

    // force delete
    public function forceDelete($sector_id){
        $data = SectorManager::onlyTrashed()->findOrFail($sector_id);
        $data->forceDelete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }
}
