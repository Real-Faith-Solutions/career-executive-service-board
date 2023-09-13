<?php

namespace App\Http\Controllers\Plantilla;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\PlanPosition;
use Illuminate\Http\Request;

class PlantillaPositionManagerController extends Controller
{
    public function index()
    {
        return view('admin.plantilla.plantilla_office_manager.index');
    }

    public function destroy($plantilla_id)
    {
        $datas = PlanPosition::findOrFail($plantilla_id);
        $datas->delete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }
}
