<?php

namespace App\Http\Controllers;

use App\Models\Eris\AssessmentCenter;
use App\Models\Eris\BoardInterView;
use App\Models\Eris\EradTblMain;
use App\Models\Eris\InDepthValidation;
use App\Models\Eris\PanelBoardInterview;
use App\Models\Eris\RapidValidation;
use App\Models\Eris\WrittenExam;
use App\Models\PersonalData;
use App\Models\ProfileLibTblAppAuthority;
use App\Models\ProfileLibTblCesStatus;
use App\Models\ProfileLibTblCesStatusAcc;
use App\Models\ProfileLibTblCesStatusType;
use App\Models\ProfileTblCesStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Services\ConvertDateTimeToDate;

class EligibilityAndRankTrackerController extends Controller
{
    // const MODULE_201_PROFILING = 'admin.201_profiling';

    // App\Models
    private ProfileTblCesStatus $profileTblCesStatus;
    private ProfileLibTblCesStatus $cesStatus;
    private ProfileLibTblCesStatusAcc $cesStatusAcc;
    private ProfileLibTblCesStatusType $cesStatusType;
    private ProfileLibTblAppAuthority $appAuthority;

    // App\Services
    private ConvertDateTimeToDate $convertDateTimeToDate;
 
    public function __construct(ConvertDateTimeToDate $convertDateTimeToDate)
    {
        $this->convertDateTimeToDate = $convertDateTimeToDate;
        $this->profileTblCesStatus = new ProfileTblCesStatus();
        $this->cesStatus = new ProfileLibTblCesStatus();
        $this->cesStatusAcc = new ProfileLibTblCesStatusAcc();
        $this->cesStatusType = new ProfileLibTblCesStatusType();
        $this->appAuthority = new ProfileLibTblAppAuthority();
    }

