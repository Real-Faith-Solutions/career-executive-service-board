<div class="my-5 flex justify-end">
    <button class="btn btn-primary" onclick="openFormCaseRecord()">Add Case Record/s</button>
    <button class="btn btn-primary hidden" onclick="openTableCaseRecord()">Go back</button>
</div>

<div class="form-case-record hidden">
    @include('admin.201_profiling.view_profile.partials.case_records.form')
</div>

<div class="table-case-record relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Parties
                </th>

                <th scope="col" class="px-6 py-3">
                    Offense
                </th>

                <th scope="col" class="px-6 py-3">
                    Nature of Ofense
                </th>

                <th scope="col" class="px-6 py-3">
                    Case Number
                </th>

                <th scope="col" class="px-6 py-3">
                    Date Filed
                </th>

                <th scope="col" class="px-6 py-3">
                    Venue
                </th>

                <th scope="col" class="px-6 py-3">
                    Case Status
                </th>

                <th scope="col" class="px-6 py-3">
                    Date of Finality
                </th>

                <th scope="col" class="px-6 py-3">
                    Decision
                </th>

                <th scope="col" class="px-6 py-3">
                    Remarks
                </th>

                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($caseRecord as $caseRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $caseRecords->parties }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecords->offence }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecords->nature_code }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecords->case_no }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecords->filed_date }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecords->venue }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecords->status_code }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecords->finality }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecords->decision }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecords->remarks }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('case-record.edit', ['ctrlno'=>$caseRecords->ctrlno]) }}" method="GET">
                                @csrf
                                <button class="mx-1 font-medium text-blue-600 hover:underline" type="submit">
                                   UPDATE
                                </button>
                            </form>

                            <form action="{{ route('case-record.destroy', ['ctrlno'=>$caseRecords->ctrlno]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="mx-1 font-medium text-red-600 hover:underline" type="submit">
                                    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                                    <lord-icon
                                        src="https://cdn.lordicon.com/jmkrnisz.json"
                                        trigger="hover"
                                        colors="primary:#880808"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
