<div class="tab-pane fade" id="eligibility_and_rank_tracker" role="tabpanel" aria-labelledby="eligibility_and_rank_tracker-tab">
    <form class="user" id="ceswe_hr_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/ces-we/add`, `ceswe_hr_form`, `Add`, `updateCesWeTable`, `resetCesWeForm`, `ceswe_hr_form_submit`, `None`, `None`)">
        @csrf
        <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
            <h1>CES WE ( HISTORICAL RECORD )</h1>
        </div>
        <div class="container-fuild m-3">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" id="cesno_ceswe_hr" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                    <input type="hidden" id="cesno_ceswe_hr_id" name="cesno_ceswe_hr_id" class="form-control">
                    <label class="form-label ml-2 mb-0">Examination Date<sup>*</sup></label>
                    <input type="date" class="form-control w-100 mb-3" name="ed_ces_we" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Rating<sup>*</sup></label>
                    <input type="text" class="form-control w-100 mb-3" name="r_ces_we" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Rating Definition<sup>*</sup></label>
                    <select name="rd_ces_we" class="form-control w-100 mb-3" required>
                        <option value="">Please Select</option>
                        <option value="Pass">Pass</option>
                        <option value="Fail">Fail</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Place of Examination<sup>*</sup></label>
                    <input type="text" class="form-control w-100 mb-3" name="poe_ces_we" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Take No.<sup>*</sup></label>
                    <input type="text" class="form-control w-100 mb-3" name="tn_ces_we" required>
                </div>
            </div>
            <div class="row">
                <div class="col my-3">
                    @if (count($CesWe) === 0)
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Add') == 'true')
                            <input type="submit" id="ceswe_hr_form_submit" class="btn btn-primary mb-1" value="Add Record">
                        @endif
                    @else
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Add') == 'true')
                            <input type="submit" id="ceswe_hr_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                            <input type="button" id="ceswe_hr_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetCesWeForm()">
                        @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Edit') == 'true')
                            <input type="submit" id="ceswe_hr_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                        @endif
                    @endif

                </div>
            </div>
        </div>
        <div class="overflow-auto">
            <table class="table-responsive-lg table-hover table">
                <thead class="bg-secondary bg-gardient text-white">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Examination Date</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Rating Definition</th>
                        <th scope="col">Place of Examination</th>
                        <th scope="col">Take No.</th>
                        <th scope="col">Encoded By</th>
                        <th scope="col">Encoded Date</th>
                        <th scope="col">Last Updated By</th>
                        <th scope="col">Last Update Date</th>
                    </tr>
                </thead>
                <tbody id="CesWe_tbody">
                    @if (count($CesWe) === 0)

                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    @else
                        @foreach ($CesWe as $item)
                            <tr>
                                <td>
                                    <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetCesWeForm({{ $item->id }},`View`)">View</a>
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Edit') == 'true')
                                        <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetCesWeForm({{ $item->id }},`Edit`)">Edit</a>
                                    @endif
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Delete') == 'true')
                                        <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/ces-we/delete/{{ $item->id }}`, `updateCesWeTable`, `resetCesWeForm`, `None`, `None`)">Delete</a>
                                    @endif

                                </td>
                                <td>{{ $item->ed_ces_we ?? '-' }}</td>
                                <td>{{ $item->r_ces_we ?? '-' }}</td>
                                <td>{{ $item->rd_ces_we ?? '-' }}</td>
                                <td>{{ $item->poe_ces_we ?? '-' }}</td>
                                <td>{{ $item->tn_ces_we ?? '-' }}</td>
                                <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </form>
    <form class="user" id="assessment_center_hr_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/assessment-center/add`, `assessment_center_hr_form`, `Add`, `updateAssessmentCenterTable`, `resetAssessmentCenterForm`, `assessment_center_hr_form_submit`, `None`, `None`)">
        @csrf
        <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
            <h1>ASSESSMENT CENTER ( HISTORICAL RECORD )</h1>
        </div>
        <div class="container-fuild m-3">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" id="cesno_assessment_center_hr" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                    <input type="hidden" id="cesno_assessment_center_hr_id" name="cesno_assessment_center_hr_id" class="form-control">
                    <label class="form-label ml-2 mb-0">AC No.<sup>*</sup></label>
                    <input type="text" class="form-control w-100 mb-3" name="an_achr_ces_we" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Assessment Date<sup>*</sup></label>
                    <input type="date" class="form-control w-100 mb-3" name="ad_achr_ces_we" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Rating<sup>*</sup></label>
                    <select name="r_achr_ces_we" class="form-control w-100 mb-3" required>
                        <option value="">Please Select</option>
                        <option value="Pass">Pass</option>
                        <option value="Fail">Fail</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Competencies for D.O</label>
                    <input type="text" class="form-control w-100 mb-3" name="cfd_achr_ces_we" />
                </div>
            </div>
            <div class="row">
                <div class="col my-3">
                    @if (count($AssessmentCenter) === 0)
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Add') == 'true')
                            <input type="submit" id="assessment_center_hr_form_submit" class="btn btn-primary mb-1" value="Add Record">
                        @endif
                    @else
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Add') == 'true')
                            <input type="submit" id="assessment_center_hr_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                            <input type="button" id="assessment_center_hr_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetAssessmentCenterForm()">
                        @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Edit') == 'true')
                            <input type="submit" id="assessment_center_hr_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                        @endif
                    @endif

                </div>
            </div>
        </div>
        <div class="overflow-auto">
            <table class="table-responsive-lg table-hover table">
                <thead class="bg-secondary bg-gardient text-white">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Ac No.</th>
                        <th scope="col">Assessment Date</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Competencies</th>
                        <th scope="col">Encoded By</th>
                        <th scope="col">Encoded Date</th>
                        <th scope="col">Last Updated By</th>
                        <th scope="col">Last Update Date</th>
                    </tr>
                </thead>
                <tbody id="AssessmentCenter_tbody">
                    @if (count($AssessmentCenter) === 0)

                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    @else
                        @foreach ($AssessmentCenter as $item)
                            <tr>
                                <td>
                                    <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetAssessmentCenterForm({{ $item->id }},`View`)">View</a>
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Edit') == 'true')
                                        <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetAssessmentCenterForm({{ $item->id }},`Edit`)">Edit</a>
                                    @endif
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Delete') == 'true')
                                        <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/assessment-center/delete/{{ $item->id }}`, `updateAssessmentCenterTable`, `resetAssessmentCenterForm`, `None`, `None`)">Delete</a>
                                    @endif

                                </td>
                                <td>{{ $item->an_achr_ces_we ?? '-' }}</td>
                                <td>{{ $item->ad_achr_ces_we ?? '-' }}</td>
                                <td>{{ $item->r_achr_ces_we ?? '-' }}</td>
                                <td>{{ $item->cfd_achr_ces_we ?? '-' }}</td>
                                <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </form>
    <form class="user" id="validation_hr_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/validation-hr/add`, `validation_hr_form`, `Add`, `updateValidationHrTable`, `resetValidationHrForm`, `validation_hr_form_submit`, `None`, `None`)">
        @csrf
        <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
            <h1>VALIDATION ( HISTORICAL RECORD )</h1>
        </div>
        <div class="container-fuild m-3">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" id="cesno_validation_hr" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                    <input type="hidden" id="cesno_validation_hr_id" name="cesno_validation_hr_id" class="form-control">
                    <label class="form-label ml-2 mb-0">Validation Date<sup>*</sup></label>
                    <input type="date" class="form-control w-100 mb-3" name="vd_vhr_ces_we" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Type of Validation<sup>*</sup></label>
                    <select name="tov_vhr_ces_we" class="form-control w-100 mb-3" required>
                        <option value="">Please Select</option>
                        <option value="In-Dept">In-Dept</option>
                        <option value="Rapid">Rapid</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Result<sup>*</sup></label>
                    <select name="r_vhr_ces_we" class="form-control w-100 mb-3" required>
                        <option value="">Please Select</option>
                        <option value="Pass">Pass</option>
                        <option value="Fail">Fail</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col my-3">
                    @if (count($ValidationHr) === 0)
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Add') == 'true')
                            <input type="submit" id="validation_hr_form_submit" class="btn btn-primary mb-1" value="Add Record">
                        @endif
                    @else
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Add') == 'true')
                            <input type="submit" id="validation_hr_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                            <input type="button" id="validation_hr_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetValidationHrForm()">
                        @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Edit') == 'true')
                            <input type="submit" id="validation_hr_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                        @endif
                    @endif

                </div>
            </div>
        </div>
        <div class="overflow-auto">
            <table class="table-responsive-lg table-hover table">
                <thead class="bg-secondary bg-gardient text-white">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Validation Date</th>
                        <th scope="col">Type of Validation</th>
                        <th scope="col">Result</th>
                        <th scope="col">Encoded By</th>
                        <th scope="col">Encoded Date</th>
                        <th scope="col">Last Updated By</th>
                        <th scope="col">Last Update Date</th>
                    </tr>
                </thead>
                <tbody id="ValidationHr_tbody">
                    @if (count($ValidationHr) === 0)

                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    @else
                        @foreach ($ValidationHr as $item)
                            <tr>
                                <td>
                                    <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetValidationHrForm({{ $item->id }},`View`)">View</a>
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Edit') == 'true')
                                        <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetValidationHrForm({{ $item->id }},`Edit`)">Edit</a>
                                    @endif
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Delete') == 'true')
                                        <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/validation-hr/delete/{{ $item->id }}`, `updateValidationHrTable`, `resetValidationHrForm`, `None`, `None`)">Delete</a>
                                    @endif

                                </td>
                                <td>{{ $item->vd_vhr_ces_we ?? '-' }}</td>
                                <td>{{ $item->tov_vhr_ces_we ?? '-' }}</td>
                                <td>{{ $item->r_vhr_ces_we ?? '-' }}</td>
                                <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </form>
    <form class="user" id="board_interview_hr_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/board-interview/add`, `board_interview_hr_form`, `Add`, `updateBoardInterviewTable`, `resetBoardInterviewForm`, `board_interview_hr_form_submit`, `None`, `None`)">
        @csrf
        <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
            <h1>BOARD INTERVIEW</h1>
        </div>
        <div class="container-fuild m-3">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" id="cesno_board_interview_hr" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                    <input type="hidden" id="cesno_board_interview_hr_id" name="cesno_board_interview_hr_id" class="form-control">
                    <label class="form-label ml-2 mb-0">Board Interview Date<sup>*</sup></label>
                    <input type="date" class="form-control w-100 mb-3" name="bid_bi_ces_we" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Rating<sup>*</sup></label>
                    <select name="r_bi_ces_we" class="form-control w-100 mb-3" required>
                        <option value="">Please Select</option>
                        <option value="Pass">Pass</option>
                        <option value="Fail">Fail</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col my-3">
                    @if (count($BoardInterview) === 0)
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Add') == 'true')
                            <input type="submit" id="board_interview_hr_form_submit" class="btn btn-primary mb-1" value="Add Record">
                        @endif
                    @else
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Add') == 'true')
                            <input type="submit" id="board_interview_hr_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                            <input type="button" id="board_interview_hr_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetBoardInterviewForm()">
                        @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Edit') == 'true')
                            <input type="submit" id="board_interview_hr_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                        @endif
                    @endif

                </div>
            </div>
        </div>
        <div class="overflow-auto">
            <table class="table-responsive-lg table-hover table">
                <thead class="bg-secondary bg-gardient text-white">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Board Interview Date</th>
                        <th scope="col">Result</th>
                        <th scope="col">Encoded By</th>
                        <th scope="col">Encoded Date</th>
                        <th scope="col">Last Updated By</th>
                        <th scope="col">Last Update Date</th>
                    </tr>
                </thead>
                <tbody id="BoardInterview_tbody">
                    @if (count($BoardInterview) === 0)

                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    @else
                        @foreach ($BoardInterview as $item)
                            <tr>
                                <td>
                                    <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetBoardInterviewForm({{ $item->id }},`View`)">View</a>
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Edit') == 'true')
                                        <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetBoardInterviewForm({{ $item->id }},`Edit`)">Edit</a>
                                    @endif
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Delete') == 'true')
                                        <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/board-interview/delete/{{ $item->id }}`, `updateBoardInterviewTable`, `resetBoardInterviewForm`, `None`, `None`)">Delete</a>
                                    @endif

                                </td>
                                <td>{{ $item->bid_bi_ces_we ?? '-' }}</td>
                                <td>{{ $item->r_bi_ces_we ?? '-' }}</td>
                                <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </form>
    <form class="user" id="ces_status_hr_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/ces-status/add`, `ces_status_hr_form`, `Add`, `updateCesStatusTable`, `resetCesStatusForm`, `ces_status_hr_form_submit`, `None`, `None`)">
        @csrf
        <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
            <h1>CES STATUS</h1>
        </div>
        <div class="container-fuild m-3">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" id="cesno_ces_status_hr" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                    <input type="hidden" id="cesno_ces_status_hr_id" name="cesno_ces_status_hr_id" class="form-control">
                    <label class="form-label ml-2 mb-0">CES Status<sup>*</sup></label>
                    <select name="cs_cs_ces_we" class="form-control w-100 mb-3" required>
                        <option value="">Please Select</option>
                        <option value="8">Eligible</option>
                        <option value="7">CSEE</option>
                        <option value="1">CESO I</option>
                        <option value="2">CESO II</option>
                        <option value="3">CESO III</option>
                        <option value="4">CESO IV</option>
                        <option value="5">CESO V</option>
                        <option value="6">CESO VI</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Acquired Thru<sup>*</sup></label>
                    <select name="at_cs_ces_we" class="form-control w-100 mb-3" required>
                        <option value="">Please Select</option>
                        <option value="1">Examination</option>
                        <option value="2">Motu Propio</option>
                        <option value="3">Testimonial Nomination</option>
                        <option value="4">Training</option>
                        <option value="5">MNSA E.O. 145</option>
                        <option value="0">Others</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Status Type<sup>*</sup></label>
                    <select name="st_cs_ces_we" class="form-control w-100 mb-3" required>
                        <option value="">Please Select</option>
                        <option value="2">Original</option>
                        <option value="3">Adjustment</option>
                        <option value="4">Promotion</option>
                        <option value="5">Restoration</option>
                        <option value="1">Conferment</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <!-- <label class="form-label ml-2 mb-0">Appointing Authority<sup>*</sup></label>
                                                                                    <input type="text" class="form-control w-100 mb-3" name="aa_cs_ces_we" placeholder="Name of Presidents" required> -->
                    <label class="form-label ml-2 mb-0">Appointing Authority<sup>*</sup></label>
                    <select name="aa_cs_ces_we" class="form-control w-100 mb-3" required>
                        <option value="">Please Select</option>
                        <option value="1">Ferdinand E. Marcos</option>
                        <option value="2">Corazon C. Aquino</option>
                        <option value="3">Fidel V. Ramos</option>
                        <option value="5">Gloria Macapagal Arroyo</option>
                        <option value="4">Joseph Ejercito Estrada</option>
                        <option value="6">Benigno Aquino Jr.</option>
                        <option value="7">Rodrigo Roa Duterte</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Resolution No.<sup>*</sup></label>
                    <input type="text" class="form-control w-100 mb-3" name="rn_cs_ces_we" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Date Acquired<sup>*</sup></label>
                    <input type="date" class="form-control w-100 mb-3" name="da_cs_ces_we" required>
                </div>
            </div>
            <div class="row">
                <div class="col my-3">
                    @if (count($CesStatus) === 0)
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Add') == 'true')
                            <input type="submit" id="ces_status_hr_form_submit" class="btn btn-primary mb-1" value="Add Record">
                        @endif
                    @else
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Add') == 'true')
                            <input type="submit" id="ces_status_hr_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                            <input type="button" id="ces_status_hr_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetCesStatusForm()">
                        @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Edit') == 'true')
                            <input type="submit" id="ces_status_hr_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                        @endif
                    @endif

                </div>
            </div>
        </div>
        <div class="overflow-auto">
            <table class="table-responsive-lg table-hover table">
                <thead class="bg-secondary bg-gardient text-white">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Ces Status</th>
                        <th scope="col">Acquired Thru</th>
                        <th scope="col">Status Type</th>
                        <th scope="col">Appointing Authority</th>
                        <th scope="col">Resolution No.</th>
                        <th scope="col">Date Acquired</th>
                        <th scope="col">Encoded By</th>
                        <th scope="col">Encoded Date</th>
                        <th scope="col">Last Updated By</th>
                        <th scope="col">Last Update Date</th>
                    </tr>
                </thead>
                <tbody id="CesStatus_tbody">
                    @if (count($CesStatus) === 0)

                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    @else
                        @foreach ($CesStatus as $item)
                            <tr>
                                <td>
                                    <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetCesStatusForm({{ $item->id }},`View`)">View</a>
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Edit') == 'true')
                                        <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetCesStatusForm({{ $item->id }},`Edit`)">Edit</a>
                                    @endif
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Delete') == 'true')
                                        <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/ces-status/delete/{{ $item->id }}`, `updateCesStatusTable`, `resetCesStatusForm`, `None`, `None`)">Delete</a>
                                    @endif

                                </td>
                                <td>{{ $item->cs_cs_ces_we ?? '-' }}</td>
                                <td>{{ $item->at_cs_ces_we ?? '-' }}</td>
                                <td>{{ $item->st_cs_ces_we ?? '-' }}</td>
                                <td>{{ $item->aa_cs_ces_we ?? '-' }}</td>
                                <td>{{ $item->rn_cs_ces_we ?? '-' }}</td>
                                <td>{{ $item->da_cs_ces_we ?? '-' }}</td>
                                <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </form>
</div>
