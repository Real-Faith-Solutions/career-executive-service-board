<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Definitions\AppDefinitions;
use App\Models\PersonalData;

class ReportController extends Controller
{
    public function getGeneralReportsPage()
    {
        if(RolesController::validateUserCesWebAppGeneralPageAccess('Reports') == 'true'){
            $CESIDS = AppDefinitions::DEFAULT_CESOS_ID;
            $CESIDS = array_merge($CESIDS, AppDefinitions::DEFAULT_CSEE_ID);
            $CESIDS = array_merge($CESIDS, AppDefinitions::DEFAULT_ELIGIBLE_ID);
            $recordProfiles = PersonalData::all();

            $activeProfiles = $recordProfiles
                ->where('status', "Active")
                ->whereIN('cesstat_code', $CESIDS);

            $wPendingcaseProfiles = $recordProfiles
                ->where('status', "Retired")
                ->whereIN('cesstat_code', $CESIDS);
            $woPendingcaseProfiles = $recordProfiles
                ->where('status', "Retired")
                ->whereIN('cesstat_code', $CESIDS);

            $retiredProfiles = $recordProfiles
                ->where('status', "Retired")
                ->whereIN('cesstat_code', $CESIDS);

            $deceasedProfiles = $recordProfiles
                ->where('status', "Deceased")
                ->whereIN('cesstat_code', $CESIDS);

            $candidateRetireProfiles = $recordProfiles
                ->where('status', "Active")
                ->whereIN('cesstat_code', $CESIDS)
                ->where('age_now', '>=', 60);
            // $candidateRetireProfiles = $candidateRetireProfiles->filter(function($model){
            //     return $model->age_now >= 60;
            // });

            return view('admin.reports_management.general_reports', compact('recordProfiles', 'activeProfiles', 'retiredProfiles', 'deceasedProfiles', 'candidateRetireProfiles'))->render();
        } else {

            return view('restricted');
        }
    }
    
    public function getBirthdayCardsReportsPage()
    {
        if(RolesController::validateUserCesWebAppGeneralPageAccess('Reports') == 'true'){
            $CESIDS = AppDefinitions::DEFAULT_CESOS_ID;
            $CESIDS = array_merge($CESIDS, AppDefinitions::DEFAULT_CSEE_ID);
            $CESIDS = array_merge($CESIDS, AppDefinitions::DEFAULT_ELIGIBLE_ID);
            // $recordProfiles = PersonalData::where('status', "Active")
            // ->whereIN('cesstat_code', $CESIDS)
            // ->whereMonth('birthdate', date('m'));

            // $birthMonthProfiles = $recordProfiles
            //     ->where('status', "Active")
            //     ->whereIN('cesstat_code', $CESIDS)
            //     ->whereMonth('birthdate', date('m'));
            $birthMonthProfiles = PersonalData::where('status', "Active")
                ->whereIN('cesstat_code', $CESIDS)
                ->whereMonth('birthdate', date('m'))
                ->get();

            return view('admin.reports_management.birthday_cards_reports', compact('birthMonthProfiles'))->render();
        } else {
            return view('restricted');
        }
    }
    
    public function getStatisticalReportsPage()
    {
        if(RolesController::validateUserCesWebAppGeneralPageAccess('Reports') == 'true'){
            $CESIDS = AppDefinitions::DEFAULT_CESOS_ID;
            $CESIDS = array_merge($CESIDS, AppDefinitions::DEFAULT_CSEE_ID);
            $CESIDS = array_merge($CESIDS, AppDefinitions::DEFAULT_ELIGIBLE_ID);
            $recordProfiles = PersonalData::all();

            $recordByPosition = [
                [
                    "Active CESOs",
                    (($recordProfiles
                    ->where('status', 'Active')
                    ->whereIN('cesstat_code', AppDefinitions::DEFAULT_CESOS_ID)
                    ->count()) ?? 0)
                ],
                [
                    "Active CES Eligibles",
                    (($recordProfiles
                    ->where('status', 'Active')
                    ->whereIN('cesstat_code', AppDefinitions::DEFAULT_ELIGIBLE_ID)
                    ->count()) ?? 0)
                ],
                [
                    "Active CSEE",
                    (($recordProfiles
                    ->where('status', 'Active')
                    ->whereIN('cesstat_code', AppDefinitions::DEFAULT_CSEE_ID)
                    ->count()) ?? 0)
                ],

                [
                    "Retired CESO’s",
                    (($recordProfiles
                    ->where('status', 'Retired')
                    ->whereIN('cesstat_code', AppDefinitions::DEFAULT_CESOS_ID)
                    ->count()) ?? 0),
                ],
                [
                    "Retired CES Eligibles",
                    (($recordProfiles
                    ->where('status', 'Retired')
                    ->whereIN('cesstat_code', AppDefinitions::DEFAULT_ELIGIBLE_ID)
                    ->count()) ?? 0),
                ],
                [
                    "Retired CSEE",
                    (($recordProfiles
                    ->where('status', 'Retired')
                    ->whereIN('cesstat_code', AppDefinitions::DEFAULT_ELIGIBLE_ID)
                    ->count()) ?? 0),
                ]
            ];

            $recordByAge = [
                [
                    "Youth (18-24 Yrs)",
                    (($recordProfiles
                    ->where('status', 'Active')
                    ->whereIN('cesstat_code', $CESIDS)
                    ->count()) ?? 0)
                ],
                [
                    "Adults (25-64 Yrs)",
                    (($recordProfiles
                    ->where('status', 'Active')
                    ->whereIN('cesstat_code', AppDefinitions::DEFAULT_ELIGIBLE_ID)
                    ->count()) ?? 0)
                ],
                [
                    "Seniors (64 and Above Yrs)",
                    (($recordProfiles
                    ->where('status', 'Active')
                    ->whereIN('cesstat_code', AppDefinitions::DEFAULT_CSEE_ID)
                    ->count()) ?? 0)
                ],
            ];

            return view('admin.reports_management.statistical_reports', compact('recordByPosition', 'recordByAge'))->render();
        } else {
            return view('restricted');
        }
    }
}
