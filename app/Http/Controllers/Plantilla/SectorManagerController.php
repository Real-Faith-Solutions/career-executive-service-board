<?php

namespace App\Http\Controllers\Plantilla;

use App\Http\Controllers\Controller;
use App\Models\SectorManager;
use Illuminate\Http\Request;

class SectorManagerController extends Controller
{
    public function index(){
        $datas = SectorManager::paginate(10);
        return view ('admin.plantilla.sector_manager.index', compact('datas'));
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
    public function edit($ctrlno){
        $data = SectorManager::withTrashed()->findOrFail($ctrlno);
        return view('admin.201_library.title.edit', compact('data'));
    }

    public function update(Request $request, $ctrlno){
        $request->validate([
            'name' => ['required', 'string', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:plantilla_tbl_sectors'],
        ]);

        $data = SectorManager::withTrashed()->findOrFail($ctrlno);
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
    public function restore($ctrlno){
        $data = SectorManager::onlyTrashed()->findOrFail($ctrlno);
        $data->restore();

        return redirect()->back()->with('message', 'The item has been successfully restore!');
    }

    // soft delete
    public function destroy($ctrlno){
        $data = SectorManager::findOrFail($ctrlno);
        $data->delete();

        return redirect()->route('sector-manager.index')->with('message', 'The item has been successfully deleted!');
    }

    // force delete
    public function forceDelete($ctrlno){
        $data = SectorManager::onlyTrashed()->findOrFail($ctrlno);
        $data->forceDelete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }
}
