<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\PersonalData;

use App\Definitions\AppDefinitions;

class DashboardController extends Controller
{

    public function getDashboardData(){

        $data = array();

        $recordProfiles = PersonalData::all();

        $barProfilesCESStat = $recordProfiles
            ->groupBy('cesstat_code');
        $barProfilesTitle = $recordProfiles
            ->groupBy('title');
        $barPWD = $recordProfiles
            ->where('pwd', '!=', '')
            ->groupBy('pwd');

        $recordByGender = [
            "Active Male CESOs"             => (($recordProfiles
                ->where('status', 'Active')
                ->where('gender', 'Male')
                ->whereIN('cesstat_code', AppDefinitions::DEFAULT_CESOS_ID)
                ->count()) ?? 0),
            "Active Female CESOs"           => (($recordProfiles
                ->where('status', 'Active')
                ->where('gender', 'Female')
                ->whereIN('cesstat_code', AppDefinitions::DEFAULT_CESOS_ID)
                ->count()) ?? 0),
            "Active Male CES Eligibles"     => (($recordProfiles
                ->where('status', 'Active')
                ->where('gender', 'Male')
                ->whereIN('cesstat_code', AppDefinitions::DEFAULT_ELIGIBLE_ID)
                ->count()) ?? 0),
            "Active Female CES Eligibles"   => (($recordProfiles
                ->where('status', 'Active')
                ->where('gender', 'Male')
                ->whereIN('cesstat_code', AppDefinitions::DEFAULT_ELIGIBLE_ID)
                ->count()) ?? 0),

            "Retired Male CESO’s"           => (($recordProfiles
                ->where('status', 'Retired')
                ->where('gender', 'Male')
                ->whereIN('cesstat_code', AppDefinitions::DEFAULT_CESOS_ID)
                ->count()) ?? 0),
            "Retired Female CESO’s"         => (($recordProfiles
                ->where('status', 'Retired')
                ->where('gender', 'Female')
                ->whereIN('cesstat_code', AppDefinitions::DEFAULT_CESOS_ID)
                ->count()) ?? 0),
            "Retired Male CES Eligibles"    => (($recordProfiles
                ->where('status', 'Retired')
                ->where('gender', 'Male')
                ->whereIN('cesstat_code', AppDefinitions::DEFAULT_ELIGIBLE_ID)
                ->count()) ?? 0),
            "Retired Female CES Eligibles"  => (($recordProfiles
                ->where('status', 'Retired')
                ->where('gender', 'Female')
                ->whereIN('cesstat_code', AppDefinitions::DEFAULT_ELIGIBLE_ID)
                ->count()) ?? 0)
        ];

        return collect([
            "items" => [
                [
                    "group_header" => "Client Statistics",
                    "group_values" => [
                        [
                            "label" => "Total Active CESOs",
                            "value" => (($recordProfiles
                                ->where('status', 'Active')
                                ->whereIN('cesstat_code', AppDefinitions::DEFAULT_CESOS_ID)
                                ->count()) ?? 0),
                            "color" => "info",
                            "icon" => "fa-users"
                        ],
                        [
                            "label" => "Total Active CES Eligibles",
                            "value" => (($recordProfiles
                                ->where('status', 'Active')
                                ->whereIN('cesstat_code', AppDefinitions::DEFAULT_ELIGIBLE_ID)
                                ->count()) ?? 0),
                            "color" => "success",
                            "icon" => "fa-user-circle"
                        ],
                        [
                            "label" => "Total Eligible Active Profiles",
                            "value" => (($recordProfiles
                                ->where('status', 'Retired')
                                ->whereIN('cesstat_code', AppDefinitions::DEFAULT_CESOS_ID)
                                ->count()) ?? 0),
                            "color" => "dark",
                            "icon" => "fa-users"
                        ],
                        [
                            "label" => "Total Eligible Retired Profiles",
                            "value" => (($recordProfiles
                                ->where('status', 'Retired')
                                ->whereIN('cesstat_code', AppDefinitions::DEFAULT_ELIGIBLE_ID)
                                ->count()) ?? 0),
                            "color" => "warning",
                            "icon" => "fa-users"
                        ]
                    ]
                ]
            ],
            "charts" => [
                ////// PIE CHARTS
                "profile_status" => [
                    "group_headers" => "Profile Statuses",
                    "labels" => ["Total Active", "Total Retired", "Total Deceased"],
                    "values" => [
                        $recordProfiles->where('status', 'Active')->count(),
                        $recordProfiles->where('status', 'Retired')->count(),
                        $recordProfiles->where('status', 'Deceased')->count()
                    ],
                    "colors" => ['#1cc88a', 'crimson', '#222222']
                ],
                "profile_gender" => [
                    "group_headers" => "Profile Genders",
                    "labels" => ["Total Male", "Total Female"],
                    "values" => [
                        $recordProfiles->where('gender', 'Male')->count(),
                        $recordProfiles->where('gender', 'Female')->count()
                    ],
                    "colors" => ['dodgerblue', 'hotpink']
                ],
                
                ////// BAR CHARTS
                "by_profile_ces_status" => [
                    "group_headers" => "No. of Profiles per CES Status",
                    "labels" => array_keys($barProfilesCESStat->toArray()),
                    "values" => $barProfilesCESStat->map(function($samples){
                        return count($samples);
                    })->sortDesc()->values()
                ],
                "by_pwd_case" => [
                    "group_headers" => "No. of PWD per case",
                    "labels" => array_keys($barPWD->toArray()),
                    "values" => $barPWD->map(function($samples){
                        return count($samples);
                    })->sortDesc()->values()
                ],
                "by_profile_ces_status_gender" => [
                    "group_headers" => "No. of Gender Statistics by Birth",
                    "labels" => array_keys($recordByGender),
                    "values" => array_values($recordByGender)
                ],

            ]
        ]);
    }

    public function getDashboardPage(){

        if(RolesController::validateUserCesWebAppGeneralPageAccess('Dashboard') == 'true'){

            $data = $this->getDashboardData();
            
            return view('admin.dashboard', compact('data'))->render();
        }
        else{

            return view('restricted');
        }
    
    }
}
