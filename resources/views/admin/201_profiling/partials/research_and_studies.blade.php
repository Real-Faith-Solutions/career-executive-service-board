<div class="tab-pane fade hidden" id="research_and_studies" role="tabpanel" aria-labelledby="research_and_studies-tab">
    <form class="user" id="research_and_studies_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/research-and-studies/add`, `research_and_studies_form`, `Add`, `updateResearchAndStudiesTable`, `resetResearchAndStudiesForm`, `research_and_studies_form_submit`, `None`, `None`)">
        @csrf
        <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
            <h1>RESEARCH AND STUDIES</h1>
        </div>
        <div class="container-fuild m-3">
            <div class="row">
                <div class="col-md-3">
                    <input type="hidden" id="cesno_research_and_studies" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                    <input type="hidden" id="cesno_research_and_studies_id" name="cesno_research_and_studies_id" class="form-control">
                    <label class="form-label ml-2 mb-0">Date (From)<sup>*</sup></label>
                    <input type="date" name="date_f_ras" class="w-100 form-control mb-3" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label ml-2 mb-0">Date (To)<sup>*</sup></label>
                    <input type="date" name="date_t_ras" class="w-100 form-control mb-3" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Research Title<sup>*</sup></label>
                    <input type="text" name="title_ras" class="form-control w-100 mb-3" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Publisher<sup>*</sup></label>
                    <input type="text" name="publisher_ras" class="form-control w-100 mb-3" required>
                </div>
            </div>
            <div class="row">
                <div class="col my-3">
                    @if (count($ResearchAndStudies) === 0)
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Research and Studies', 'Add') == 'true')
                            <input type="submit" id="research_and_studies_form_submit" class="btn btn-primary mb-1" value="Add Record">
                        @endif
                    @else
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Research and Studies', 'Add') == 'true')
                            <input type="submit" id="research_and_studies_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                            <input type="button" id="research_and_studies_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetResearchAndStudiesForm()">
                        @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Research and Studies', 'Edit') == 'true')
                            <input type="submit" id="research_and_studies_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
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
                        <th scope="col">Research Title</th>
                        <th scope="col">Publisher</th>
                        <th scope="col">Encoded By</th>
                        <th scope="col">Encoded Date</th>
                        <th scope="col">Last Updated By</th>
                        <th scope="col">Last Update Date</th>
                    </tr>
                </thead>
                <tbody id="ResearchAndStudies_tbody">
                    @if (count($ResearchAndStudies) === 0)

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
                        @foreach ($ResearchAndStudies as $item)
                            <tr>
                                <td>
                                    <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetResearchAndStudiesForm({{ $item->id }},`View`)">View</a>
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Research and Studies', 'Edit') == 'true')
                                        <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetResearchAndStudiesForm({{ $item->id }},`Edit`)">Edit</a>
                                    @endif
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Research and Studies', 'Delete') == 'true')
                                        <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/research-and-studies/delete/{{ $item->id }}`, `updateResearchAndStudiesTable`, `resetResearchAndStudiesForm`, `None`, `None`)">Delete</a>
                                    @endif

                                </td>
                                <td>{{ $item->date_f_ras ?? '-' }}</td>
                                <td>{{ $item->date_t_ras ?? '-' }}</td>
                                <td>{{ $item->title_ras ?? '-' }}</td>
                                <td>{{ $item->publisher_ras ?? '-' }}</td>
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
