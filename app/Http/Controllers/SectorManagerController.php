<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SectorManagerController extends Controller
{
    public function addSectorManager(Request $request) {

        SectorManager::create([
            'sectorid' => $request->sectorid,
            'title' => $request->title,
            'description' => $request->description,
        ]);
    }

    public function getSectorManager(Request $request){
        $SectorManager = SectorManager::all();

        return $SectorManager;
    }
    
}