    public function getFullNameAttribute()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        return $encoder;
    }

    public function index($cesno)
    {
        $personalData = PersonalData::find($cesno);
        $profileTblCesStatus = $personalData->profileTblCesStatus()
        ->orderBy('appointed_dt', 'desc')
        ->get();

        return view('admin.201_profiling.view_profile.partials.eligibility_and_rank_tracker.table', compact('profileTblCesStatus' ,'cesno'));
    }

    // navigate eris pages, written exam, assessment center, validation, board interview
    public function navigate(Request $request, $cesno)
    {
        $selectedPage = $request->input('page');

        switch ($selectedPage) 
        {
            case 'Written Exam':

                $erisPersonalDataAcno = EradTblMain::where('cesno', $cesno)->value('acno');
                $writtenExam = WrittenExam::where('acno', $erisPersonalDataAcno)->get(['we_date', 'we_rating', 'we_remarks', 'we_location', 'numtakes']);

                return view('admin/201_profiling/view_profile/partials/eligibility_and_rank_tracker/written_exam_tabe', compact('cesno', 'writtenExam', 'selectedPage'));
                    
            case 'Assessment Center':

                $erisPersonalDataAcno = EradTblMain::where('cesno', $cesno)->value('acno');
                $assessmentCenter = AssessmentCenter::where('acno', $erisPersonalDataAcno)->get(['acno', 'acdate', 'remarks', 'docdate', 'numtakes']);

                return view('admin.201_profiling.view_profile.partials.eligibility_and_rank_tracker.assessment_center_table', compact('cesno', 'assessmentCenter', 
                    'selectedPage'));

            case 'Validation':
                
                $erisPersonalDataAcno = EradTblMain::where('cesno', $cesno)->value('acno');
                $rapidValidation = RapidValidation::where('acno', $erisPersonalDataAcno)->get(['dteassign', 'dtesubmit', 'remarks']);
                $inDepthValidation = InDepthValidation::where('acno', $erisPersonalDataAcno)->get(['dteassign', 'dtesubmit', 'remarks']);

            return view('admin.201_profiling.view_profile.partials.eligibility_and_rank_tracker.validation_table', compact('cesno', 'rapidValidation', 
            'inDepthValidation', 'selectedPage'));

            case 'Board Interview':

                $erisPersonalDataAcno = EradTblMain::where('cesno', $cesno)->value('acno');
                $panelBoardInterview = PanelBoardInterview::where('acno', $erisPersonalDataAcno)->get(['dteiview', 'recom']);
                $boardInterview = BoardInterView::where('acno', $erisPersonalDataAcno)->get(['dteiview', 'recom']);
                
                return view('admin.201_profiling.view_profile.partials.eligibility_and_rank_tracker.board_interview_table', compact('cesno', 'panelBoardInterview', 
                'boardInterview', 'selectedPage'));

            default:
                return to_route('eligibility-rank-tracker.index', ['cesno'=>$cesno]);
        }
    }
    // end of navigate eris pages, written exam, assessment center, validation, board interview
    
    public function create($cesno)
    {
        return view('admin.201_profiling.view_profile.partials.eligibility_and_rank_tracker.form', [
            'profileLibTblCesStatus' => $this->cesStatus->cesStatusLibrary(),
            'profileLibTblCesStatusAcc' => $this->cesStatusAcc->cesStatusAccLibrary(),
            'profileLibTblCesStatusType' => $this->cesStatusType->cesStatusTypeLibrary(),
            'profileLibTblAppAuthority' => $this->appAuthority->appAuthorityLibrary(),
            'cesno' => $cesno,
        ]);
    }

    public function store(Request $request, $cesno)
    {
        $request->validate([

            'cesstat_code' => ['required',Rule::unique('profile_tblCESstatus')->where('cesno', $cesno)],
            'acc_code' => ['required'],
            'type_code' => ['required'],
            'official_code' => ['nullable'],
            'resolution_no' => ['required',Rule::unique('profile_tblCESstatus')->where('cesno', $cesno)],
            'appointed_dt' => ['required'],
            
        ]);
            
        $profileTblCesStatus = new ProfileTblCesStatus([

            'cesstat_code' => $request->cesstat_code,
            'acc_code' => $request->acc_code,
            'type_code' => $request->type_code,
            'official_code' => $request->official_code,
            'resolution_no' => $request->resolution_no,
            'appointed_dt' => $request->appointed_dt,
            'encoder' =>  $this->getFullNameAttribute(),

        ]);
    
        $personalData = PersonalData::find($cesno);
        
        $personalData->ProfileTblCesStatus()->save($profileTblCesStatus);

        // App\Models\ProfileTblCesStatus
        $this->profileTblCesStatus->latestCesStatusCode($cesno);

        return to_route('eligibility-rank-tracker.index', ['cesno'=>$cesno])->with('message', 'Save Sucessfully');
    }

    public function edit($ctrlno, $cesno)
    {
       $profileTblCesStatus = ProfileTblCesStatus::find($ctrlno);
    
       return view('admin.201_profiling.view_profile.partials.eligibility_and_rank_tracker.edit', [
            'profileTblCesStatus' => $profileTblCesStatus,
            'profileLibTblCesStatus' => $this->cesStatus->cesStatusLibrary(),
            'profileLibTblCesStatusAcc' => $this->cesStatusAcc->cesStatusAccLibrary(),
            'profileLibTblCesStatusType' => $this->cesStatusType->cesStatusTypeLibrary(),
            'profileLibTblAppAuthority' => $this->appAuthority->appAuthorityLibrary(),
            'appointedDate' => $this->convertDateTimeToDate->convertDateFrom($profileTblCesStatus->appointed_dt),
            'cesno' => $cesno,
       ]);
    }

    public function update(Request $request, $ctrlno, $cesno)
    {
        $request->validate([

            'cesstat_code' => ['required',Rule::unique('profile_tblCESstatus')->where('cesno', $cesno)->ignore($ctrlno, 'ctrlno')],
            'acc_code' => ['required'],
            'type_code' => ['required'],
            'official_code' => ['nullable'],
            'resolution_no' => ['required',Rule::unique('profile_tblCESstatus')->where('cesno', $cesno)->ignore($ctrlno, 'ctrlno')],
            'appointed_dt' => ['required'],
            
        ]);

        $profileTblCesStatus = ProfileTblCesStatus::find($ctrlno);
        $profileTblCesStatus->cesstat_code = $request->cesstat_code;
        $profileTblCesStatus->acc_code = $request->acc_code;
        $profileTblCesStatus->type_code = $request->type_code;
        $profileTblCesStatus->official_code = $request->official_code;
        $profileTblCesStatus->resolution_no = $request->resolution_no;
        $profileTblCesStatus->appointed_dt = $request->appointed_dt;
        $profileTblCesStatus->lastupd_enc = $this->getFullNameAttribute();
        $profileTblCesStatus->update();

        // App\Models\ProfileTblCesStatus
        $this->profileTblCesStatus->latestCesStatusCode($cesno);

        return to_route('eligibility-rank-tracker.index', ['cesno'=>$cesno])->with('message', 'Update Sucessfully');
    }

    public function destroy($ctrlno, $cesno)
    {
        $profileTblCesStatus = ProfileTblCesStatus::find($ctrlno);
        $profileTblCesStatus->delete();

        // App\Models\ProfileTblCesStatus
        $this->profileTblCesStatus->latestCesStatusCode($cesno);

        return back()->with('message', 'Deleted Sucessfully');
    }

    public function recentlyDeleted($cesno)
    {
        //parent model
        $personalData = PersonalData::withTrashed()->find($cesno);

        // Access the soft deleted profileTblCesStatus of the parent model
        $profileTblCesStatusTrashedRecord = $personalData->profileTblCesStatus()
        ->onlyTrashed()
        ->orderBy('deleted_at', 'desc')
        ->get();
 
        return view('admin.201_profiling.view_profile.partials.eligibility_and_rank_tracker.trashbin', compact('profileTblCesStatusTrashedRecord', 'cesno'));
    }

    public function restore($ctrlno, $cesno)
    {
        $profileTblCesStatus = ProfileTblCesStatus::withTrashed()->find($ctrlno);
        $profileTblCesStatus->restore();

        // App\Models\ProfileTblCesStatus
        $this->profileTblCesStatus->latestCesStatusCode($cesno);

        return back()->with('message', 'Data Restored Sucessfully');
    }
 
    public function forceDelete($ctrlno, $cesno)
    {
        $profileTblCesStatus = ProfileTblCesStatus::withTrashed()->find($ctrlno);
        $profileTblCesStatus->forceDelete();

        // App\Models\ProfileTblCesStatus
        $this->profileTblCesStatus->latestCesStatusCode($cesno);
  
        return back()->with('message', 'Data Permanently Deleted');
    }
}
