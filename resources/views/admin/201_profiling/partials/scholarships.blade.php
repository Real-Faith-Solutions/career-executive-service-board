<div class="tab-pane fade hidden" id="scholarships" role="tabpanel" aria-labelledby="scholarships-tab">
    <form class="user" id="scholarships_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/scholarships/add`, `scholarships_form`, `Add`, `updateScholarshipsTable`, `resetScholarshipsForm`, `scholarships_form_submit`, `None`, `None`)">
        @csrf
        <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
            <h1>SCHOLARSHIP RECEIVED</h1>
        </div>
        <div class="container-fuild m-3">
            <div class="row">
                <div class="col-md-4">
                    <input type="hidden" id="cesno_scholarships" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                    <input type="hidden" id="cesno_scholarships_id" name="cesno_scholarships_id" class="form-control">
                    <label class="form-label ml-2 mb-0">Date (From)<sup>*</sup></label>
                    <input type="date" name="date_f_scholarships" class="w-100 form-control mb-3" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label ml-2 mb-0">Date (To)<sup>*</sup></label>
                    <input type="date" name="date_t_scholarships" class="w-100 form-control mb-3" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label ml-2 mb-0">Scholar Type<sup>*</sup></label>
                    <select name="scholar_type_scholarships" aria-aria-controls='example' class="date-picker w-100 form-control mb-3" required>
                        <option value="">Please Select</option>
                        <option value="Local">Local</option>
                        <option value="Foreign">Foreign</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Title<sup>*</sup></label>
                    <input type="text" name="title_scholarships" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Sponsor<sup>*</sup></label>
                    <input type="text" name="sponsor_scholarships" class="form-control w-100 mb-3" required>
                </div>
            </div>
            <div class="row">
                <div class="col my-3">
                    @if (count($Scholarships) === 0)
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Scholarships Received', 'Add') == 'true')
                            <input type="submit" id="scholarships_form_submit" class="btn btn-primary mb-1" value="Add Record">
                        @endif
                    @else
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Scholarships Received', 'Add') == 'true')
                            <input type="submit" id="scholarships_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                            <input type="button" id="scholarships_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetScholarshipsForm()">
                        @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Scholarships Received', 'Edit') == 'true')
                            <input type="submit" id="scholarships_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
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
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">Scholarship Type</th>
                        <th scope="col">Title</th>
                        <th scope="col">Sponsor</th>
                        <th scope="col">Encoded By</th>
                        <th scope="col">Encoded Date</th>
                        <th scope="col">Last Updated By</th>
                        <th scope="col">Last Update Date</th>
                    </tr>
                </thead>
                <tbody id="Scholarships_tbody">
                    @if (count($Scholarships) === 0)

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
                        @foreach ($Scholarships as $item)
                            <tr>
                                <td>
                                    <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetScholarshipsForm({{ $item->id }},`View`)">View</a>
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Scholarships Received', 'Edit') == 'true')
                                        <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetScholarshipsForm({{ $item->id }},`Edit`)">Edit</a>
                                    @endif
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Scholarships Received', 'Delete') == 'true')
                                        <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/scholarships/delete/{{ $item->id }}`, `updateScholarshipsTable`, `resetScholarshipsForm`, `None`, `None`)">Delete</a>
                                    @endif

                                </td>
                                <td>{{ $item->date_f_scholarships ?? '-' }}</td>
                                <td>{{ $item->date_t_scholarships ?? '-' }}</td>
                                <td>{{ $item->scholar_type_scholarships ?? '-' }}</td>
                                <td>{{ $item->title_scholarships ?? '-' }}</td>
                                <td>{{ $item->sponsor_scholarships ?? '-' }}</td>
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
