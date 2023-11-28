<?php

namespace App\Http\Controllers\Plantilla;

use App\Http\Controllers\Controller;
use App\Models\Plantilla\DepartmentAgency;
use App\Models\Plantilla\DepartmentAgencyType;
use App\Models\Plantilla\MotherDept;
use App\Models\Plantilla\SectorManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SectorManagerController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $datas = SectorManager::orderBy('title', 'ASC')

            ->where('title', 'LIKE', "%$query%")
            ->orWhere('description', 'LIKE', "%$query%")
            ->orWhere('encoder', 'LIKE', "%$query%")
            ->get();
        return view('admin.plantilla.sector_manager.index', compact('datas', 'query'));
    }

    public function show($sectorid)
    {
        $datas = SectorManager::withTrashed()->findOrFail($sectorid);

        return view('admin.plantilla.sector_manager.show', compact('datas'));
    }

    public function create()
    {
        return view('admin.plantilla.sector_manager.create');
    }
    // ui for edit
    public function edit(Request $request, $sectorid)
    {
        $query = $request->input('search');
        $datas = SectorManager::withTrashed()->findOrFail($sectorid);
        $agencyType = DepartmentAgencyType::query()
            ->where('sectorid', $sectorid)
            ->orderBy('title', 'ASC')->get();

        // $subDatas = DepartmentAgency::where('sectorid', $sectorid)
        //     ->whereExists(function ($queryBuilder) {
        //         $queryBuilder->select(DB::raw(1))
        //             ->from('plantilla_motherdept as subquery')
        //             // ->whereColumn('plantilla_tblDeptAgency.mother_deptid', 'subquery.deptid')
        //             ->whereNull('subquery.deleted_at')
        //             ->orderBy('subquery.title', 'asc')
        //             ->limit(1);
        //     })
        //     ->orderBy(function ($query) {
        //         $query->select(DB::raw('MIN(subquery.title)'))
        //             ->from('plantilla_motherdept as subquery')
        //             ->whereColumn('plantilla_tblDeptAgency.mother_deptid', 'subquery.deptid')
        //             ->whereNull('subquery.deleted_at');
        //     }, 'asc')
        //     ->orderBy('title', 'asc')
        //     ->whereNull('plantilla_tblDeptAgency.deleted_at')
        //     ->get();


        $subDatas = DepartmentAgency::where('sectorid', $sectorid)
            ->join('plantilla_motherdept', 'plantilla_tblDeptAgency.mother_deptid', '=', 'plantilla_motherdept.deptid')
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('plantilla_motherdept.title', 'like', "%$query%")
                    ->orWhere('plantilla_tblDeptAgency.title', 'like', "%$query%")
                    ->orWhere('plantilla_tblDeptAgency.acronym', 'like', "%$query%");
            })
            ->orderBy('plantilla_motherdept.title', 'asc')
            ->orderBy('plantilla_tblDeptAgency.title', 'asc')
            ->select('plantilla_tblDeptAgency.*') // Select the columns you need from the main table
            ->paginate(25);



        $motherDepartment = MotherDept::orderBy('title', 'asc')
            ->get();


        return view('admin.plantilla.sector_manager.edit', compact(
            'datas',
            'subDatas',
            'agencyType',
            'query',
            'motherDepartment',
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
}