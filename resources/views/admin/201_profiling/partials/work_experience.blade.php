<div class="tab-pane fade" id="work_experience" role="tabpanel" aria-labelledby="work_experience-tab">
    <form class="user" id="work_experience_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/work-experience/add`, `work_experience_form`, `Add`, `updateWorkExperienceTable`, `resetWorkExperienceForm`, `work_experience_form_submit`, `None`, `None`)">
        @csrf
        <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
            <h1>WORK EXPERIENCE</h1>
        </div>
        <div class="container-fuild m-3">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" id="cesno_work_experience" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                    <input type="hidden" id="cesno_work_experience_id" name="cesno_work_experience_id" class="form-control">
                    <label class="form-label ml-2 mb-0">Date (From)<sup>*</sup></label>
                    <input type="date" name="date_from_work_experience" class="w-100 form-control mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Date (To)<sup>*</sup></label>
                    <input type="date" name="date_to_work_experience" class="form-control mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Position Title / Designation<sup>*</sup></label>
                    <input type="text" name="destination_from_work_experience" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Status<sup>*</sup></label>
                    <input type="text" name="status_from_work_experience" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Monthly Salary<sup>*</sup></label>
                    <input type="text" name="salary_from_work_experience" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Salary/Job/Pay Grade<sup>*</sup></label>
                    <input type="text" name="salary_job_pay_grade_work_experience" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Status of Appointment<sup>*</sup></label>
                    <input type="text" name="status_of_appointment_work_experience" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Government Service<sup>*</sup></label>
                    <select name="government_service_work_experience" class="form-control w-100 mb-3" required>
                        <option value="">Please Select</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Department / Agency<sup>*</sup></label>
                    <input type="text" name="department_from_work_experience" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label ml-2 mb-0">Remarks<sup>*</sup></label>
                    <textarea name="remarks_from_work_experience" class="form-control w-100 mb-3" style="text-transform:capitalize" rows="4" required></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col my-3">
                    @if (count($WorkExperience) === 0)
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Work Experience', 'Add') == 'true')
                            <input type="submit" id="work_experience_form_submit" class="btn btn-primary mb-1" value="Add Record">
                        @endif
                    @else
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Work Experience', 'Add') == 'true')
                            <input type="submit" id="work_experience_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                            <input type="button" id="work_experience_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetWorkExperienceForm()">
                        @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Work Experience', 'Edit') == 'true')
                            <input type="submit" id="work_experience_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
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
                        <th scope="col">Destination</th>
                        <th scope="col">Status</th>
                        <th scope="col">Salary</th>
                        <th scope="col">Salary/Job/Pay Grade</th>
                        <th scope="col">Status of Appointment</th>
                        <th scope="col">Government Service</th>
                        <th scope="col">Department</th>
                        <th scope="col">Remarks</th>
                        <th scope="col">Encoded By</th>
                        <th scope="col">Encoded Date</th>
                        <th scope="col">Last Updated By</th>
                        <th scope="col">Last Update Date</th>
                    </tr>
                </thead>
                <tbody id="WorkExperience_tbody">
                    @if (count($WorkExperience) === 0)

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
                        @foreach ($WorkExperience as $item)
                            <tr>
                                <td>
                                    <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetWorkExperienceForm({{ $item->id }},`View`)">View</a>
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Work Experience', 'Edit') == 'true')
                                        <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetWorkExperienceForm({{ $item->id }},`Edit`)">Edit</a>
                                    @endif
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Work Experience', 'Delete') == 'true')
                                        <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/work-experience/delete/{{ $item->id }}`, `updateWorkExperienceTable`, `resetWorkExperienceForm`, `None`, `None`)">Delete</a>
                                    @endif

                                </td>
                                <td>{{ $item->date_from_work_experience ?? '-' }}</td>
                                <td>{{ $item->date_to_work_experience ?? '-' }}</td>
                                <td>{{ $item->destination_from_work_experience ?? '-' }}</td>
                                <td>{{ $item->status_from_work_experience ?? '-' }}</td>
                                <td>{{ $item->salary_from_work_experience ?? '-' }}</td>
                                <td>{{ $item->salary_job_pay_grade_work_experience ?? '-' }}</td>
                                <td>{{ $item->status_of_appointment_work_experience ?? '-' }}</td>
                                <td>{{ $item->government_service_work_experience ?? '-' }}</td>
                                <td>{{ $item->department_from_work_experience ?? '-' }}</td>
                                <td>{{ $item->remarks_from_work_experience ?? '-' }}</td>
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
