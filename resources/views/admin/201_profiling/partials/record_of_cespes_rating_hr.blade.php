<div class="tab-pane fade hidden" id="record_of_cespes_rating_hr" role="tabpanel" aria-labelledby="record_of_cespes_rating_hr-tab">
    <form class="user" id="record_of_cespes_rating_hr_form" method="POST" enctype="multipart/form-data" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/record-of-cespes-ratings/add`, `record_of_cespes_rating_hr_form`, `Add`, `updateRecordOfCespesRatingsTable`, `resetRecordOfCespesRatingsForm`, `record_of_cespes_rating_hr_form_submit`, `None`, `None`)">
        @csrf
        <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
            <h1>RECORD OF CESPES RATINGS</h1>
        </div>
        <div class="container-fuild m-3">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" id="cesno_record_of_cespes_rating_hr" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                    <input type="hidden" id="cesno_record_of_cespes_rating_hr_id" name="cesno_record_of_cespes_rating_hr_id" class="form-control">
                    <label class="form-label ml-2 mb-0">Date (From)<sup>*</sup></label>
                    <input type="date" class="form-control w-100 mb-3" name="date_from_rocr" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Date (To)<sup>*</sup></label>
                    <input type="date" class="form-control w-100 mb-3" name="date_to_rocr" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Rating<sup>*</sup></label>
                    <input type="text" class="form-control w-100 mb-3" name="rating_rocr" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Status<sup>*</sup></label>
                    <input type="text" class="form-control w-100 mb-3" name="status_rocr" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label ml-2 mb-0">Remarks<sup>*</sup></label>
                    <textarea class="form-control w-100 mb-3" style="text-transform:capitalize" name="remarks_rocr" id="" rows="4" required></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Attached Certificate of Rating (PDF Format)<sup>*</sup></label>
                    <input id="pdf_rating_certificate_rocr" name="pdf_rating_certificate_rocr" accept="application/pdf" type="file" onclick="validateFileSize(`pdf_rating_certificate_rocr`, 25)" required>
                </div>
            </div>
            <div class="row">
                <div class="col my-3">
                    @if (count($RecordOfCespesRatings) === 0)
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Record of CESPES Ratings', 'Add') == 'true')
                            <input type="submit" id="record_of_cespes_rating_hr_form_submit" class="btn btn-primary mb-1" value="Add Record">
                        @endif
                    @else
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Record of CESPES Ratings', 'Add') == 'true')
                            <input type="submit" id="record_of_cespes_rating_hr_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                            <input type="button" id="record_of_cespes_rating_hr_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetRecordOfCespesRatingsForm()">
                        @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Record of CESPES Ratings', 'Edit') == 'true')
                            <input type="submit" id="record_of_cespes_rating_hr_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
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
                        <th scope="col">Date From</th>
                        <th scope="col">Date To</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Status</th>
                        <th scope="col">Remarks</th>
                        <th scope="col">Attached Certificate of Rating</th>
                        <th scope="col">Encoded By</th>
                        <th scope="col">Encoded Date</th>
                        <th scope="col">Last Updated By</th>
                        <th scope="col">Last Update Date</th>
                    </tr>
                </thead>
                <tbody id="RecordOfCespesRatings_tbody">
                    @if (count($RecordOfCespesRatings) === 0)

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
                        @foreach ($RecordOfCespesRatings as $item)
                            <tr>
                                <td>
                                    <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetRecordOfCespesRatingsForm({{ $item->id }},`View`)">View</a>
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Record of CESPES Ratings', 'Edit') == 'true')
                                        <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetRecordOfCespesRatingsForm({{ $item->id }},`Edit`)">Edit</a>
                                    @endif
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Record of CESPES Ratings', 'Delete') == 'true')
                                        <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/record-of-cespes-ratings/delete/{{ $item->id }}`, `updateRecordOfCespesRatingsTable`, `resetRecordOfCespesRatingsForm`, `None`, `None`)">Delete</a>
                                    @endif

                                </td>
                                <td>{{ $item->date_from_rocr ?? '-' }}</td>
                                <td>{{ $item->date_to_rocr ?? '-' }}</td>
                                <td>{{ $item->rating_rocr ?? '-' }}</td>
                                <td>{{ $item->status_rocr ?? '-' }}</td>
                                <td>{{ $item->remarks_rocr ?? '-' }}</td>
                                <td><a href="{{ asset('external-storage/PDF Documents/201 Folder/CESPES Certificate of Rating/' . $item->pdf_rating_certificate_rocr) }}">{{ $item->pdf_rating_certificate_rocr ?? '-' }}</a></td>
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
