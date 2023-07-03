<div class="tab-pane fade" id="family-profile" role="tabpanel" aria-labelledby="family-profile-tab">
    <form class="user" id="spouse_records_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/spouse-records/add`, `spouse_records_form`, `Add`, `updateSpouseRecordsTable`, `resetSpouseRecordsForm`, `spouse_records_form_submit`, `None`, `None`)">
        @csrf
        <div class="bg-blue-500 p-2 uppercase text-white">
            <h1>Spouse name</h1>
        </div>
        <div class="container-fuild m-3">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" id="cesno_spouse_records" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                    <input type="hidden" id="cesno_spouse_records_id" name="cesno_spouse_records_id" class="form-control">
                    <label class="form-label ml-2 mb-0">Lastname<sup>*</sup></label>
                    <input type="text" name="lastname_sn_fp" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Firstname<sup>*</sup></label>
                    <input type="text" name="first_sn_fp" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Middlename<sup>*</sup></label>
                    <input type="text" minlength="2" name="middlename_sn_fp" class="noNotallow form-control w-100 mb-3" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label ml-2 mb-0">Name Extension</label>
                    <select name="ne_sn_fp" class="form-control w-100 mb-3">
                        <option value="">Please Select</option>
                        <option value="Jr.">Jr.</option>
                        <option value="Sr.">Sr.</option>
                        <option value="I">I</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
                        <option value="V">V</option>
                        <option value="VI">VI</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Occupation</label>
                    <input type="text" class="w-100 form-control mb-3" name="occu_sn_fp" />
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Employer / Business Name</label>
                    <input type="text" class="w-100 form-control mb-3" name="ebn_sn_fp" />
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Employer / Business Address</label>
                    <input type="text" class="w-100 form-control mb-3" name="eba_sn_fp" />
                </div>
                <div class="col-md-4">
                    <label class="form-label ml-2 mb-0">Employer's Telephone No.</label>
                    <input type="text" class="w-100 form-control mb-3" name="etn_sn_fp" />
                </div>
                <div class="col-md-4">
                    <label class="form-label ml-2 mb-0">Civil Status<sup>*</sup></label>
                    <select name="civil_status_sn_fp" aria-aria-controls='example' class="w-100 form-control mb-3" required>
                        <option value="">Please Select</option>
                        <option value="Married">Married</option>
                        <option value="Single">Single</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Widowed">Widowed</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label ml-2 mb-0">Gender By Birth<sup>*</sup></label>
                    <select name="gender_sn_fp" aria-aria-controls='example' class="w-100 form-control mb-3" required>
                        <option value="">Please Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label ml-2 mb-0">Birthdate<sup>*</sup></label>
                    <input type="date" class="mydobs w-100 form-control mb-3" name="birthdate_sn_fp" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label ml-2 mb-0">Age<sup>*</sup></label>
                    <input type="text" class="ages w-100 form-control mb-3" name="age_sn_fp" readonly />
                </div>
            </div>
            <div class="row">
                <div class="col my-3">
                    @if (count($SpouseRecords) === 0)
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Add') == 'true')
                            <input type="submit" id="spouse_records_form_submit" class="btn btn-primary mb-1" value="Add Record">
                        @endif
                    @else
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Add') == 'true')
                            <input type="submit" id="spouse_records_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                            <input type="button" id="spouse_records_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetSpouseRecordsForm()">
                        @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Edit') == 'true')
                            <input type="submit" id="spouse_records_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
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
                        <th scope="col">Spouse Lastname</th>
                        <th scope="col">Spouse Firstname</th>
                        <th scope="col">Spouse Middlename</th>
                        <th scope="col">Spouse Name Extension</th>
                        <th scope="col">Spouse Occupation</th>
                        <th scope="col">Spouse Employer/Business Name</th>
                        <th scope="col">Spouse Employer/Business Address</th>
                        <th scope="col">Spouse Employer/Business No.</th>
                        <th scope="col">Spouse Civil Status</th>
                        <th scope="col">Spouse Gender</th>
                        <th scope="col">Spouse Birthdate</th>
                        <th scope="col">Spouse Age</th>
                        <th scope="col">Encoded By</th>
                        <th scope="col">Encoded Date</th>
                        <th scope="col">Last Updated By</th>
                        <th scope="col">Last Update Date</th>
                    </tr>
                </thead>
                <tbody id="SpouseRecords_tbody">
                    @if (count($SpouseRecords) === 0)

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
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    @else
                        @foreach ($SpouseRecords as $item)
                            <tr>
                                <td>
                                    <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetSpouseRecordsForm({{ $item->id }},`View`)">View</a>
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Edit') == 'true')
                                        <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetSpouseRecordsForm({{ $item->id }},`Edit`)">Edit</a>
                                    @endif
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Delete') == 'true')
                                        <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/spouse-records/delete/{{ $item->id }}`, `updateSpouseRecordsTable`, `resetSpouseRecordsForm`, `None`, `None`)">Delete</a>
                                    @endif

                                </td>
                                <td>{{ $item->lastname_sn_fp ?? '-' }}</td>
                                <td>{{ $item->first_sn_fp ?? '-' }}</td>
                                <td>{{ $item->middlename_sn_fp ?? '-' }}</td>
                                <td>{{ $item->ne_sn_fp ?? '-' }}</td>
                                <td>{{ $item->occu_sn_fp ?? '-' }}</td>
                                <td>{{ $item->ebn_sn_fp ?? '-' }}</td>
                                <td>{{ $item->eba_sn_fp ?? '-' }}</td>
                                <td>{{ $item->etn_sn_fp ?? '-' }}</td>
                                <td>{{ $item->civil_status_sn_fp ?? '-' }}</td>
                                <td>{{ $item->gender_sn_fp ?? '-' }}</td>
                                <td>{{ $item->birthdate_sn_fp ?? '-' }}</td>
                                <td>{{ $item->age_sn_fp ?? '-' }}</td>
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
    @if (count($FamilyProfile) === 0)
        <form class="user" id="family_profile_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/family-profile/add`, `family_profile_form`, `Add`, `updateFamilyProfileTable`, `resetFamilyProfileForm`, `family_profile_form_submit`, `None`, `None`)">
        @else
            <form class="user" id="family_profile_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/family-profile/edit`, `family_profile_form`, `Update`, `updateFamilyProfileTable`, `resetFamilyProfileForm`, `family_profile_form_submit`, `None`, `None`)">
    @endif

    @csrf
    <div class="bg-blue-500 p-2 uppercase text-white">
        <h1>Father's name</h1>
    </div>
    <div class="container-fuild m-3">
        <div class="row">
            <div class="col-md-6">
                <input type="hidden" id="cesno_family_profile" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                <input type="hidden" id="cesno_family_profile_id" name="cesno_family_profile_id" class="form-control">
                <label class="form-label ml-2 mb-0">Lastname<sup>*</sup></label>
                <input type="text" name="fn_lastname_fp" class="form-control w-100 mb-3" required>
            </div>
            <div class="col-md-6">
                <label class="form-label ml-2 mb-0">Firstname<sup>*</sup></label>
                <input type="text" name="fn_first_fp" class="form-control w-100 mb-3" required>
            </div>
            <div class="col-md-6">
                <label class="form-label ml-2 mb-0">Middlename<sup>*</sup></label>
                <input type="text" minlength="2" name="fn_middlename_fp" class="noNotallow form-control w-100 mb-3" required>
            </div>
            <div class="col-md-4">
                <label class="form-label ml-2 mb-0">Name Extension</label>
                <select name="fn_ne_fp" class="form-control w-100 mb-3">
                    <option value="">Please Select</option>
                    <option value="Jr.">Jr.</option>
                    <option value="Sr.">Sr.</option>
                    <option value="I">I</option>
                    <option value="II">II</option>
                    <option value="III">III</option>
                    <option value="IV">IV</option>
                    <option value="V">V</option>
                    <option value="VI">VI</option>
                </select>
            </div>
        </div>
    </div>
    <div class="bg-blue-500 p-2 uppercase text-white">
        <h1>Mothers Maiden name</h1>
    </div>
    <div class="container-fuild m-3">
        <div class="row">
            <div class="col-md-6">
                <label class="form-label ml-2 mb-0">Lastname<sup>*</sup></label>
                <input type="text" name="mn_lastname_fp" class="form-control w-100 mb-3" required>
            </div>
            <div class="col-md-6">
                <label class="form-label ml-2 mb-0">Firstname<sup>*</sup></label>
                <input type="text" name="mn_first_fp" class="form-control w-100 mb-3" required>
            </div>
            <div class="col-md-6">
                <label class="form-label ml-2 mb-0">Middlename<sup>*</sup></label>
                <input type="text" minlength="2" name="mn_middlename_fp" class="noNotallow form-control w-100 mb-3" required>
            </div>
        </div>
        <div class="row">
            <div class="col my-3">
                @if (count($FamilyProfile) === 0)
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Add') == 'true')
                        <input type="submit" id="family_profile_form_submit" class="btn btn-primary mb-1" value="Add Record">
                    @endif
                @else
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Edit') == 'true')
                        <input type="submit" id="family_profile_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
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
                    <th scope="col">Father Lastname</th>
                    <th scope="col">Father Firstname</th>
                    <th scope="col">Father Middlename</th>
                    <th scope="col">Father Name Extension</th>
                    <th scope="col">Mother Lastname</th>
                    <th scope="col">Mother Firstname</th>
                    <th scope="col">Mother Middlename</th>
                    <th scope="col">Encoded By</th>
                    <th scope="col">Encoded Date</th>
                    <th scope="col">Last Updated By</th>
                    <th scope="col">Last Update Date</th>
                </tr>
            </thead>
            <tbody id="FamilyProfile_tbody">
                @if (count($FamilyProfile) === 0)

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
                        <td>-</td>
                    </tr>
                @else
                    @foreach ($FamilyProfile as $item)
                        <tr>
                            <td>
                                <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetFamilyProfileForm({{ $item->id }},`View`)">View</a>
                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Edit') == 'true')
                                    <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetFamilyProfileForm({{ $item->id }},`Edit`)">Edit</a>
                                @endif

                            </td>
                            <td>{{ $item->fn_lastname_fp ?? '-' }}</td>
                            <td>{{ $item->fn_first_fp ?? '-' }}</td>
                            <td>{{ $item->fn_middlename_fp ?? '-' }}</td>
                            <td>{{ $item->fn_ne_fp ?? '-' }}</td>
                            <td>{{ $item->mn_lastname_fp ?? '-' }}</td>
                            <td>{{ $item->mn_first_fp ?? '-' }}</td>
                            <td>{{ $item->mn_middlename_fp ?? '-' }}</td>
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
    <form class="user" id="children_record_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/children-records/add`, `children_record_form`, `Add`, `updateChildrenRecordsTable`, `resetChildrenRecordsForm`, `children_record_form_submit`, `None`, `None`)">
        @csrf
        <div class="bg-blue-500 p-2 uppercase text-white">
            <h1>Childrens record</h1>
        </div>
        <div class="container-fuild m-3">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" id="cesno_children_record" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                    <input type="hidden" id="cesno_children_record_id" name="cesno_children_record_id" class="form-control">
                    <label class="form-label ml-2 mb-0">Lastname<sup>*</sup></label>
                    <input type="text" name="ch_lastname_fp" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Firstname<sup>*</sup></label>
                    <input type="text" name="ch_first_fp" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Middlename<sup>*</sup></label>
                    <input type="text" minlength="2" name="ch_middlename_fp" class="noNotallow form-control w-100 mb-3" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label ml-2 mb-0">Name Extension</label>
                    <select name="ch_ne_fp" class="form-control w-100 mb-3">
                        <option value="">Please Select</option>
                        <option value="Jr.">Jr.</option>
                        <option value="Sr.">Sr.</option>
                        <option value="I">I</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
                        <option value="V">V</option>
                        <option value="VI">VI</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label ml-2 mb-0">Gender By Birth<sup>*</sup></label>
                    <select name="ch_gender_fp" aria-aria-controls='example' class="w-100 form-control mb-3" required>
                        <option value="">Please Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label ml-2 mb-0">Birthdate<sup>*</sup></label>
                    <input type="date" class="mydob w-100 form-control mb-3" name="ch_birthdate_fp" required>
                </div>
                <div class="col-md-9">
                    <label class="form-label ml-2 mb-0">Birth Place</label>
                    <input type="text" class="w-100 form-control mb-3" name="ch_birthplace_fp" />
                </div>
            </div>
            <div class="row">
                <div class="col my-3">
                    @if (count($ChildrenRecords) === 0)
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Add') == 'true')
                            <input type="submit" id="children_record_form_submit" class="btn btn-primary mb-1" value="Add Record">
                            <input type="button" id="children_record_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetChildrenRecordsForm()" hidden>
                        @endif
                    @else
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Add') == 'true')
                            <input type="submit" id="children_record_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                            <input type="button" id="children_record_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetChildrenRecordsForm()">
                        @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Edit') == 'true')
                            <input type="submit" id="children_record_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
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
                        <th scope="col">Lastname</th>
                        <th scope="col">Firstname</th>
                        <th scope="col">Middlename</th>
                        <th scope="col">Name Extension</th>
                        <th scope="col">Gender By Birth</th>
                        <th scope="col">Birthdate</th>
                        <th scope="col">Birth Place</th>
                        <th scope="col">Encoded By</th>
                        <th scope="col">Encoded Date</th>
                        <th scope="col">Last Updated By</th>
                        <th scope="col">Last Update Date</th>
                    </tr>
                </thead>
                <tbody id="ChildrenRecords_tbody">
                    @if (count($ChildrenRecords) === 0)

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
                            <td>-</td>
                        </tr>
                    @else
                        @foreach ($ChildrenRecords as $item)
                            <tr>
                                <td>
                                    <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetChildrenRecordsForm({{ $item->id }},`View`)">View</a>
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Edit') == 'true')
                                        <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetChildrenRecordsForm({{ $item->id }},`Edit`)">Edit</a>
                                    @endif
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Delete') == 'true')
                                        <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/children-records/delete/{{ $item->id }}`, `updateChildrenRecordsTable`, `resetChildrenRecordsForm`, `None`, `None`)">Delete</a>
                                    @endif

                                </td>
                                <td>{{ $item->ch_lastname_fp ?? '-' }}</td>
                                <td>{{ $item->ch_first_fp ?? '-' }}</td>
                                <td>{{ $item->ch_middlename_fp ?? '-' }}</td>
                                <td>{{ $item->ch_ne_fp ?? '-' }}</td>
                                <td>{{ $item->ch_gender_fp ?? '-' }}</td>
                                <td>{{ $item->ch_birthdate_fp ?? '-' }}</td>
                                <td>{{ $item->ch_birthplace_fp ?? '-' }}</td>
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
