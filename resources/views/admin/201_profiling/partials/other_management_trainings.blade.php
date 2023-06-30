<div class="tab-pane fade hidden" id="other_management_trainings" role="tabpanel" aria-labelledby="other_management_trainings-tab">
    <form class="user" id="other_management_trainings_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/other-management-trainings/add`, `other_management_trainings_form`, `Add`, `updateOtherManagementTrainingsTable`, `resetOtherManagementTrainingsForm`, `other_management_trainings_form_submit`, `None`, `None`)">
        @csrf
        <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
            <h1>OTHER NON-CES ACCREDITED TRAININGS</h1>
        </div>
        <div class="container-fuild m-3">
            <div class="row">
                <div class="col-md-3">
                    <input type="hidden" id="cesno_other_management_trainings" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                    <input type="hidden" id="cesno_other_management_trainings_id" name="cesno_other_management_trainings_id" class="form-control">
                    <label class="form-label ml-2 mb-0">Training Date (From)<sup>*</sup></label>
                    <input type="date" name="date_f_onat" class="w-100 form-control mb-3" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label ml-2 mb-0">Training Date (To)<sup>*</sup></label>
                    <input type="date" name="date_t_onat" class="w-100 form-control mb-3" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Training Title<sup>*</sup></label>
                    <input type="text" name="title_traning_onat" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Training Category<sup>*</sup></label>
                    <input type="text" name="training_category_onat" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Expertise / Field of Specialization<sup>*</sup></label>
                    <input type="text" name="expertise_fos_onat" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Sponsor / Training Provider<sup>*</sup></label>
                    <input type="text" name="sponsor_tp_onat" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Venue<sup>*</sup></label>
                    <input type="text" name="vanue_onat" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">No. of Traning Hours<sup>*</sup></label>
                    <input type="number" name="no_training_hours_omt" class="form-control w-100 mb-3" required>
                </div>
            </div>
            <div class="row">
                <div class="col my-3">
                    @if (count($OtherManagementTrainings) === 0)
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Other Non-CES Accredited Trainings', 'Add') == 'true')
                            <input type="submit" id="other_management_trainings_form_submit" class="btn btn-primary mb-1" value="Add Record">
                        @endif
                    @else
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Other Non-CES Accredited Trainings', 'Add') == 'true')
                            <input type="submit" id="other_management_trainings_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                            <input type="button" id="other_management_trainings_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetOtherManagementTrainingsForm()">
                        @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Other Non-CES Accredited Trainings', 'Edit') == 'true')
                            <input type="submit" id="other_management_trainings_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
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
                        <th scope="col">Training Title</th>
                        <th scope="col">Training Category</th>
                        <th scope="col">Expertise / Field of Specialization</th>
                        <th scope="col">Sponsor / Training Provider</th>
                        <th scope="col">Vanue</th>
                        <th scope="col">No. of Training Hours</th>
                        <th scope="col">Encoded By</th>
                        <th scope="col">Encoded Date</th>
                        <th scope="col">Last Updated By</th>
                        <th scope="col">Last Update Date</th>
                    </tr>
                </thead>
                <tbody id="OtherManagementTrainings_tbody">
                    @if (count($OtherManagementTrainings) === 0)

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
                        </tr>
                    @else
                        @foreach ($OtherManagementTrainings as $item)
                            <tr>
                                <td>
                                    <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetOtherManagementTrainingsForm({{ $item->id }},`View`)">View</a>
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Other Non-CES Accredited Trainings', 'Edit') == 'true')
                                        <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetOtherManagementTrainingsForm({{ $item->id }},`Edit`)">Edit</a>
                                    @endif
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Other Non-CES Accredited Trainings', 'Delete') == 'true')
                                        <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/other-management-trainings/delete/{{ $item->id }}`, `updateOtherManagementTrainingsTable`, `resetOtherManagementTrainingsForm`, `None`, `None`)">Delete</a>
                                    @endif

                                </td>
                                <td>{{ $item->date_f_onat ?? '-' }}</td>
                                <td>{{ $item->date_t_onat ?? '-' }}</td>
                                <td>{{ $item->title_traning_onat ?? '-' }}</td>
                                <td>{{ $item->training_category_onat ?? '-' }}</td>
                                <td>{{ $item->expertise_fos_onat ?? '-' }}</td>
                                <td>{{ $item->sponsor_tp_onat ?? '-' }}</td>
                                <td>{{ $item->vanue_onat ?? '-' }}</td>
                                <td>{{ $item->no_training_hours_omt ?? '-' }}</td>
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
