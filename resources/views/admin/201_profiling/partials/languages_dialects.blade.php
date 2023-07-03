<div class="tab-pane fade" id="languages_dialects" role="tabpanel" aria-labelledby="languages_dialects-tab">
    <form class="user" id="languages_dialects_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/languages-dialects/add`, `languages_dialects_form`, `Add`, `updateLanguagesDialectsTable`, `resetLanguagesDialectsForm`, `languages_dialects_form_submit`, `None`, `None`)">
        @csrf
        <div class="bg-blue-500 p-2 uppercase text-white">
            <h1>LANGUAGES / DIALECTS</h1>
        </div>

        <div class="container-fuild m-3">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" id="cesno_languages_dialects" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                    <input type="hidden" id="cesno_languages_dialects_id" name="cesno_languages_dialects_id" class="form-control">
                    <label class="form-label ml-2 mb-0">Languages<sup>*</sup></label>
                    <select name="lang_languages_dialects" class="form-control w-100 mb-3" required>
                        <option value="">Please Select</option>
                        @foreach ($LanguageDialects as $item)
                            <option value="{{ $item->title }}">{{ $item->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col my-3">
                    @if (count($LanguagesDialects) === 0)
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Language Dialects', 'Add') == 'true')
                            <input type="submit" id="languages_dialects_form_submit" class="btn btn-primary mb-1" value="Add Record">
                        @endif
                    @else
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Language Dialects', 'Add') == 'true')
                            <input type="submit" id="languages_dialects_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                            <input type="button" id="languages_dialects_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetLanguagesDialectsForm()">
                        @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Language Dialects', 'Edit') == 'true')
                            <input type="submit" id="languages_dialects_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
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
                        <th scope="col">Languages / Dialects</th>
                        <th scope="col">Encoded By</th>
                        <th scope="col">Encoded Date</th>
                        <th scope="col">Last Updated By</th>
                        <th scope="col">Last Update Date</th>
                    </tr>
                </thead>
                <tbody id="LanguagesDialects_tbody">
                    @if (count($LanguagesDialects) === 0)

                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    @else
                        @foreach ($LanguagesDialects as $item)
                            <tr>
                                <td>
                                    <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetLanguagesDialectsForm({{ $item->id }},`View`)">View</a>
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Language Dialects', 'Edit') == 'true')
                                        <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetLanguagesDialectsForm({{ $item->id }},`Edit`)">Edit</a>
                                    @endif
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Language Dialects', 'Delete') == 'true')
                                        <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/languages-dialects/delete/{{ $item->id }}`, `updateLanguagesDialectsTable`, `resetLanguagesDialectsForm`, `None`, `None`)">Delete</a>
                                    @endif

                                </td>
                                <td>{{ $item->lang_languages_dialects ?? '-' }}</td>
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
