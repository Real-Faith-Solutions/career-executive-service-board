<div class="tab-pane fade" id="case_records" role="tabpanel" aria-labelledby="case_records-tab">
    <form class="user" id="case_records_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/case-records/add`, `case_records_form`, `Add`, `updateCaseRecordsTable`, `resetCaseRecordsForm`, `case_records_form_submit`, `None`, `None`)">
        @csrf
        <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
            <h1>CASE RECORDS</h1>
        </div>
        <div class="container-fuild m-3">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" id="cesno_case_records" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                    <input type="hidden" id="cesno_case_records_id" name="cesno_case_records_id" class="form-control">
                    <label class="form-label ml-2 mb-0">Parties<sup>*</sup></label>
                    <input type="text" name="parties_case_records" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Offence<sup>*</sup></label>
                    <input type="text" name="offence_case_records" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Nature of Offence<sup>*</sup></label>
                    <select name="nature_case_records" aria-aria-controls='example' class="date-picker w-100 form-control mb-3" required>
                        <option value="">Please Select</option>
                        <option value="Administrative and Criminal">Administrative and Criminal</option>
                        <option value="Administrative">Administrative</option>
                        <option value="Criminal">Criminal</option>
                        <option value="Civil Case">Civil Case</option>
                        <option value="Violation of Sec. 3(E & F) of RA 3019">Violation of Sec. 3(E & F) of RA 3019</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Case Number<sup>*</sup></label>
                    <input type="text" name="case_no_case_records" class="form-control w-100 mb-3" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Date Field<sup>*</sup></label>
                    <input type="date" name="date_field_case_records" class="w-100 form-control mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Venue<sup>*</sup></label>
                    <input type="text" name="vanue_case_records" class="form-control w-100 mb-3" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Status<sup>*</sup></label>
                    <select name="status_case_records" aria-aria-controls='example' class="date-picker w-100 form-control mb-3" required>
                        <option value="">Please Select</option>
                        <option value="Acquitted">Acquitted</option>
                        <option value="Admonished">Admonished</option>
                        <option value="Awaiting for Formal Investigation">Awaiting for Formal Investigation</option>
                        <option value="Bail Posted">Bail Posted</option>
                        <option value="Case dismissed for Lack of Evidence as Approve">Case dismissed for Lack of Evidence as Approve</option>
                        <option value="Convicted">Convicted</option>
                        <option value="Dismissed">Dismissed</option>
                        <option value="Decided">Decided</option>
                        <option value="Exonerated">Exonerated</option>
                        <option value="Exonerated (Case Dismissed for Lack of Substance)">Exonerated (Case Dismissed for Lack of Substance)</option>
                        <option value="Final and Executory">Final and Executory</option>
                        <option value="For Arraignment">For Arraignment</option>
                        <option value="For Creation of a Hearing Committee">For Creation of a Hearing Committee</option>
                        <option value="For Formal Investigation">For Formal Investigation</option>
                        <option value="Forwarded to OP">Forwarded to OP</option>
                        <option value="Guilty for Simple Misconduct">Guilty for Simple Misconduct</option>
                        <option value="Guilty for Simple Negligence">Guilty for Simple Negligence</option>
                        <option value="Indorsed to OMB">Indorsed to OMB</option>
                        <option value="On Appeal">On Appeal</option>
                        <option value="Ongoing Investigation">Ongoing Investigation</option>
                        <option value="Ongoing Pleminary Investigation">Ongoing Pleminary Investigation</option>
                        <option value="Ongoing Admistrative Adjudication">Ongoing Admistrative Adjudication</option>
                        <option value="Order of Dismissal">Order of Dismissal</option>
                        <option value="Pending">Pending</option>
                        <option value="Pending - Indoresed to OMB">Pending - Indoresed to OMB</option>
                        <option value="Pending - Indorsed to OP">Pending - Indorsed to OP</option>
                        <option value="Pending - CA">Pending - CA</option>
                        <option value="Resolved">Resolved</option>
                        <option value="Suspension">Suspension</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Date of Finality<sup>*</sup></label>
                    <input type="date" name="dof_case_records" class="form-control w-100 mb-3" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label class="form-label ml-2 mb-0">Decision<sup>*</sup></label>
                    <input type="text" name="decision_case_records" class="form-control w-100 mb-3" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label class="form-label ml-2 mb-0">Remarks<sup>*</sup></label>
                    <textarea name="remarks_case_records" class="form-control w-100 mb-3 rounded" style="text-transform:capitalize" rows="4" required></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col my-3">
                    @if (count($CaseRecords) === 0)
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Case Records', 'Add') == 'true')
                            <input type="submit" id="case_records_form_submit" class="btn btn-primary mb-1" value="Add Record">
                        @endif
                    @else
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Case Records', 'Add') == 'true')
                            <input type="submit" id="case_records_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                            <input type="button" id="case_records_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetCaseRecordsForm()">
                        @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Case Records', 'Edit') == 'true')
                            <input type="submit" id="case_records_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
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
                        <th scope="col">Parties</th>
                        <th scope="col">Offence</th>
                        <th scope="col">Nature of Offence</th>
                        <th scope="col">Case Number</th>
                        <th scope="col">Date Field</th>
                        <th scope="col">Vanue</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date of Finality</th>
                        <th scope="col">Decision</th>
                        <th scope="col">Remarks</th>
                        <th scope="col">Encoded By</th>
                        <th scope="col">Encoded Date</th>
                        <th scope="col">Last Updated By</th>
                        <th scope="col">Last Update Date</th>
                    </tr>
                </thead>
                <tbody id="CaseRecords_tbody">
                    @if (count($CaseRecords) === 0)

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
                        </tr>
                    @else
                        @foreach ($CaseRecords as $item)
                            <tr>
                                <td>
                                    <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetCaseRecordsForm({{ $item->id }},`View`)">View</a>
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Case Records', 'Edit') == 'true')
                                        <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetCaseRecordsForm({{ $item->id }},`Edit`)">Edit</a>
                                    @endif
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Case Records', 'Delete') == 'true')
                                        <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/case-records/delete/{{ $item->id }}`, `updateCaseRecordsTable`, `resetCaseRecordsForm`, `None`, `None`)">Delete</a>
                                    @endif

                                </td>
                                <td>{{ $item->parties_case_records ?? '-' }}</td>
                                <td>{{ $item->offence_case_records ?? '-' }}</td>
                                <td>{{ $item->nature_case_records ?? '-' }}</td>
                                <td>{{ $item->case_no_case_records ?? '-' }}</td>
                                <td>{{ $item->date_field_case_records ?? '-' }}</td>
                                <td>{{ $item->vanue_case_records ?? '-' }}</td>
                                <td>{{ $item->status_case_records ?? '-' }}</td>
                                <td>{{ $item->dof_case_records ?? '-' }}</td>
                                <td>{{ $item->decision_case_records ?? '-' }}</td>
                                <td>{{ $item->remarks_case_records ?? '-' }}</td>
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
