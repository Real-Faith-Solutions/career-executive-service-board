<div class="tab-pane fade" id="pdf_files" role="tabpanel" aria-labelledby="pdf_files-tab">
    <form class="user" id="pdf_files_form" method="POST" enctype="multipart/form-data" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/pdf-files/add`, `pdf_files_form`, `Add`, `updatePdfFilesTable`, `resetPdfFilesForm`, `pdf_files_form_submit`, `None`, `None`)">
        @csrf
        <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
            <h1>PDF FILES</h1>
        </div>
        <div class="container-fuild m-3">
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="hidden" id="cesno_pdf_files" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                    <input type="hidden" id="cesno_pdf_files_id" name="cesno_pdf_files_id" class="form-control">
                    <label class="form-label ml-2 mb-0">Browse PDF Files<sup>*</sup></label>
                    <input id="pdflink" name="pdflink" accept="application/pdf" type="file" onclick="validateFileSize(`pdflink`, 25)" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0" for="validated">Validated?<sup>*</sup></label>
                    <select name="validated" id="validated" class="form-control mb-3" required>
                        <option value="">Please Select</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label class="form-label ml-2 mb-0">Remarks<sup>*</sup></label>
                    <textarea id="remarks_pdf_files" name="remarks_pdf_files" class="form-control w-100 mb-3 rounded" style="text-transform:capitalize" rows="4" required></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col my-3">
                    @if (count($PdfLinks) === 0)
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Attached PDF Files', 'Add') == 'true')
                            <input type="submit" id="pdf_files_form_submit" class="btn btn-primary mb-1" value="Add Record">
                        @endif
                    @else
                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Attached PDF Files', 'Add') == 'true')
                            <input type="submit" id="pdf_files_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                            <input type="button" id="pdf_files_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetPdfFilesForm()">
                        @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Attached PDF Files', 'Edit') == 'true')
                            <input type="submit" id="pdf_files_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
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
                        <th scope="col">Relevant Path</th>
                        <th scope="col">Uploaded PDF files</th>
                        <th scope="col">Validated</th>
                        <th scope="col">Date Attached</th>
                        <th scope="col">Remarks</th>
                        <th scope="col">Encoded By</th>
                        <th scope="col">Encoded Date</th>
                        <th scope="col">Last Updated By</th>
                        <th scope="col">Last Update Date</th>
                    </tr>
                </thead>
                <tbody id="PDFFiles_tbody">
                    @if (count($PdfLinks) === 0)

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
                        @foreach ($PdfLinks as $item)
                            <tr>
                                <td>
                                    <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetPdfFilesForm({{ $item->id }},`View`)">View</a>
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Attached PDF Files', 'Edit') == 'true')
                                        <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetPdfFilesForm({{ $item->id }},`Edit`)">Edit</a>
                                    @endif
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Attached PDF Files', 'Delete') == 'true')
                                        <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/pdf-files/delete/{{ $item->id }}`, `updatePdfFilesTable`, `resetPdfFilesForm`, `None`, `None`)">Delete</a>
                                    @endif

                                </td>
                                <td nowrap="nowrap">{{ $item->relevant_path_pdf_files ?? '-' }}</td>
                                <td><a href="{{ asset('external-storage/' . ($item->relevant_path_pdf_files == '' && $item->pdflink != '' ? 'PDF Documents/201 Folder/' : $item->relevant_path_pdf_files) . $item->pdflink) }}">{{ $item->pdflink ?? '-' }}</a></td>
                                <td>{{ $item->validated ?? '-' }}</td>
                                <td>{{ strftime('%m/%d/%Y', strtotime($item->updated_at)) ?? '-' }}</td>
                                <td>{{ $item->remarks_pdf_files ?? '-' }}</td>
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
