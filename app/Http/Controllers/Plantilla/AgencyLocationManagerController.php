<?php

namespace App\Http\Controllers\Plantilla;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\AgencyLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgencyLocationManagerController extends Controller
{
    public function index()
    {
        return view('admin.plantilla.agency_location_manager.index');
    }

    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $request->validate([
            'deptid' => ['required'],
            'title' => ['required', 'max:40', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'acronym' => ['required', 'max:10', 'min:2', 'regex:/^[a-zA-Z ]*$/'],
            'agencyloc_Id' => ['required'],
            'region' => ['required'],
        ]);
        AgencyLocation::create([
            'deptid' => $request->input('deptid'),
            'title' => $request->input('title'),
            'acronym' => $request->input('acronym'),
            'agencyloc_Id' => $request->input('agencyloc_Id'),
            'telno' => $request->input('telno'),
            'email' => $request->input('email'),
            'region' => $request->input('region'),
            'encoder' => $encoder,
        ]);
        return redirect()->back()->with('message', 'The item has been successfully added!');
    }

    public function show()
    {
        return "hello";
    }



    public function destroy($officelocid)
    {
        $datas = AgencyLocation::findOrFail($officelocid);
        $datas->delete();

        return redirect()->back()->with('message', 'The item has been successfully deleted!');
    }
}