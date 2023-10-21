<?php

namespace App\Http\Controllers\ERIS;

use App\Http\Controllers\Controller;
use App\Http\Requests\ErisStoreRequest;
use App\Models\Eris\EradTblMain;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ConvertDateTimeToDate;

class ErisProfileController extends Controller
{
    // App\Models
    private PersonalData $personalData;
    private EradTblMain $erad;

    // App\Services
    private ConvertDateTimeToDate $convertDateTimeToDate;
 
    public function __construct(ConvertDateTimeToDate $convertDateTimeToDate)
    {
        $this->convertDateTimeToDate = $convertDateTimeToDate;
        $this->personalData = new PersonalData();
        $this->erad = new EradTblMain();
    }

    public function getFullNameAttribute()
    {   
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        return $encoder;
    }

    public function index(Request $request)
    {
        return view('admin.eris.view_profile.table', [
            'erisTblMain' => $this->erad->search($request->input('search'))
        ]);
    }

    public function create(Request $request)
    {
        return view('admin.eris.view_profile.add_new_profile.form', [
            'acno' => $this->erad->gettingAcNo(), 
            'acbatchno' => $this->erad->gettingAcBacthNo(), 
            'personalData' => $this->personalData->search($request->input('search')),
            'personalDataSearchResult' => $this->validateSearch($request->input('search')), 
            'search' => $request->input('search'),
        ]);
    }

    public function validateSearch($search)
    {
        if ($search !== null && !is_numeric($search)) 
        {
            return redirect()->route('eris.create')->with('error', 'Invalid Search Criteria.');
        }

        if ($search !== null && trim($search) !== '' && is_numeric($search)) 
        {
            // Query the database to find the corresponding personal data
            $personalDataSearchResult = PersonalData::where('cesno', $search)->first();

            if (!$personalDataSearchResult) 
            {
                // Handle the case where the data does not exist
                return redirect()->route('eris.create')->with('error', 'Data not found in the database.');
            }
        }
        else
        {
            $personalDataSearchResult = null;
        }

        return $personalDataSearchResult;
    }

    public function store(ErisStoreRequest $request)
    {
        EradTblMain::create(array_merge(
            $request->all(),
            [
                'encoder' => $this->getFullNameAttribute(),
            ]
        ));

        return to_route('eris-index')->with('message', 'Save Sucessfully');
    }

    public function edit($acno)
    {
        $userInfo = $this->erad->getUserInfo($acno);

        return view('admin.eris.view_profile.add_new_profile.edit', [
            'acno' => $acno,
            'erisTblMainPersonalData' => $userInfo['erisTblMainPersonalData'], 
            'age' =>  $userInfo['age'],
            'birthDate' => $this->convertDateTimeToDate->convertDateGeneral($userInfo['birthdate']),
        ]);
    }

    public function update(Request $request, $acno)
    { 
        $erisTblMain = EradTblMain::find($acno);
        $erisTblMain->update($request->all());
 
        return to_route('eris.edit', ['acno' => $acno])->with('info', 'Update Sucessfully');
    }
}
