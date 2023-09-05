<?php

namespace App\Http\Controllers\Plantilla;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\Office;
use Illuminate\Http\Request;

class OfficeManagerController extends Controller
{
    public function index()
    {
        return view('admin.plantilla.office_manager.index');
    }

    public function destroy($officeid)
    {
        $datas = Office::findOrFail($officeid);
        $datas->delete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }
}
