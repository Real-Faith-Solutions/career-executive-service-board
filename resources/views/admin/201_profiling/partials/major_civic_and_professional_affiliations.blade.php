<div class="tab-pane fade" id="major_civic_and_professional_affiliations" role="tabpanel" aria-labelledby="major_civic_and_professional_affiliations-tab">
    <form class="user" id="major_civic_and_professional_affiliations_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/major-civic-and-professional-affiliations/add`, `major_civic_and_professional_affiliations_form`, `Add`, `updateAffiliationsTable`, `resetAffiliationsForm`, `major_civic_and_professional_affiliations_form_submit`, `None`, `None`)">
        @csrf
        <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
            <h1>MAJOR CIVIC AND PROFESSIONAL AFFILIATIONS</h1>
        </div>
        <div class="container-fuild m-3">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" id="cesno_major_civic_and_professional_affiliations" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                    <input type="hidden" id="cesno_major_civic_and_professional_affiliations_id" name="cesno_major_civic_and_professional_affiliations_id" class="form-control">
                    <label class="form-label ml-2 mb-0">Date (From)<sup>*</sup></label>
                    <input type="date" name="date_f_mcapa" class="w-100 form-control mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Date (To)<sup>*</sup></label>
                    <input type="date" name="date_t_mcapa" class="w-100 form-control mb-3" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Organization<sup>*</sup></label>
                    <input type="text" name="organization_mcapa" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Position<sup>*</sup></label>
                    <input type="text" name="position_mcapa" class="form-control w-100 mb-3" required>
                </div>
            </div>
            <div class="row">
                <div class="col my-3">
                    @if (count($Affiliations) === 0)
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Major Civic and Professional Affiliations', 'Add') == 'true')
                            <input type="submit" id="major_civic_and_professional_affiliations_form_submit" class="btn btn-primary mb-1" value="Add Record">
                        @endif
                    @else
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Major Civic and Professional Affiliations', 'Add') == 'true')
                            <input type="submit" id="major_civic_and_professional_affiliations_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                            <input type="button" id="major_civic_and_professional_affiliations_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetAffiliationsForm()">
                        @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Major Civic and Professional Affiliations', 'Edit') == 'true')
                            <input type="submit" id="major_civic_and_professional_affiliations_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
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
                        <th scope="col">Organization</th>
                        <th scope="col">Position</th>
                        <th scope="col">Encoded By</th>
                        <th scope="col">Encoded Date</th>
                        <th scope="col">Last Updated By</th>
                        <th scope="col">Last Update Date</th>
                    </tr>
                </thead>
                <tbody id="Affiliations_tbody">
                    @if (count($Affiliations) === 0)

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
                        @foreach ($Affiliations as $item)
                            <tr>
                                <td>
                                    <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetAffiliationsForm({{ $item->id }},`View`)">View</a>
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Major Civic and Professional Affiliations', 'Edit') == 'true')
                                        <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetAffiliationsForm({{ $item->id }},`Edit`)">Edit</a>
                                    @endif
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Major Civic and Professional Affiliations', 'Delete') == 'true')
                                        <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/major-civic-and-professional-affiliations/delete/{{ $item->id }}`, `updateAffiliationsTable`, `resetAffiliationsForm`, `None`, `None`)">Delete</a>
                                    @endif

                                </td>
                                <td>{{ $item->date_f_mcapa ?? '-' }}</td>
                                <td>{{ $item->date_t_mcapa ?? '-' }}</td>
                                <td>{{ $item->organization_mcapa ?? '-' }}</td>
                                <td>{{ $item->position_mcapa ?? '-' }}</td>
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
