@if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Health Record', 'Category Only') == 'true')

    <!-- start health record -->
    <div class="tab-pane fade hidden" id="health_records" role="tabpanel" aria-labelledby="health_records-tab">
        <form class="user" id="health_records_magna_carta_for_disabled_persons_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/health-records/add`, `health_records_magna_carta_for_disabled_persons_form`, `Add`, `updateHealthRecordsTable`, `resetHealthRecordsForm`, `health_records_magna_carta_for_disabled_persons_form_submit`, `None`, `None`)">
            @csrf
            <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
                <h1>HEALTH RECORDS</h1>
            </div>
            <div class="container-fuild m-3">
                <div class="row">
                    <div class="col-md-6 ml-3">
                        <input type="hidden" id="cesno_health_records_magna_carta_for_disabled_persons" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                        <input type="hidden" id="cesno_health_records_magna_carta_for_disabled_persons_id" name="cesno_health_records_magna_carta_for_disabled_persons_id" class="form-control">
                        <input class="form-check-input" type="checkbox" id="dhdCheckB">
                        <label class="form-label ml-2 mb-0" for="DHD">If (Magna Carta for Disabled Persons RA 7277)</label>
                        <select name="mcfdpra_hr" id="dhdTxtB" disabled aria-aria-controls='example' class="w-75 form-control mb-3">
                            <option value="">Please Indicate</option>
                            <option value="Disability">Disability</option>
                            <option value="Handicap">Handicap</option>
                            <option value="Defect">Defect</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label ml-2 mb-0">Blood Type<sup>*</sup></label>
                        <input type="text" name="blood_type_hr" class="form-control w-100 mb-3" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label ml-2 mb-0">Identifying Marks<sup>*</sup></label>
                        <input type="text" name="identify_marks_hr" class="form-control w-100 mb-3" style="text-transform:capitalize" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col my-3">
                        @if (count($HealthRecords) === 0)
                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Health Record', 'Add') == 'true')
                                <input type="submit" id="health_records_magna_carta_for_disabled_persons_form_submit" class="btn btn-primary mb-1" value="Add Record">
                            @endif
                        @else
                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Health Record', 'Add') == 'true')
                                <input type="submit" id="health_records_magna_carta_for_disabled_persons_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                <input type="button" id="health_records_magna_carta_for_disabled_persons_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetHealthRecordsForm()">
                            @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Health Record', 'Edit') == 'true')
                                <input type="submit" id="health_records_magna_carta_for_disabled_persons_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
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
                            <th scope="col">Magna Carta for Disabled Person</th>
                            <th scope="col">BloodType</th>
                            <th scope="col">Identifying Marks</th>
                            <th scope="col">Encoded By</th>
                            <th scope="col">Encoded Date</th>
                            <th scope="col">Last Updated By</th>
                            <th scope="col">Last Update Date</th>
                        </tr>
                    </thead>
                    <tbody id="HealthRecords_tbody">
                        @if (count($HealthRecords) === 0)

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
                            @foreach ($HealthRecords as $item)
                                <tr>
                                    <td>
                                        <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetHealthRecordsForm({{ $item->id }},`View`)">View</a>
                                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Health Record', 'Edit') == 'true')
                                            <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetHealthRecordsForm({{ $item->id }},`Edit`)">Edit</a>
                                        @endif
                                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Health Record', 'Delete') == 'true')
                                            <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/health-records/delete/{{ $item->id }}`, `updateHealthRecordsTable`, `resetHealthRecordsForm`, `None`, `None`)">Delete</a>
                                        @endif

                                    </td>
                                    <td>{{ $item->mcfdpra_hr ?? '-' }}</td>
                                    <td>{{ $item->blood_type_hr ?? '-' }}</td>
                                    <td>{{ $item->identify_marks_hr ?? '-' }}</td>
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
        <form class="user" id="health_records_historical_record_of_medical_condition_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/historical-record-of-medical-condition/add`, `health_records_historical_record_of_medical_condition_form`, `Add`, `updateHistoricalRecordOfMedicalConditionTable`, `resetHistoricalRecordOfMedicalConditionForm`, `health_records_historical_record_of_medical_condition_form_submit`, `None`, `None`)">
            @csrf
            <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
                <h1>HISTORICAL RECORD OF MEDICAL CONDTION</h1>
            </div>
            <div class="container-fuild m-3">
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" id="cesno_health_records_historical_record_of_medical_condition" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                        <input type="hidden" id="cesno_health_records_historical_record_of_medical_condition_id" name="cesno_health_records_historical_record_of_medical_condition_id" class="form-control">
                        <label class="form-label ml-2 mb-0">Date<sup>*</sup></label>
                        <input type="date" name="date_hronc" class="form-control w-100 mb-3" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label ml-2 mb-0">Medical Condition / Illness<sup>*</sup></label>
                        <input type="text" name="mci_hronc" class="form-control w-100 mb-3" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label ml-2 mb-0">Notes<sup>*</sup></label>
                        <textarea name="notes_hronc" class="form-control w-100 mb-3 rounded" style="text-transform:capitalize" rows="4" required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col my-3">
                        @if (count($HistoricalRecordOfMedicalCondition) === 0)
                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Health Record', 'Add') == 'true')
                                <input type="submit" id="health_records_historical_record_of_medical_condition_form_submit" class="btn btn-primary mb-1" value="Add Record">
                            @endif
                        @else
                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Health Record', 'Add') == 'true')
                                <input type="submit" id="health_records_historical_record_of_medical_condition_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                <input type="button" id="health_records_historical_record_of_medical_condition_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetHistoricalRecordOfMedicalConditionForm()">
                            @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Health Record', 'Edit') == 'true')
                                <input type="submit" id="health_records_historical_record_of_medical_condition_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
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
                            <th scope="col">Date</th>
                            <th scope="col">Medical Condition / Illness</th>
                            <th scope="col">Notes</th>
                            <th scope="col">Encoded By</th>
                            <th scope="col">Encoded Date</th>
                            <th scope="col">Last Updated By</th>
                            <th scope="col">Last Update Date</th>
                        </tr>
                    </thead>
                    <tbody id="HistoricalRecordOfMedicalCondition_tbody">
                        @if (count($HistoricalRecordOfMedicalCondition) === 0)

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
                            @foreach ($HistoricalRecordOfMedicalCondition as $item)
                                <tr>
                                    <td>
                                        <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetHistoricalRecordOfMedicalConditionForm({{ $item->id }},`View`)">View</a>
                                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Health Record', 'Edit') == 'true')
                                            <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetHistoricalRecordOfMedicalConditionForm({{ $item->id }},`Edit`)">Edit</a>
                                        @endif
                                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Health Record', 'Delete') == 'true')
                                            <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/historical-record-of-medical-condition/delete/{{ $item->id }}`, `updateHistoricalRecordOfMedicalConditionTable`, `resetHistoricalRecordOfMedicalConditionForm`, `None`, `None`)">Delete</a>
                                        @endif

                                    </td>
                                    <td>{{ $item->date_hronc ?? '-' }}</td>
                                    <td>{{ $item->mci_hronc ?? '-' }}</td>
                                    <td>{{ $item->notes_hronc ?? '-' }}</td>
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
    <!-- end health record -->

@endif
