<div class="my-5 flex justify-end">
    <button class="btn btn-primary" onclick="openFormHealthRecord()">Add Health Record</button>
    <button class="btn btn-primary hidden" onclick="openTableHealthRecord()">Go back</button>
</div>

<div class="form-health-record hidden">
    @include('admin.201_profiling.view_profile.partials.health_records.form')
</div>

<div class="table-health-record relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Blood Type
                </th>

                <th scope="col" class="px-6 py-3">
                    Identifying Marks
                </th>

                <th scope="col" class="px-6 py-3">
                    Disabilities
                </th>

                <th scope="col" class="px-6 py-3">
                    Specified Disabilities
                </th>

                <th scope="col" class="px-6 py-3">
                    Medical Condition/Illness
                </th>

                <th scope="col" class="px-6 py-3">
                    Date
                </th>


                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($healthRecord as $healthRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                       {{ $healthRecords->blood_type }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $healthRecords->marks }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $healthRecords->handicap }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $healthRecords->disability_handicap_defects_specify }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $healthRecords->illness }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $healthRecords->illness_date }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <a href="#" class="mx-1 font-medium text-blue-600 hover:underline">Update</a>
                        
                            <form action="{{ route('health-record.destroy', ['ctrlno'=>$healthRecords->ctrlno]) }}" method="POST">
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
