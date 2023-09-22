<?php

namespace App\Http\Controllers\ERIS;

use App\Http\Controllers\Controller;
use App\Models\Eris\ErisTblMain;
use App\Models\Eris\InDepthValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InDepthValidationController extends Controller
{
    public function index($acno )
    {
        $erisTblMain = ErisTblMain::find($acno);
        $inDepthValidation = $erisTblMain->inDepthValidation()->paginate(20);
        
        return view('admin.eris.partials.in_depth_validation.table', compact('acno', 'inDepthValidation'));
    }

    public function create($acno)
    {
        $erisTblMainProfileData = ErisTblMain::find($acno);

        return view('admin.eris.partials.in_depth_validation.form', compact('acno', 'erisTblMainProfileData'));
    }

    public function store(Request $request, $acno)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $inDepthValidation = new InDepthValidation([

            'dteassign' => $request->dteassign, // date assign
            'dtesubmit' => $request->dtesubmit, // date submit
            'validator' => $request->validator, 
            'recom' => $request->recom, // recommendation
            'remarks' => $request->remarks,
            'dtedefer' => $request->dtedefer,  // defered date
            'encoder' =>  $encoder,

        ]);

        $erisTblMain = ErisTblMain::find($request->acno);
        
        $erisTblMain->inDepthValidation()->save($inDepthValidation);
        
        return to_route('eris-in-depth-validation.index', ['acno'=>$acno])->with('message', 'Save Sucessfully');
    }

    public function edit($acno, $ctrlno)
    {
        $erisTblMainProfileData = ErisTblMain::find($acno);
        $inDepthValidation = InDepthValidation::find($ctrlno);

        return view('admin.eris.partials.in_depth_validation.edit', compact('acno', 'erisTblMainProfileData', 'inDepthValidation', 'ctrlno'));
    }

    public function update(Request $request, $acno, $ctrlno)
    {
        
        $inDepthValidation = InDepthValidation::find($ctrlno);
        $inDepthValidation->dteassign = $request->dteassign;
        $inDepthValidation->dtesubmit = $request->dtesubmit;
        $inDepthValidation->validator = $request->validator;
        $inDepthValidation->recom = $request->recom;
        $inDepthValidation->remarks = $request->remarks;
        $inDepthValidation->dtedefer = $request->dtedefer;
        $inDepthValidation->save();

        return to_route('eris-in-depth-validation.index', ['acno'=>$acno])->with('info', 'Update Sucessfully');
    }

    public function destroy($ctrlno)
    {
        $inDepthValidation = InDepthValidation::find($ctrlno);
        $inDepthValidation->delete();

        return back()->with('message', 'Deleted Sucessfully');
    }
}