<?php

namespace App\Http\Controllers\ERIS;

use App\Http\Controllers\Controller;
use App\Models\Eris\EradTblMain;
use App\Models\Eris\RapidValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RapidValidationController extends Controller
{
    public function index($acno)
    {
        $erisTblMain = EradTblMain::find($acno);
        $rapidValidation = $erisTblMain->rapidValidation()->paginate(20);

        return view('admin.eris.partials.rapid_validation.table', compact('acno', 'rapidValidation'));
    }

    public function create($acno)
    {
        $erisTblMainProfileData =  EradTblMain::find($acno);

        return view('admin.eris.partials.rapid_validation.form', compact('acno', 'erisTblMainProfileData'));
    }

    public function store(Request $request, $acno)
    {    
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $rapiValidation = new RapidValidation([

            'dteassign' => $request->dteassign, // date assign
            'dtesubmit' => $request->dtesubmit, // date submit
            'validator' => $request->validator, 
            'recom' => $request->recom, // recommendation
            'remarks' => $request->remarks, 
            'encoder' =>  $encoder,

        ]);

        $erisTblMain = EradTblMain::find($request->acno);
        
        $erisTblMain->rapidValidation()->save($rapiValidation);
        
        return to_route('eris-rapid-validation.index', ['acno'=>$acno])->with('message', 'Save Sucessfully');     
    }

    public function edit($acno, $ctrlno)
    {
        $erisTblMainProfileData =  EradTblMain::find($acno);
        $rapidValidation = RapidValidation::find($ctrlno);
        
        return view('admin.eris.partials.rapid_validation.edit', compact('acno', 'erisTblMainProfileData', 'rapidValidation', 'ctrlno'));
    }

    public function update(Request $request, $acno, $ctrlno)
    {
        $rapidValidation = RapidValidation::find($ctrlno);
        $rapidValidation->dteassign = $request->dteassign;
        $rapidValidation->dtesubmit = $request->dtesubmit;
        $rapidValidation->validator = $request->validator;
        $rapidValidation->recom = $request->recom;
        $rapidValidation->remarks = $request->remarks;
        $rapidValidation->save();

        return to_route('eris-rapid-validation.index', ['acno'=>$acno])->with('info', 'Update Sucessfully');
    }

    public function destroy($ctrlno)
    {
        $rapidValidation = RapidValidation::find($ctrlno);
        $rapidValidation->delete();

        return back()->with('message', 'Deleted Sucessfully');
    }

    public function recentlyDeleted($acno)
    {
        //parent model
        $erisTblMainData = EradTblMain::withTrashed()->find($acno);

        // Access the soft deleted rapidValidation of the parent model
        $rapidValidationTrashedRecord = $erisTblMainData->rapidValidation()->onlyTrashed()->paginate(20);

        return view('admin.eris.partials.rapid_validation.trashbin', compact('rapidValidationTrashedRecord', 'acno'));
    }

    public function restore($ctrlno)
    {
        $rapidValidationTrashedRecord = RapidValidation::onlyTrashed()->find($ctrlno);
        $rapidValidationTrashedRecord->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }

    public function forceDelete($ctrlno)
    {
        $rapidValidationTrashedRecord = RapidValidation::onlyTrashed()->find($ctrlno);
        $rapidValidationTrashedRecord->forceDelete();
  
        return back()->with('info', 'Data Permanently Deleted');
    }
}
