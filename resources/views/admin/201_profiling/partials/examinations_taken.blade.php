<div class="tab-pane fade hidden" id="examinations_taken" role="tabpanel" aria-labelledby="examinations_taken-tab">
    <form class="user" id="examinations_taken_historical_record_of_examinations_taken_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/examination-taken/add`, `examinations_taken_historical_record_of_examinations_taken_form`, `Add`, `updateExaminationsTakenTable`, `resetExaminationsTakenForm`, `examinations_taken_historical_record_of_examinations_taken_form_submit`, `None`, `None`)">
        @csrf
        <div class="bg-blue-500 p-2 uppercase text-white">
            <h1>HISTORICAL RECORDS OF EXAMINATIONS TAKEN</h1>
        </div>
        <div class="container-fuild m-3">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" id="cesno_examinations_taken_historical_records" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                    <input type="hidden" id="cesno_examinations_taken_historical_records_id" name="cesno_examinations_taken_historical_records_id" class="form-control">
                    <label class="form-label ml-2 mb-0">Type of Examination<sup>*</sup></label>
                    <select name="tox_et" class="form-control w-100 mb-3" required>
                        <option value="">Please Select</option>
                        @foreach ($ExaminationReference as $item)
                            <option value="{{ $item->TITLE }}">{{ $item->TITLE }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Rating<sup>*</sup></label>
                    <input type="text" name="rating_et" class="form-control mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Date of Examination<sup>*</sup></label>
                    <input type="date" name="doe_et" class="form-control mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Place of Examination<sup>*</sup></label>
                    <input type="text" name="poe_et" class="form-control mb-3" required>
                </div>
            </div>
            <div class="row">
                <div class="col my-3">
                    @if (count($ExaminationsTaken) === 0)
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'Add') == 'true')
                            <input type="submit" id="examinations_taken_historical_record_of_examinations_taken_form_submit" class="btn btn-primary mb-1" value="Add Record">
                        @endif
                    @else
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'Add') == 'true')
                            <input type="submit" id="examinations_taken_historical_record_of_examinations_taken_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                            <input type="button" id="examinations_taken_historical_record_of_examinations_taken_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetExaminationsTakenForm()">
                        @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'Edit') == 'true')
                            <input type="submit" id="examinations_taken_historical_record_of_examinations_taken_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
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
                        <th scope="col">Type of Examination</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Date of Examination</th>
                        <th scope="col">Place of Examination</th>
                        <th scope="col">Encoded By</th>
                        <th scope="col">Encoded Date</th>
                        <th scope="col">Last Updated By</th>
                        <th scope="col">Last Update Date</th>
                    </tr>
                </thead>
                <tbody id="ExaminationsTaken_tbody">
                    @if (count($ExaminationsTaken) === 0)

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
                        @foreach ($ExaminationsTaken as $item)
                            <tr>
                                <td>
                                    <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetExaminationsTakenForm({{ $item->id }},`View`)">View</a>
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'Edit') == 'true')
                                        <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetExaminationsTakenForm({{ $item->id }},`Edit`)">Edit</a>
                                    @endif
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'Delete') == 'true')
                                        <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/examination-taken/delete/{{ $item->id }}`, `updateExaminationsTakenTable`, `resetExaminationsTakenForm`, `None`, `None`)">Delete</a>
                                    @endif

                                </td>
                                <td>{{ $item->tox_et ?? '-' }}</td>
                                <td>{{ $item->rating_et ?? '-' }}</td>
                                <td>{{ $item->doe_et ?? '-' }}</td>
                                <td>{{ $item->poe_et ?? '-' }}</td>
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
    <form class="user" id="examinations_taken_license_details_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/license-details/add`, `examinations_taken_license_details_form`, `Add`, `updateLicenseDetailsTable`, `resetLicenseDetailsForm`, `examinations_taken_license_details_form_submit`, `None`, `None`)">
        @csrf
        <div class="bg-blue-500 p-2 uppercase text-white">
            <h1>LICENSE DETAILS</h1>
        </div>

        <div class="container-fuild m-3">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="hidden" id="cesno_examinations_taken_license_details" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                    <input type="hidden" id="cesno_examinations_taken_license_details_id" name="cesno_examinations_taken_license_details_id" class="form-control">
                    <label class="form-label ml-2 mb-0">License Number<sup>*</sup></label>
                    <input type="text" name="ld_ln_et" class="form-control mb-3" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label ml-2 mb-0">Date Acquired<sup>*</sup></label>
                    <input type="date" name="ld_da_et" class="form-control mb-3" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label ml-2 mb-0">Date of Validity<sup>*</sup></label>
                    <input type="date" name="ld_dov_et" class="form-control mb-3" required>
                </div>
            </div>
            <div class="row">
                <div class="col my-3">
                    @if (count($LicenseDetails) === 0)
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'Add') == 'true')
                            <input type="submit" id="examinations_taken_license_details_form_submit" class="btn btn-primary mb-1" value="Add Record">
                        @endif
                    @else
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'Add') == 'true')
                            <input type="submit" id="examinations_taken_license_details_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                            <input type="button" id="examinations_taken_license_details_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetLicenseDetailsForm()">
                        @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'Edit') == 'true')
                            <input type="submit" id="examinations_taken_license_details_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
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
                        <th scope="col">License Number</th>
                        <th scope="col">Date Acquired</th>
                        <th scope="col">Date of Validity</th>
                        <th scope="col">Encoded By</th>
                        <th scope="col">Encoded Date</th>
                        <th scope="col">Last Updated By</th>
                        <th scope="col">Last Update Date</th>
                    </tr>
                </thead>
                <tbody id="LicenseDetails_tbody">
                    @if (count($LicenseDetails) === 0)

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
                        @foreach ($LicenseDetails as $item)
                            <tr>
                                <td>
                                    <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetLicenseDetailsForm({{ $item->id }},`View`)">View</a>
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'Edit') == 'true')
                                        <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetLicenseDetailsForm({{ $item->id }},`Edit`)">Edit</a>
                                    @endif
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'Delete') == 'true')
                                        <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/license-details/delete/{{ $item->id }}`, `updateLicenseDetailsTable`, `resetLicenseDetailsForm`, `None`, `None`)">Delete</a>
                                    @endif

                                </td>
                                <td>{{ $item->ld_ln_et ?? '-' }}</td>
                                <td>{{ $item->ld_da_et ?? '-' }}</td>
                                <td>{{ $item->ld_dov_et ?? '-' }}</td>
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
