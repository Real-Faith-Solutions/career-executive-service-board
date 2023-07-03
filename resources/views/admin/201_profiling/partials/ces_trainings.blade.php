<div class="tab-pane fade" id="ces_trainings" role="tabpanel" aria-labelledby="ces_trainings-tab">
    <form class="user" id="ces_trainings_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/ces-trainings/add`, `ces_trainings_form`, `Add`, `updateCesTrainingsTable`, `resetCesTrainingsForm`, `ces_trainings_form_submit`, `None`, `None`)">
        @csrf
        <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
            <h1>HISTORICAL RECORD OF CES TRAININGS</h1>
        </div>
        <div class="container-fuild m-3">
            <div class="row">
                <div class="col-md-4">
                    <input type="hidden" id="cesno_ces_trainings" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                    <input type="hidden" id="cesno_ces_trainings_id" name="cesno_ces_trainings_id" class="form-control">
                    <label class="form-label ml-2 mb-0">Training Date (From)<sup>*</sup></label>
                    <input type="date" name="date_f_ces_trainings" class="w-100 form-control mb-3" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label ml-2 mb-0">Training Date (To)<sup>*</sup></label>
                    <input type="date" name="date_t_ces_trainings" class="w-100 form-control mb-3" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label ml-2 mb-0">Session Title / Program<sup>*</sup></label>
                    <input type="text" name="s_title_ces_trainings" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label ml-2 mb-0">Session No.<sup>*</sup></label>
                    <input type="text" name="s_no_ces_trainings" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label ml-2 mb-0">Training Category / Theme<sup>*</sup></label>
                    <input type="text" name="training_category_ces_trainings" class="form-control w-100 mb-3" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label ml-2 mb-0">Expertise / Field of Specialization<sup>*</sup></label>
                    <select name="fos_ces_trainings" aria-aria-controls='example' class="date-picker w-100 form-control mb-3" required>
                        <option value="">Please Select</option>
                        <option value="fos1">fos1</option>
                        <option value="fos2">fos2</option>
                        <option value="fos3">fos3</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label ml-2 mb-0">Venue<sup>*</sup></label>
                    <input type="text" name="venue_ces_trainings" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label ml-2 mb-0">No. of Training hours<sup>*</sup></label>
                    <input type="number" name="noh_ces_trainings" class="form-control w-100 mb-3" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label ml-2 mb-0">Barrio</label>
                    <input type="text" name="barrio_ces_trainings" class="form-control w-100 mb-3">
                </div>
                <div class="col-md-4">
                    <label class="form-label ml-2 mb-0">Resource Speaker<sup>*</sup></label>
                    <input type="text" name="rs_ces_trainings" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label ml-2 mb-0">Session Director<sup>*</sup></label>
                    <input type="text" name="sd_ces_trainings" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label ml-2 mb-0">Training Status<sup>*</sup></label>
                    <select name="training_status_ces_trainings" aria-aria-controls='example' class="date-picker w-100 form-control mb-3" required>
                        <option value="">Please Select</option>
                        <option value="Registration">Registration</option>
                        <option value="Completed">Completed</option>
                        <option value="Pending">Pending</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label class="form-label ml-2 mb-0">Remarks<sup>*</sup></label>
                    <textarea class="form-control w-100 mb-3" style="text-transform:capitalize" name="remarks_ces_trainings" id="exampleFormControlTextarea2" rows="4" required></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col my-3">
                    @if (count($CesTrainings) === 0)
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('CES Trainings', 'Add') == 'true')
                            <input type="submit" id="ces_trainings_form_submit" class="btn btn-primary mb-1" value="Add Record">
                        @endif
                    @else
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('CES Trainings', 'Add') == 'true')
                            <input type="submit" id="ces_trainings_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                            <input type="button" id="ces_trainings_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetCesTrainingsForm()">
                        @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('CES Trainings', 'Edit') == 'true')
                            <input type="submit" id="ces_trainings_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
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
                        <th scope="col">Session Title / Program</th>
                        <th scope="col">Session No.</th>
                        <th scope="col">Training Category / Theme</th>
                        <th scope="col">Expertise / Field of Specialization</th>
                        <th scope="col">Vanue</th>
                        <th scope="col">No. of Training Hours</th>
                        <th scope="col">Barrio</th>
                        <th scope="col">Resource Speaker</th>
                        <th scope="col">Session Director</th>
                        <th scope="col">Training Status</th>
                        <th scope="col">Remarks</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">Encoded By</th>
                        <th scope="col">Encoded Date</th>
                        <th scope="col">Last Updated By</th>
                        <th scope="col">Last Update Date</th>
                    </tr>
                </thead>
                <tbody id="CesTrainings_tbody">
                    @if (count($CesTrainings) === 0)

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
                            <td>-</td>
                        </tr>
                    @else
                        @foreach ($CesTrainings as $item)
                            <tr>
                                <td>
                                    <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetCesTrainingsForm({{ $item->id }},`View`)">View</a>
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('CES Trainings', 'Edit') == 'true')
                                        <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetCesTrainingsForm({{ $item->id }},`Edit`)">Edit</a>
                                    @endif
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('CES Trainings', 'Delete') == 'true')
                                        <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/ces-trainings/delete/{{ $item->id }}`, `updateCesTrainingsTable`, `resetCesTrainingsForm`, `None`, `None`)">Delete</a>
                                    @endif

                                </td>
                                <td>{{ $item->s_title_ces_trainings ?? '-' }}</td>
                                <td>{{ $item->s_no_ces_trainings ?? '-' }}</td>
                                <td>{{ $item->training_category_ces_trainings ?? '-' }}</td>
                                <td>{{ $item->fos_ces_trainings ?? '-' }}</td>
                                <td>{{ $item->venue_ces_trainings ?? '-' }}</td>
                                <td>{{ $item->noh_ces_trainings ?? '-' }}</td>
                                <td>{{ $item->barrio_ces_trainings ?? '-' }}</td>
                                <td>{{ $item->rs_ces_trainings ?? '-' }}</td>
                                <td>{{ $item->sd_ces_trainings ?? '-' }}</td>
                                <td>{{ $item->training_status_ces_trainings ?? '-' }}</td>
                                <td>{{ $item->remarks_ces_trainings ?? '-' }}</td>
                                <td>{{ $item->date_f_ces_trainings ?? '-' }}</td>
                                <td>{{ $item->date_t_ces_trainings ?? '-' }}</td>
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
