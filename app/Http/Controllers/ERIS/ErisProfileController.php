<?php

namespace App\Http\Controllers\ERIS;

use App\Http\Controllers\Controller;
use App\Models\Eris\ErisTblMain;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ErisProfileController extends Controller
{
    public function index()
    {
       $erisTblMain = ErisTblMain::paginate(25);

       return view('admin.eris.view_profile.table', compact('erisTblMain'));
    }

    public function create(Request $request)
    {
        if (DB::table('erad_tblMain')->count() === 0) 
        {
            $acno = 0;
            $acbatchno = 0;
        } else {
            $acno = ErisTblMain::latest()->first()->acno;
            $acbatchno = ErisTblMain::latest()->first()->acbatchno;
        }

        $search = $request->input('search');

        // Perform your search query here, e.g., using Eloquent 
        $personalData = PersonalData::query()
            ->where('cesno', "LIKE" ,"%$search%")
            ->orWhere('lastname',  "LIKE","%$search%")
            ->orWhere('firstname',  "LIKE","%$search%")
            ->orWhere('middlename',  "LIKE","%$search%")
            ->orWhere('name_extension',  "LIKE","%$search%")
            ->get();

        if ($search !== null && trim($search) !== '' && is_numeric($search)) 
        {
            // Query the database to find the corresponding personal data
            $personalDataSearchResult = PersonalData::where('cesno', $search)->first();

            if (!$personalDataSearchResult || !is_numeric($search)) 
            {
                // Handle the case where the data does not exist
                return redirect()->route('eris.create')->with('error', 'Data not found in the database.');
            }
        }
        else
        {
            $personalDataSearchResult = null;
        }

        return view('admin.eris.view_profile.add_new_profile.form', ['acno' => ++$acno, 'acbatchno' => ++$acbatchno, 
        'personalData' => $personalData, 'personalDataSearchResult' => $personalDataSearchResult, 'search' => $search]);
    }

    public function store(Request $request)
    {
        $request->validate([

            'cesno' => ['required', 'unique:erad_tblMain,cesno'],
        
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();
            
        ErisTblMain::create([
            'cesno' => $request->cesno,
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'emailadd' => $request->emailadd, 
            'contactno' => $request->contactno, 
            'mobileno' => $request->mobileno, 
            'faxno' => $request->faxno, 
            'position' => $request->position, 
            'position_remarks' => $request->position_remarks, 
            'office' => $request->office, // bureau office
            'department' => $request->department, // department/agency
            'c_status' => $request->c_status, // conferment status
            'c_resno' => $request->c_resno, // resolution no
            'c_date' => $request->c_date, // date conferred
            'encoder' => $encoder,
         ]);

        return to_route('eris-index')->with('message', 'Save Sucessfully');
    }

    public function edit($acno)
    {
        $erisTblMainPersonalData = ErisTblMain::find($acno);

        return view('admin.eris.view_profile.add_new_profile.edit', compact('acno','erisTblMainPersonalData'));
    }

    public function update(Request $request, $acno)
    { 
        $erisTblMain = ErisTblMain::find($acno);
        $erisTblMain->lastname = $request->lastname;
        $erisTblMain->firstname = $request->firstname;
        $erisTblMain->middlename = $request->middlename;
        $erisTblMain->birthdate = $request->birthdate;
        $erisTblMain->gender = $request->gender;
        $erisTblMain->emailadd = $request->emailadd;
        $erisTblMain->contactno = $request->contactno;
        $erisTblMain->mobileno =  $request->mobileno;
        $erisTblMain->faxno =  $request->faxno;
        $erisTblMain->position =  $request->position;
        $erisTblMain->position_remarks =  $request->position_remarks;
        $erisTblMain->office =  $request->office;
        $erisTblMain->department =  $request->department;
        $erisTblMain->c_status =  $request->c_status;
        $erisTblMain->c_resno =  $request->c_resno;
        $erisTblMain->c_date =  $request->c_date;
        $erisTblMain->update();
 
         return to_route('eris.edit', ['acno' => $acno])->with('info', 'Update Sucessfully');
    }
}
