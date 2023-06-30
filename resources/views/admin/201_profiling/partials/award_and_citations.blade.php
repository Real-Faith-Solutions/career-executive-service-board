<div class="tab-pane fade hidden" id="award_and_citations" role="tabpanel" aria-labelledby="award_and_citations-tab">
    <form class="user" id="award_and_citations_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/award-and-citations/add`, `award_and_citations_form`, `Add`, `updateAwardAndCitationsTable`, `resetAwardAndCitationsForm`, `award_and_citations_form_submit`, `None`, `None`)">
        @csrf
        <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
            <h1>AWARD AND CITATIONS RECEIVED</h1>
        </div>
        <div class="container-fuild m-3">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" id="cesno_award_and_citations" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                    <input type="hidden" id="cesno_award_and_citations_id" name="cesno_award_and_citations_id" class="form-control">
                    <label class="form-label ml-2 mb-0">Date<sup>*</sup></label>
                    <input type="date" name="date_aac" class="w-100 form-control mb-3" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Title of Award<sup>*</sup></label>
                    <input type="text" name="title_of_award_aac" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Sponsor<sup>*</sup></label>
                    <input type="text" name="sponsor_aac" class="form-control w-100 mb-3" required>
                </div>
            </div>
            <div class="row">
                <div class="col my-3">
                    @if (count($AwardAndCitations) === 0)
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Awards and Citations Received', 'Add') == 'true')
                            <input type="submit" id="award_and_citations_form_submit" class="btn btn-primary mb-1" value="Add Record">
                        @endif
                    @else
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Awards and Citations Received', 'Add') == 'true')
                            <input type="submit" id="award_and_citations_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                            <input type="button" id="award_and_citations_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetAwardAndCitationsForm()">
                        @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Awards and Citations Received', 'Edit') == 'true')
                            <input type="submit" id="award_and_citations_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
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
                        <th scope="col">Title of Award</th>
                        <th scope="col">Sponsor</th>
                        <th scope="col">Encoded By</th>
                        <th scope="col">Encoded Date</th>
                        <th scope="col">Last Updated By</th>
                        <th scope="col">Last Update Date</th>
                    </tr>
                </thead>
                <tbody id="AwardAndCitations_tbody">
                    @if (count($AwardAndCitations) === 0)

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
                        @foreach ($AwardAndCitations as $item)
                            <tr>
                                <td>
                                    <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetAwardAndCitationsForm({{ $item->id }},`View`)">View</a>
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Awards and Citations Received', 'Edit') == 'true')
                                        <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetAwardAndCitationsForm({{ $item->id }},`Edit`)">Edit</a>
                                    @endif
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Awards and Citations Received', 'Delete') == 'true')
                                        <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/award-and-citations/delete/{{ $item->id }}`, `updateAwardAndCitationsTable`, `resetAwardAndCitationsForm`, `None`, `None`)">Delete</a>
                                    @endif

                                </td>
                                <td>{{ $item->date_aac ?? '-' }}</td>
                                <td>{{ $item->title_of_award_aac ?? '-' }}</td>
                                <td>{{ $item->sponsor_aac ?? '-' }}</td>
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
