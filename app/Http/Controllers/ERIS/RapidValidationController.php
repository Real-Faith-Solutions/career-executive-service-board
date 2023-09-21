<?php

namespace App\Http\Controllers\ERIS;

use App\Http\Controllers\Controller;
use App\Models\Eris\ErisTblMain;
use App\Models\Eris\RapidValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RapidValidationController extends Controller
{
    public function index($acno)
    {
        $erisTblMain = ErisTblMain::find($acno);
        $rapidValidation = $erisTblMain->rapidValidation()->paginate(20);

        return view('admin.eris.partials.rapid_validation.table', compact('acno', 'rapidValidation'));
    }

    public function create($acno)
    {
        $erisTblMainProfileData =  ErisTblMain::find($acno);

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

        $erisTblMain = ErisTblMain::find($request->acno);
        
        $erisTblMain->rapidValidation()->save($rapiValidation);
        
        return to_route('eris-rapid-validation.index', ['acno'=>$acno])->with('message', 'Save Sucessfully');     
    }

    public function edit($acno, $ctrlno)
    {
        $erisTblMainProfileData =  ErisTblMain::find($acno);
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
}
