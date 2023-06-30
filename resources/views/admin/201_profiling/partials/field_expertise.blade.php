<div class="tab-pane fade hidden" id="field_expertise" role="tabpanel" aria-labelledby="field_expertise-tab">
    <form class="user" id="field_expertise_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/field-expertise/add`, `field_expertise_form`, `Add`, `updateFieldExpertiseTable`, `resetFieldExpertiseForm`, `field_expertise_form_submit`, `None`, `None`)">
        @csrf
        <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
            <h1>RECORDS OF FIELD OF EXPERTISE / SPECIALIZATION</h1>
        </div>
        <div class="container-fuild m-3">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" id="cesno_field_expertise" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                    <input type="hidden" id="cesno_field_expertise_id" name="cesno_field_expertise_id" class="form-control">
                    <label class="form-label ml-2 mb-0">Expertise<sup>*</sup></label>
                    <input type="text" name="ec_field_expertise" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Field of Specialization<sup>*</sup></label>
                    <input type="text" name="ss_field_expertise" class="form-control w-100 mb-3" required>
                </div>
            </div>
            <div class="row">
                <div class="col my-3">
                    @if (count($FieldExpertise) === 0)
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Records of Field of Expertise or Specialization', 'Add') == 'true')
                            <input type="submit" id="field_expertise_form_submit" class="btn btn-primary mb-1" value="Add Record">
                        @endif
                    @else
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Records of Field of Expertise or Specialization', 'Add') == 'true')
                            <input type="submit" id="field_expertise_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                            <input type="button" id="field_expertise_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetFieldExpertiseForm()">
                        @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Records of Field of Expertise or Specialization', 'Edit') == 'true')
                            <input type="submit" id="field_expertise_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
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
                        <th scope="col">Expertise Category</th>
                        <th scope="col">Special Skills</th>
                        <th scope="col">Encoded By</th>
                        <th scope="col">Encoded Date</th>
                        <th scope="col">Last Updated By</th>
                        <th scope="col">Last Update Date</th>
                    </tr>
                </thead>
                <tbody id="FieldExpertise_tbody">
                    @if (count($FieldExpertise) === 0)

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
                        @foreach ($FieldExpertise as $item)
                            <tr>
                                <td>
                                    <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetFieldExpertiseForm({{ $item->id }},`View`)">View</a>
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Records of Field of Expertise or Specialization', 'Edit') == 'true')
                                        <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetFieldExpertiseForm({{ $item->id }},`Edit`)">Edit</a>
                                    @endif
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Records of Field of Expertise or Specialization', 'Delete') == 'true')
                                        <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/field-expertise/delete/{{ $item->id }}`, `updateFieldExpertiseTable`, `resetFieldExpertiseForm`, `None`, `None`)">Delete</a>
                                    @endif

                                </td>
                                <td>{{ $item->ec_field_expertise ?? '-' }}</td>
                                <td>{{ $item->ss_field_expertise ?? '-' }}</td>
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
