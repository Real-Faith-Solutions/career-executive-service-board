<div class="tab-pane fade" id="educational_attainment" role="tabpanel" aria-labelledby="educational_attainment-tab">
    <form class="user" id="educational_attainment_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/educational-attainment/add`, `educational_attainment_form`, `Add`, `updateEducationalAttainmentTable`, `resetEducationalAttainmentForm`, `educational_attainment_form_submit`, `None`, `None`)">
        @csrf
        <div class="bg-blue-500 p-2 uppercase text-white">
            <h1>HISTORICAL RECORD OF EDUCATION BACKGROUND / ATTAINMENT</h1>
        </div>
        <div class="container-fuild m-3">
            <div class="row">
                <div class="col-md-3">
                    <input type="hidden" id="cesno_educational_attainment" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                    <input type="hidden" id="cesno_educational_attainment_id" name="cesno_educational_attainment_id" class="form-control">
                    <label class="form-label ml-2 mb-0">Level<sup>*</sup></label>
                    <select name="level_ea" class="form-control w-100 mb-3" required>
                        <option value="">Please Select</option>
                        <option value="Elementary">Elementary</option>
                        <option value="Secondary">Secondary</option>
                        <option value="Vocational/Trade Course">Vocational/Trade Course</option>
                        <option value="College">College</option>
                        <option value="Graduate Studies">Graduate Studies</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label ml-2 mb-0">School<sup>*</sup></label>
                    <select name="school_ea" class="form-control w-100 mb-3" required>
                        <option value="">Please Select</option>
                        @foreach ($School as $item)
                            <option value="{{ $item->CODE }}">{{ $item->SCHOOL }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label ml-2 mb-0">Degree<sup>*</sup></label>
                    <select name="degree_ea" class="form-control w-100 mb-3" required>
                        <option value="">Please Select</option>
                        @foreach ($Degree as $item)
                            <option value="{{ $item->CODE }}">{{ $item->DEGREE }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label ml-2 mb-0">Year Graduated<sup>*</sup></label>
                    <input type="year" name="date_grad_ea" id="onlyYear" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Major / Specialization<sup>*</sup></label>
                    <select name="ms_ea" class="form-control w-100 mb-3" required>
                        <option value="">Please Select</option>
                        @foreach ($CourseMajor as $item)
                            <option value="{{ $item->CODE }}">{{ $item->COURSE }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">School Type / Status<sup>*</sup></label>
                    <select name="school_type_ea" aria-aria-controls='example' class="date-picker w-100 form-control mb-3" required>
                        <option value="">Please Select</option>
                        <option value="Local">Local</option>
                        <option value="Foreign">Foreign</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Period of Attendance From<sup>*</sup></label>
                    <input type="date" name="date_f_ea" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Period of Attendance To<sup>*</sup></label>
                    <input type="date" name="date_t_ea" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Heighest Level / Unit Earned<sup>*</sup></label>
                    <input type="text" name="hlu_ea" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Academic Honors Received</label>
                    <input type="text" name="ahr_ea" class="form-control w-100 mb-3">
                </div>
            </div>
            <div class="row">
                <div class="col my-4">
                    @if (count($EducationalAttainment) === 0)
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Educational Background or Attainment', 'Add') == 'true')
                            <input type="submit" id="educational_attainment_form_submit" class="btn btn-primary mb-1" value="Add Record">
                        @endif
                    @else
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Educational Background or Attainment', 'Add') == 'true')
                            <input type="submit" id="educational_attainment_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                            <input type="button" id="educational_attainment_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetEducationalAttainmentForm()">
                        @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Educational Background or Attainment', 'Edit') == 'true')
                            <input type="submit" id="educational_attainment_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
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
                        <th scope="col">Level</th>
                        <th scope="col">School</th>
                        <th scope="col">Degree</th>
                        <th scope="col">Year Graduate</th>
                        <th scope="col">Major/Specialization</th>
                        <th scope="col">School Type/Status</th>
                        <th scope="col">Period of Attendance From</th>
                        <th scope="col">Period of Attendance To</th>
                        <th scope="col">Heighest Level/Unit Earned</th>
                        <th scope="col">Academic Honors Received</th>
                        <th scope="col">Encoded By</th>
                        <th scope="col">Encoded Date</th>
                        <th scope="col">Last Updated By</th>
                        <th scope="col">Last Update Date</th>
                    </tr>
                </thead>
                <tbody id="EducationalAttainment_tbody">
                    @if (count($EducationalAttainment) === 0)

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
                        @foreach ($EducationalAttainment as $item)
                            <tr>
                                <td>
                                    <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetEducationalAttainmentForm({{ $item->id }},`View`)">View</a>
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Educational Background or Attainment', 'Edit') == 'true')
                                        <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetEducationalAttainmentForm({{ $item->id }},`Edit`)">Edit</a>
                                    @endif
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Educational Background or Attainment', 'Delete') == 'true')
                                        <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/educational-attainment/delete/{{ $item->id }}`, `updateEducationalAttainmentTable`, `resetEducationalAttainmentForm`, `None`, `None`)">Delete</a>
                                    @endif

                                </td>
                                <td>{{ $item->level_ea ?? '-' }}</td>
                                <td>{{ $item->school_ea ?? '-' }}</td>
                                <td>{{ $item->degree_ea ?? '-' }}</td>
                                <td>{{ $item->date_grad_ea ?? '-' }}</td>
                                <td>{{ $item->ms_ea ?? '-' }}</td>
                                <td>{{ $item->school_type_ea ?? '-' }}</td>
                                <td>{{ $item->date_f_ea ?? '-' }}</td>
                                <td>{{ $item->date_t_ea ?? '-' }}</td>
                                <td>{{ $item->hlu_ea ?? '-' }}</td>
                                <td>{{ $item->ahr_ea ?? '-' }}</td>
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
